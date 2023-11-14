<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
Use App\Models\Employee;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$employee = Employee::all();
        $employee = DB::table('employees')->select()->paginate(10);
            return view('employee.index',compact('employee'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $company = DB::select("select * from companies");
        return view('employee.add-form',compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = new Employee;
        $employee->first_name = $request->input('fname');
        $employee->last_name = $request->input('lname');
        $company = $request->input('company');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');

        //$res = DB::select("select name from companies where name=?",[$company]);
        $res = DB::table('companies')->select('id')->where('name',$company)->first();
        $employee->company = $res->id;
        $employee->save();

        return redirect('/employees')->with('success','New employee created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = Employee::find($id);
        $res = DB::table('companies')->select('name')->where('id',$record->company)->first();
        $company = $res->name;
        return response()->json($record);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        $res = DB::table('companies')->select('name')->where('id',$employee->company)->first();
        $company = DB::select("select * from companies");
        return view('employee.edit',compact('employee','company','res'));
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
        $employee = Employee::find($id);
        $employee->first_name = $request->input('fname');
        $employee->last_name = $request->input('lname');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $res = DB::table('companies')->select('id')->where('name',$request->input('company'))->first();
        $employee->company = $res->id;
        $employee->update();
        return redirect('/employees')->with('success','Employee details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect('/employees')->with('success','Employee deleted successfully');
    }
}
