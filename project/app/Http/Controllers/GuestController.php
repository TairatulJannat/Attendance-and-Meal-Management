<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Guest;




use Mike42\Escpos\Printer; 
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function employeeindex()
    {
        //
        $users = User::all();//--EMPLOYEE GUEST--//
        return view('admin.guests.employee_guest', ['users' => $users]);
    }
    public function managementindex()
    {
        //
        $users = User::all();//--MANAGEMENT GUEST-//
        return view('admin.guests.management', ['users' => $users]);
    }
    public function specialindex()
    {
        //
        $users = User::all();//--SPECIAL FORM GUEST--//
        return view('admin.guests.special', ['users' => $users]);
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
     * 
     * 
     * 
     * 
     */
   //guest token query//



    public function store(Request $request)
    {
        //
        // dd($request);

        $ref_id = $request['user_id'];

        $user = User::where('user_ref_id', $ref_id)->first();
        
        $inputs = request()->validate([
            'name'=>'required',
            'phone_number' => 'required',
            'user_name' => 'required',
            'guest_status' => 'required',
            'guest_image' => 'required'
        ]);
        $inputs['user_id'] = $user->id;
        $inputs['user_ref_id'] = $request['user_id'];
        
        

        // webcam image find query //
        $image = $request->get('guest_image');  // your base64 encoded
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        
        $imagePath= 'images/'. Str::random(20) . '.jpeg';
        Storage::disk('public')->put($imagePath, base64_decode($image));
        $inputs['guest_image'] = $imagePath;

    
      


        $guest = new Guest($inputs);
       
        
        $guest->save();
        $users = Guest::latest('id')->first();//new guest entry//


        // New Guest 


        try {
            $connector = new WindowsPrintConnector("pos");
            $printer = new Printer($connector);
            $printer -> text("\nGLOBE GROUP LTD.");
            $printer -> text("\nTOKEN NO : ". $users->id);
            $printer -> text("\nGuest Name : ". $users->name);
            $printer -> text("\nEmployee Refer ID : ". $users->user_ref_id);
            $printer -> text("\nEmployee Name :". $users->user_name);
            $printer -> text("\nDate&Time : ". $users->created_at);
            $printer -> text("\n Thank You");
            $printer -> text("\n --------------");
            $printer -> text("\n --------------");
    
         
            $printer -> cut();

            $printer -> close();
        } catch(Exception $e) {
            echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
        }
    



        return redirect()->back();
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
