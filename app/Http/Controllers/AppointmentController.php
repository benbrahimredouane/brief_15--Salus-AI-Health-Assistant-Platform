<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Support\Facades\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $appointments = $request->user()->appointments()->with('doctor')->get();
        return response()->json([
            'success' => true,
            'data' => [
                'appointments' => $appointments,
            ],
            'message' => 'appointment recu succefully',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        $appointment = Appointment::create([
            'user_id' => $request->user()->id,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);
        return response()->json([
            'success' => true,
            'data' => [
                'appointement' => $appointment,
            ],
            'messge' => 'appointment created successuly',
        ], 201);
    }

 



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment, $id)
    {
        $appointment = $appointment->user()->appointments()->findOrfail($id);
        $appointment->delete();

        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'appointment has been deleted with success!',
        ], 200);
    }
}
