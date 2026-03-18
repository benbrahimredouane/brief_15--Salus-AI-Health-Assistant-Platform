<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSymptomRequest;
use App\Http\Requests\UpdateSymptomRequest;
use App\Models\Symptom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $symptoms = $request->symptoms()->latest()->get();

        return response()->json([

            'success' => true,
            'data' => [
                'symptoms' => $symptoms
            ],

            'message' => 'symptoms retrieved successfully!!',

        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSymptomRequest $request)
    {
        //
        $validated = $request->validated();

        $symptom = $request->user()->symptoms()->create($validated);

        return response()->json([
            'sucess' => true,
            'data' => [
                'symptom' => $symptom,
            ],
            'message' => 'symptom created avec sucess!',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Symptom $symptom)
    {

        Gate::authorize('view', $symptom);

        return response()->json([
            'success' => true,
            'data' => [
                'symptom' => $symptom
            ],
            'message' => 'show a spisify symtom ',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSymptomRequest $request, Symptom $symptom)
    {

        Gate::authorize('modify', $symptom);

        $validated = $request->validated();

        $symptom->update($validated);

        return response()->json([

            'success' => true,
            'date' => [
                'symptom' => $symptom,
            ],
            'message' => 'updated successfully!',

        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Symptom $symptom)
    {
       
        Gate::authorize('destroy',$symptom);

        $symptom->delete();

        return response()->json([
            'success'=>true,

             'data'=> null,

             'message'=>'symptom destroyed with success!',
        ],200);

    }
}
