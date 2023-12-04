<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employees;
use Yajra\DataTables\Facades\DataTables;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $data = Employees::with('company')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row)
            {
                $actionBtn = '<a href="'.route('employees.edit',$row->id).'" 
                class="edit btn btn-success btn-sm">Edit</a>
                
                <form action="'.route('employees.destroy',$row->id).'" method="POST">
                    '.csrf_field().''.method_field("DELETE").'
                        <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm(\'Are You Sure Want to Delete?\')">
                        Delete</a>
                    </form> 
                </div>
                ';

                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        
        return view('employees.index');
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $company = Company::get();
        return view('employees.create',compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //
         try {
            
              Employees::create([
                  'first_nm'=>$request->first_nm,
                  'last_nm'=>$request->last_nm,
                  'company_id' => $request->company_id,
                  'email'=>$request->email,
                  'phone'=>$request->phone,
  
              ]);
  
              return redirect()->route('employees.index')->with('success','Successfully to create new employees');
          } catch (\Throwable $th) {
              //throw $th;
              return redirect()->route('employees.index')->with('error',$th->getMessage());
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
        $employees =  Employees::where('id',$id)->firstOrFail();
        $company = Company::get();

        if($employees){

            return view('employees.edit',compact('employees','company'));
        }else{
            return redirect()->route('employees.index')->with('error','employees not found');
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Employees::where('id',$id)->update([
            'first_nm'=> $request->first_nm,
            'last_nm'=> $request->last_nm,
            'company_id'=> $request->company_id,
            'email'=> $request->email,
            'phone'=> $request->phone

        ]);


        return redirect()->route('employees.index')->with('success','Successfully update data');

        // $response = ['message' => 'update function'];
        // return response($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
       Employees::where('id',$id)->delete();
       return redirect()->route('employees.index')->with('success','Successfully delete data');
        
    }
}
