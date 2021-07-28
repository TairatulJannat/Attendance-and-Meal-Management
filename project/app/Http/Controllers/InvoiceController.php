<?php

namespace App\Http\Controllers;

use PDF;


use Illuminate\Http\Request;

use App\Models\Employee;

class InvoiceController extends Controller
{
    //
    public function emp_data_print($id){
        

        
        $employee = Employee::find($id);

        return view('pdf', ['employee' =>$employee]);//EMPLOYEE DATA PDF//

        // echo "Employee name :" . $employee->name . "<br>";
        // echo "Employee Ref ID :" . $employee->emp_ref_id. "<br>";
        // echo "Employee Join Time :" . $employee->created_at. "<br>";
        // $pdf = PDF::loadView('pdf', $employee);
        // return $pdf->stream('document.pdf');



    }
   //EMPLOYEE GUEST DATA PDF//
    public function print_page(){
        $data = Employee::all();
        $pdf = PDF::loadView('pdf');
        return $pdf->stream('document.pdf' ,$data);
        
    }
}
