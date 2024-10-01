<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
{
    $employees = Employe::all();
    return response()->json([
        'data' => $employees,
        'status' => 200
    ], 200);
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //return view

    

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate(
            [
                'name' =>'required|string|max:255',
                'email' =>'required|string|email|max:255|unique:employe',
                'phone' =>'required|string|max:20',
                'address' =>'required|string|max:255'
            ]
        );

        $employee = new Employe();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->save();

        if($employee) {
            return response()->json([
               'message' => 'Employee created successfully',
               'status' => 201
            ], status: 201);
        }
        else {
            return response()->json([
               'message' => 'Failed to create employee',
               'status' => 500
            ], status: 500);
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        $emplooyee = Employe::find($id);
        if($emplooyee) {
            return response()->json([
                'data' => $emplooyee,
               'status' => 200
            ], 200);
        }
        else {
            return response()->json([
               'message' => 'Employee not found',
               'status' => 404
            ], 404);
    
    }
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $emplooyee = Employe::find($id);
        if($emplooyee) {
            return response()->json([
                'data' => $emplooyee,
               'status' => 200
            ], 200);
        }
        else {
            return response()->json([
               'message' => 'Employee not found',
               'status' => 404
            ], 404);
    
    }
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' =>'required|string|max:255',
                'email' =>'required|string|email|max:255|unique:employe,email,'.$id,
                'phone' =>'required|string|max:20',
                'address' =>'required|string|max:255'
            ]
        );

        $emplooyee = Employe::find($id);
        if($emplooyee) {
            $emplooyee->name = $request->name;
            $emplooyee->email = $request->email;
            $emplooyee->phone = $request->phone;
            $emplooyee->address = $request->address;
            $emplooyee->save();

            return response()->json([
               'message' => 'Employee updated successfully',
               'status' => 200
            ], 200);
        }
        else {
            return response()->json([
               'message' => 'Employee not found',
               'status' => 404
            ], 404);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emplooyee = Employe::find($id);
        if($emplooyee) {
            $emplooyee->delete();
            return response()->json([
               'message' => 'Employee deleted successfully',
               'status' => 200
            ], 200);
        }
        else {
            return response()->json([
               'message' => 'Employee not found',
               'status' => 404
            ], 404);
        }
    }
}
