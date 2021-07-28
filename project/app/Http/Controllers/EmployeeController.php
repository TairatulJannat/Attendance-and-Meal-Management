<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();//--ALL EMPLOYEE INFORMATION QUERY--//
        return view('admin.guests.view_all_employee',['users'=> $users]);
    }
    


    public function manager_view_employee()
    {
        //
        $users = User::all();//--ALL EMPLOYEE INFORMATION QUERY--//
        return view('admin.guests.view_all_employee',['users'=> $users]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


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
        $user = User::find($id);//--EDIT QUERY--//
        return view('admin.guests.edit', ['user'=> $user] );
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
        // dd($request);
        
        $user = User::find($id);
     
        // $this->validate($request,[
        //     'department'=> 'required',
        //     'designation'=> 'required',
        //     'email'=> 'required',
        //     'phone_number'=> 'required',  
            
        // ]);
        
        $input = request()->validate([
            'department'=> 'required',
            'designation'=> 'required',
            'email'=> 'required',
            'phone_number'=> 'required',
            'user_ref_id'=> 'required' 
        ]);



        if(request('emp_image')){
           $input['emp_image'] = request('emp_image')->store('images');
           $user->emp_image = $input['emp_image'];
        }

        if(request('emp_image_from_snap')){
            // dd($request['emp_image_from_snap']);
            $image = $request->get('emp_image_from_snap');  // your base64 encoded
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            
            $imagePath= 'images/'. Str::random(20) . '.jpeg';
            Storage::disk('public')->put($imagePath, base64_decode($image));
            $input['emp_image_from_snap'] = $imagePath;
            $user->emp_image = $input['emp_image_from_snap'];
        }



        $user->department = $input['department'];
        $user->designation = $input['designation'];
        $user->email = $input['email'];
        $user->phone_number = $input['phone_number'];
        $user->user_ref_id = $input['user_ref_id'];

        $user->update();
        




        //--UPDATE EMPLOYEE'S INFORMATION QUERY--//
        // $user->update($request->all());
        // dd($user);
        return redirect()->route('employee.index');
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

        $employee = User::find($id);
        $employee->delete();//--DELETE EMPLOYEE'S INFORMATION QUERY--//
        return redirect()->route('employee.index');
    }




    public function emp_name_search(Request $request){
        if($request->has('q')){
            $q=$request->q;
            $result = User::where('user_ref_id', 'like', '%'.$q.'%')->get();
            return response()->json(['data' =>$result]);

        }else{
            return view('home');
        }
        
    }
}
