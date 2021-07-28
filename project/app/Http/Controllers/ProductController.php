<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Expense;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Guest;
use App\Models\ProductList;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product_list = ProductList::all();
        
        return view('admin.product.create_product2',['products' => $product_list]);
    }
    public function product_list()
    {
        //
        $product_list=ProductList::all();
        return view('admin.product.list_product',['products'=> $product_list]);
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


    public function expense_counter($id)
    {
        //
        // $user = User::find($id); 

        $today = date('Y-m-d');
        $today_date  = strtotime($today);
        $day   = date('d',$today_date);
        $month = date('m',$today_date);
        $year  = date('Y',$today_date);

        $user = User::where('user_ref_id', $id)->first();
        
        $search_date = $year . "-". $month ."-" . "01";
        
       
        $users_meal_count= Attendance::where('user_ref_id', $id)->where('date', '>=' , $search_date)->count();
       
        $guests_meal_count = Guest::where('user_ref_id', $id)->where('created_at', '>=' , $search_date)->count();
        
        $total_meal_count= $users_meal_count + $guests_meal_count;
        


        $expense = Expense::where('user_id', $user->id)->first();

        // dd($expense);
        if($expense == null){

           $input['name'] = $user->name;
           $input['amount'] = $total_meal_count;
           $input['user_ref_id'] = $user->user_ref_id;
            
            $user->expense()->create($input);
            return redirect()->back();
        }
        else{
            
            $input['amount'] = $total_meal_count;

             
            $user->expense()->update($input);
             return redirect()->back();
            


        }

        

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
        // //
        // dd($request);
        // dd(request('p_image'));
      
        $array_size = count($request['p_name']);

        for($i=0; $i<$array_size; $i++){
        //   
            $inputs['p_name'] = $request['p_name'][$i];
            $inputs['p_unit'] = $request['p_unit'][$i];
            $inputs['p_price'] = $request['p_price'][$i];
            $inputs['p_quantity'] = $request['p_quantity'][$i];
            $inputs['date'] = $request['date'][$i];
            
            // $inputs['p_image']= request('p_image')->store('images');
            
            $total_amount=$inputs['p_price']*$inputs['p_quantity'];
            $inputs['p_total']=$total_amount;
            $product= new Product($inputs);
            // dd($inputs);
            $product->save();
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
        $product = ProductList::find($id);
        $product->delete();
        return redirect()->back();
    }
    

    public function  add_product(Request $request)
    {
        //
        // dd($request);
             
        $inputs = request()->validate([
            'p_name'=>'required',
            'p_unit' => 'required'
           
            
        ]);
     
        $product_list= new ProductList($inputs);
        // dd($inputs);
        $product_list->save();
        return redirect()->route('product.product_list');
        
    }


    public function product_unit_search(Request $request){
        if($request->has('q')){
            $q=$request->q;
            $result = ProductList::where('p_name', 'like', '%'.$q.'%')->get();
            return response()->json(['data' =>$result]);

        }else{
            return view('home');
        }
        
    }



   
}
