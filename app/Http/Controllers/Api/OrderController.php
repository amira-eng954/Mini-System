<?php
namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Jobs\EmailJob;
use App\Mail\EmailMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    //
    public function store(Request $request)
    {  
      $request->validate([
    'products' => 'required|array|min:1',
    'products.*.product_id' => 'required|exists:products,id',
    'products.*.qun' => 'required|integer|min:1',
]);
     
         try{
            DB::beginTransaction();

             $order=Order::create([
                 'total_price'=>0
             ]);
             $total_price=0;
             //return "amira";
             //$products= Product::whereIn('id',$request->products)->collect($request->products);
             foreach($request->products as $item)
             {
                 $product=Product::find($item['product_id']);
                  OrderItem::create([
                    'order_id'=>$order->id,
                    'product_id'=>$product->id,
                    'qun'=>$item['qun'],

                  ]);
                  $price= $item['qun'] * $product->price;
                   $total_price=$total_price + $price;
             }
             $order->update([
                'total_price'=>$total_price
             ]);
             DB::commit();
             EmailJob::dispatch($order)->onQueue('Email');
             return SuccessResponse("order created successful",$order);

         }
         catch(\Exception $e)
         {
            DB::rollback();
            return FailResponse(data:$e->getMessage());
            //return redirect()->back()->with('error',$e->getMessage());
         }

    }

    
   public  function  filter(Request $request)
   {
       $order=Order::whereBetween('created_at',[$request->from,$request->to])->get();
      return SuccessResponse(data:$order);
   }
  
    
}
