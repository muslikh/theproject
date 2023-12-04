<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = Company::get();
        $response = [
                      'message' => 'Data Company',
                      'data' => $company,
                    ];
        return response($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        
        try {
            
            Company::create([
                'name'=>$request->name,
                'address'=>$request->address,
                'email'=>$request->email,

            ]);

            $response = [
                            'message' => 'Add New Data Company Success',
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
    public function update(Request $request, $id)
    {
        // dd($id);
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'   => 'required',
            'address'   => 'required',
        ]);

        if($validator->fails()) {

            $response = [
                            'message' => 'Update Data Company Failed',
                        ];
                        return response($response, 401);
        }else{

            Company::whereId($id)->update([
                'name'=> $request->name,
                'email'=> $request->email,
                'address'=> $request->address
    
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
        
       Company::where('id',$id)->delete();
       

       $response = [
                        'message' => 'Delete Data Company Success',
                    ];
        return response($response, 200);

    }
}
