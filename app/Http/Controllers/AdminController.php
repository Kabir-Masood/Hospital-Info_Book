<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_login()
    {
        return view('auth.admin_login');
    }

    public function admin_logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('/admin_login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_register()
    {
        return view('auth.admin_register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function admin_save(Request $request)
    {
        $request->validate([
            'hospital_name'=>'required',
            'hospital_code'=>'required',
            'email'=>'required|email|unique:admins',
            'password'=>'required|min:5|max:12',
            'address'=>'required',
            'contact_no'=>'required',
            'is_active'=>'required',
        ]);
        
        // insert data into database
        $admin = new Admin();

        $admin->hospital_name = $request->hospital_name;
        $admin->hospital_code = $request->hospital_code;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->address = $request->address;
        $admin->contact_no = $request->contact_no;
        $admin->is_active = $request->is_active;

        $save = $admin->save();
        if($save){
            return back()->with('success', 'New Client successfully added to database.');
        }else{
            return back()->with('fail', 'Somthing went wrong, please check and try again.');
        }
    }

    // Check if the client exist in the system before login
    public function admin_check(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12',
       ]);

        //match client to the database
        $adminInfo = Admin::where('email','=', $request->email)->first();

        if(!$adminInfo){
            return back()->with('fail','We do not recognize your email address.');
        }else{
            //check password
            if(Hash::check($request->password, $adminInfo->password)){
                $request->session()->put('LoggedUser', $adminInfo->id);
                return redirect('admin/dashboard');
            }else{
                return back()->with('fail', "Incorrect password.");
            }
        }
    }

    public function admin_dashboard()
    {
        $data = ['LoggedUserInfo'=>Admin::where('id','=', session('LoggedUser'))->first()];
        return view('dashboards.admins.index', $data);
    }
 
    public function admin_settings()
    {
        $data = ['LoggedUserInfo'=>Admin::where('id','=', session('LoggedUser'))->first()];
        return view('dashboards.admins.settings', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
