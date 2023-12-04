<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        
        if ($request->ajax()) {
            $data = Company::get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row)
            {
                $actionBtn = '<a href="'.route('company.edit',$row->id).'" 
                class="edit btn btn-success btn-sm">Edit</a>
                
                <form action="'.route('company.destroy',$row->id).'" method="POST">
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
        
        return view('company.index');
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('company.create');
        // $response = ['message' =>  '<function name> function'];
        // return response($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //
         try {
            
              Company::create([
                  'name'=>$request->name,
                  'address'=>$request->address,
                  'email'=>$request->email,
  
              ]);
  
              return redirect()->route('company.index')->with('success','Successfully to create new company');
          } catch (\Throwable $th) {
              //throw $th;
              return redirect()->route('company.index')->with('error',$th->getMessage());
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
        $company =  Company::where('id',$id)->firstOrFail();

        if($company){

            return view('company.edit',compact('company'));
        }else{
            return redirect()->route('company.index')->with('error','company not found');
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Company::where('id',$id)->update([
            'name'=> $request->name,
            'email'=> $request->email,
            'address'=> $request->address

        ]);


        return redirect()->route('company.index')->with('success','Successfully update data');

        // $response = ['message' => 'update function'];
        // return response($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
       Company::where('id',$id)->delete();
       return redirect()->route('company.index')->with('success','Successfully delete data');
        
    }

}
