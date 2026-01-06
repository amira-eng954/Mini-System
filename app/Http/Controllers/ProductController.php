<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 
use App\Http\Requests\Products\web\ProductRequest;
use App\Http\Requests\Products\web\UpdateProductRequest;
//use App\Http\Requests\Products\api\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
       $products=Product::paginate(6);
       //dd($products);
        return view("admin.products.index",compact('products'));
       
    }

    public function create()
    {
        $this->authorize('create',Product::class);

          return view("admin.products.create");
    }

    public function store(ProductRequest $request)
    {

        $product=$request->validated();
        $newproduct=Product::create($product);
        session()->flash('add',"new product creates successful");
    
         return redirect()->route('product.index');

    }

 
     public function edit( $id)
    {
        $product=Product::find($id);
       $this->authorize('update',$product);
        
        return view("admin.products.edit",compact('product'));
    }
       
    public function update(ProductRequest $request,  $id)
    {   
        $product=Product::find($id);
         $data=$request->validated();
        $product->update($data);
         session()->flash('add',"product updated successful");
         return redirect()->route('product.index');
       
    }

  
    public function destroy(string $id)
    {
        $product=Product::find($id);
        $this->authorize('delete',$product);
         $product->delete();
         session()->flash('add',"product deleted successful");
         return redirect()->route('product.index');
           
    }
    
    public function trash()
    {
        $this->authorize('viewAny',Product::class);
        $products = Product::onlyTrashed()->paginate();
          
        return view("admin.products.trash",compact('products'));

    }

     public function restore($id)
    {
        $product=Product::onlyTrashed()->findOrFail($id) ;
        $this->authorize('restore',$product);
       
       $product->restore();
        session()->flash('add'," product restored successful");
         return redirect()->route('product.index');

    }

     public function forceDelete($id)
    {   
        $product=Product::onlyTrashed()->findOrFail($id) ;
         $this->authorize('forceDelete',$product);  
       $product->forceDelete();
        session()->flash('add'," product deletes forever successful");
         return redirect()->route('product.index');
        
    }

    public function filter(Request $request)
    {
        $products=Product::where('name','LIKE',"%" . $request->name ."%")
        ->orWhere('sku','LIKE',"%" . $request->name ."%")->paginate(2)->withQueryString();
          return view("admin.products.index",compact('products'));

    }


    public function all()
    {
        
        return view('admin.products.yajra');
    }

    public function getTable()
    {
        $query=Product::select('id','name','sku','price','qty','status');
        return DataTables::of($query)->make(true);
    }
        
    
}
