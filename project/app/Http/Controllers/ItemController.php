<?php
    namespace App\Http\Controllers;
    use App\Http\Requests;  
    use Illuminate\Http\Request;
    use App\Models\Product;
    use App\Models\InvoiceImage;
    use DB;  
    use PDF;  
    class ItemController extends Controller
    {
        /**
        * Write code on Method
        *
        * @return response()
        */  
        public function itemPdfView(Request $request)  
        {  
            $today = date("Y-m-d");
        //$products= Product::where('date', $today )->get();
            $items =Product::where('date', $today )->get(); 
            view()->share('items',$items);  
      
            if($request->has('download')){  
                $pdf = PDF::loadView('itemPdfView');  
                return $pdf->download('itemPdfView.pdf');  
            }      
            return view('itemPdfView');  
        }  


        public function store_invoice(Request $request){
            // dd($request);

            // if(request('invoice_image')){
            //     $file = $request->file('invoice_image');
            //     $fileName = $file->getClientOriginalName();
            //     // dd($fileName);
            //     $inputs['invoice_image'] = request('invoice_image')->store($fileName, 'invoices');
            // }

            // $invoice_image = new InvoiceImage($inputs);
            // $invoice_image->save();


            $file = $request->file('invoice_image');
            $destinationPath = 'invoices';
            $inputs['invoice_image'] = $file->move($destinationPath,$file->getClientOriginalName());
            $invoice_image = new InvoiceImage($inputs);
            $invoice_image->save();
            return redirect()->route('invoice_image.show');



        
           }

           public function invoice_image(){
               $invoice_image = InvoiceImage::latest('id')->first();
               return view ('admin.product.invoice_image',['invoice_image'=>$invoice_image]);
           }
        
    }
?>