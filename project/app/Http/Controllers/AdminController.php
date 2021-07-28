<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Guest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function index(){
                                // TODAY EMP GUEST FIND QUERY 
        $employee_guests = Guest::where('guest_status', 'emp_guest')->whereDate('created_at', Carbon::today())->get();

        $management_guests = Guest::where('guest_status', 'management_guest')->whereDate('created_at', Carbon::today())->get();

        $special_guests = Guest::where('guest_status', 'special_guest')->whereDate('created_at', Carbon::today())->get();
        // dd($employee_guests);


        $today_total_guests = Guest::whereDate('created_at', Carbon::today())->get();//--QUERY OF TODAY'S TOTAL EMPLOYEE GUEST AND CARBON IS A MODEL WHICH USES FOR COUNT--//
        $today_total_emp = Attendance::whereDate('date', Carbon::today())->get();//--QUERY OF TODAY'S TOTAL EMPLOYEE AND CARBON IS A MODEL WHICH USES FOR COUNT --//

        return view('admin.index', ['employee_guests' => $employee_guests, 'management_guests'=>$management_guests, 'special_guests'=>$special_guests, 'today_total_guests'=> $today_total_guests, 'today_total_emp' => $today_total_emp ]);
    }


//--QUERY OF TODAY'S EMPLOYEE GUEST COUNT AND SHOW TABLE IN ADMIN PANEL--//
    public  function today_emp_guest(){
        $guests = Guest::where('guest_status', 'emp_guest')->whereDate('created_at', Carbon::today())->get();


        return view('admin.guests.reports', ['guests' => $guests]);
    }
    //--QUERY OF TODAY'S MANAGEMENT GUEST COUNT AND SHOW TABLE IN ADMIN PANEL--//
    public  function today_management_guest(){
       
        $guests = Guest::where('guest_status', 'management_guest')->whereDate('created_at', Carbon::today())->get();

        return view('admin.guests.reports', ['guests'=>$guests]);
    }
    //--QUERY OF TODAY'S SPECIAL GUEST COUNT AND SHOW TABLE IN ADMIN PANEL--//
    public  function today_special_guest(){

        $guests = Guest::where('guest_status', 'special_guest')->whereDate('created_at', Carbon::today())->get();

        return view('admin.guests.reports', ['guests'=>$guests]);
    }



    //---SHOW THE GUEST REPORT--//
    public function admin_reports(){
        return view('admin.guests.random');
    }


    public function report_generates(Request $request){
        // dd($request);

        $single = "single";
        $all = "all";
        $emp_search = $request['emp_search'];
        $user_refer_id = $request['user_refer_id'];
        $from_date = $request['from_date'];
        $To_date = $request['To_date'];
        // dd($To_date);
        if($emp_search == $all){
            // dd($request);
            
            $guests = Guest::all();//--FOR ALL EMPLOYEE GUESTS REPORT QUERY--//
            
            return view('admin.guests.reports', ['guests' => $guests]);
        }
        if($emp_search == $single){ //--FOR SINGLE EMPLOYEE GUESTS REPORT QUERY--//

            if($from_date != null){

                if($To_date != null){
                    
                    // echo "to date not null";
                    $guests = Guest::where('user_ref_id', $user_refer_id)->where('created_at', '>=', $from_date)
                    ->where('created_at', '<=', $To_date)
                    ->get();
                
                }
                else{
                    $guests = Guest::where('user_ref_id', $user_refer_id)->whereDate('created_at', $from_date)->get();
            

                }
                
            }
            else{
                $guests = Guest::where('user_ref_id', $user_refer_id)->get();
            
                
            }
            
            
            return view('admin.guests.reports', ['guests' => $guests]);
        }

       



       
    }
}
