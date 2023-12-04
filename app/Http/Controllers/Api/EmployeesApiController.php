<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employees;
use Illuminate\Support\Facades\Validator;

class EmployeesApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $employees = Employees::get();
        $response = [
                      'message' => 'Data Employees',
                      'data' => $employees,
                    ];
        return response($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        try {
            
            Employees::create([
                'first_nm'=>$request->first_nm,
                'last_nm'=>$request->last_nm,
                'company_id'=>$request->company_id,
                'phone'=>$request->phone,
                'email'=>$request->email,

            ]);

            $response = [
                            'message' => 'Add New Data Employees Success',
                        ];
            return response($response, 200);
            
        } catch (\Throwable $th) {
            
            $response = [
                            'message' => $th->getMessage(),
                        ];
            return response($response, 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'first_nm'     => 'required',
            'last_nm'   => 'required',
            'company_id'   => 'required',
            'phone'   => 'required',
            'email'   => 'required',
        ]);

        if($validator->fails()) {

            $response = [
                            'message' => 'Update Data Employees Failed',
                        ];
                        return response($response, 401);
        }else{

            Employees::whereId($id)->update([
                'first_nm'=>$request->first_nm,
                'last_nm'=>$request->last_nm,
                'company_id'=>$request->company_id,
                'phone'=>$request->phone,
                'email'=>$request->email,
    
            ]);
            
            $response = [
                            'message' => 'Update Data Company Success',
                        ];
                return response($response, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
       Employees::where('id',$id)->delete();
       

       $response = [
                        'message' => 'Delete Data Employees Success',
                    ];
        return response($response, 200);

    }
}
