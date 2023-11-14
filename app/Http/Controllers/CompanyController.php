<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CompanyAddRequest;
use Illuminate\Http\File;
Use App\Models\Company;
use DB;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$company = Company::all();
        $company = DB::table('companies')->select()->paginate(10);
        return view('company.index',compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.add-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = new Company;
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        //$company->logo = $request->input('logo');
        $company->logo = "test.png";
        $company->website = $request->input('website');

        $mail_to = $request->input('email');

        // return $request->input('logo');

        if($request->file('logo') == null){
            $file="";
        }else{
            $file = $request->file('logo')->store('public');
        }

        $c = DB::table('companies')->select('id')->where('email',$company->email)->count();
        if($c>0){
            return redirect('/companies')->with('error',' Email already exist..');
        }else{
            $company->save();
            Mail::send('email.new-company',$company->toArray(),function($message) use ($mail_to)
            {
                $message->to($mail_to,'Mail test')
                        ->subject('Regarding New Cmpany Creation');
            });
            return redirect('/companies')->with('success','New company created successfully');
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
        $record = Company::find($id);
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
        $company = Company::find($id);
        return view('company.edit',compact('company'));
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
        $company = Company::find($id);
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->logo = $request->input('logo');
        $company->website = $request->input('website');

        if($request->file('logo') == null){
            $file="";
        }else{
            $file = $request->file('logo')->store('public');
        }

        $company->update();
        return redirect('/companies')->with('success','Company details updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();
        return redirect('/companies')->with('success','Company deleted successfully');
    }
}
