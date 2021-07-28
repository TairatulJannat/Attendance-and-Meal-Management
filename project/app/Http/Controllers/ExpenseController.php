<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Account;
use App\Models\Attendance;
use App\Models\Guest;
use App\Models\User;


class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         
        $accounts = Account::all();
        
        
        return view('admin.product.expense_manager',['accounts' => $accounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $expense = Expense::find();
        return view('admin.product.add_accounts');
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

          //
        //   
        // dd($request);
        $user_refer_id= request('user_ref_id');
        // dd($user_refer_id);


        $today = date('Y-m-d');
        $today_date  = strtotime($today);
        $day   = date('d',$today_date);
        $month = date('m',$today_date);
        $year  = date('Y',$today_date);
        
        $search_date = $year . "-". $month ."-" . "01";

        // dd($today);
        
        
        $users_meal_count= Attendance::where('user_ref_id', $user_refer_id)->where('date', '>=' , $search_date)->count();
       
        $guests_meal_count = Guest::where('user_ref_id', $user_refer_id)->where('created_at', '>=' , $search_date)->count();
        
        $user_total_meal= $users_meal_count + $guests_meal_count;


        $total_attendance_meal = Attendance::where('date', '>=', $search_date)->count();
        $total_guest_meal = Guest::where('created_at', '>=' ,$search_date)->count();

        $total_meal=  $total_attendance_meal +  $total_guest_meal;
      
        $total_meal = (int)$total_meal;
        // dd($total_meal);
        $total_product_amount= Product::where('created_at', '>=' , $search_date)->sum('p_total');
        
        $total_product_amount = (int)$total_product_amount;
        // dd($total_product_amount);
        $present_month_meal_rate = $total_product_amount / $total_meal ;
        // dd($present_month_meal_rate);
        $user_total_expense = $present_month_meal_rate * (int)$user_total_meal;

        // dd($user_total_khoroch);

        $user_due = (int)$request['paid_amount'] - $user_total_expense;
        
        $user= User::where('user_ref_id',$user_refer_id)->first();
        
        // dd($user_due);


       
        $inputs=request()->validate([
            'name' => 'required',
            'user_ref_id' => 'required',
            'paid_amount' => 'required'
        ]);
        if(request('date')){
            $inputs['date']=request('date');
        }else{

            $inputs['date']=$today;
        }
        $inputs['total_meal'] = $user_total_meal;
        $inputs['total_expense'] = $user_total_expense;
        $inputs['due_amount'] = $user_due;



        // $inputs['paid_amount'] = $request['paid_amount'];

        // dd($inputs);

        // $inputs = request()->all();
        
         $user->account()->create($inputs); 


         return redirect()->route('expense.index');
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
    // public function invoice_home()
    // {
    //     //
    //     return view('admin.product.invoice_home');
    // }

    public function today_invoice()
    {
        //
        $today = date("Y-m-d");
        $items= Product::where('date', $today )->get();
        // $products=Product::all();
        return view('itemPdfView',['items' => $items]);
    }
}
