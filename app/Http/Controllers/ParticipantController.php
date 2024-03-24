<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participant= Participant::paginate(15);;
        return response()->json($participant);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'identification_number' => 'required|integer',
            'firstName' => 'required|string|max:30',
            'lastName' => 'required|string|max:30',
            'email' => 'required|email|max:50',
            'phone' => 'required|string|max:25',
            'gradeOfSchooling' => 'required|string|max:50',
        ];

        $validator= Validator::make($request->input(), $rules);
        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=> $validator->errors()->all()
            ], 400);
        }

        $participant= new Participant($request->input());
        $participant->save();
        return response()->json([
            'status'=> true,
            'message'=> 'Registro exitoso!'
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Participant $participant)
    {
        $rules = [
            'identification_number' => 'required|integer',
            'firstName' => 'required|string|max:30',
            'lastName' => 'required|string|max:30',
            'email' => 'required|email|max:50',
            'phone' => 'required|string|max:25',
            'gradeOfSchooling' => 'required|string|max:50',                             
        ];

        $validator= Validator::make($request->input(), $rules);

        if($validator->fails()){
            return response()->json([
                'status'=> false,
                'errors'=> $validator->errors()->all()
            ], 400);
        }

        $participant->update($request->input());

        return response()->json([
            'status'=> true,
            'message'=> 'Actualización exitosa!'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participant $participant)
    {
        $participant->delete();
        return response()->json([
            'status'=> true,
            'message'=> 'Eliminación exitosa!'
        ], 200);
    }
}
