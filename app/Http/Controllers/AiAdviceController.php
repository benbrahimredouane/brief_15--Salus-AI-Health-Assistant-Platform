<?php

namespace App\Http\Controllers;

use App\Models\AiAdvice;
use App\Models\Symptom;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
//use Symfony\Component\HttpFoundation\Response;

class AiAdviceController extends Controller
{
    //
    public function generate(Request $request)
    {

        $user = Auth::user();

        //get the last symtom

        $recentsymtom = Symptom::where('user_id', $user->id)->latest()->value('description');

        // if there is no symptom yet
        if (empty($recentsymtom)) {
            return response()->json([
                'success' => true,
                'data' => null,
                'message' => 'No recent symptoms found. Please add symptoms first.',

            ], 200);
        }

        //the prompt
        $prompt = "You are a wellness advisor. The user recently reported the following symptom:\n\n" .

            $recentsymtom . "\n\n" .

            "Provide general wellness advice, lifestyle suggestions, natural remedies when relevant, and when it is recommended to consult a doctor." .

            "DO NOT make medical diagnoses. Respond clearly, kindly,";

        $response = Http::timeout(30)->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent?key=' . env('GEMINI_API_KEY'), [

            'contents' => [
                [
                    'parts' => ['text' => $prompt]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.7,
                'maxOutputTokens' => 800,

            ]
        ]);

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Impossible de contacter Gemini',

            ], 500);
        }

        $data = $response->json();

        $advice = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Sorry, I was unable to generate any advice.';

        //save advice to history

        $aiAdvice = AiAdvice::create([
            'user_id' => $user->id,
            'symptoms_used' => $recentsymtom,
            'advice' => $advice,

        ]);
        return response()->json([
            'sucess' => true,
            'data' => [
                'symptoms_used' => $recentsymtom,
                'advice' => $advice,
            ],
            'message' => 'advice retrive avec sucess!',
        ], 200);
    }


    
    public function history()
    {
        $user =  Auth::user();

        $advice = $user->aiAdvices()->latest()->pagination(10);

        return response()->json([

            'success' => true,
            'data' => [
                'advice' => $advice
            ],
            'message' => 'voila ton history',
        ], 200);
    }
}
