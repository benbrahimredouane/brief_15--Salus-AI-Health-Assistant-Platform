<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {

        $doctors = Doctor::all();
        return Response()->json([
            'success' => true,
            'data' => [

                'doctors' => $doctors,
            ],
            'message' => 'data retrived succefuly',
        ], 200);
    }
    public function show(Doctor $doctor)
    {
        return Response()->json([
            'success' => true,
            'data' => [

                'doctors' => $doctor,
            ],
            'message' => 'data retrived succefuly',
        ], 200);
    }
    public function search(Request $request)
    {
        $query = Doctor::query();
        if ($request->has('specialty')) {
            $query->where('specialty', 'like', '%' . $request->specialty . '%');
        }

        if ($request->has('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        $results = $query->get();

        return Response()->json([
            'success' => true,
            'data' => [

                'doctors' => $results,
            ],
            'message' => 'data retrived succefuly',
        ], 200);
    }
}
