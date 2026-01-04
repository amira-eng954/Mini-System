
@extends('admin.layout')


 @section('content')
<div class=" container">

   
 <div class="  ">{{ Auth::user()->email }}</div>
 
 <div class="  bg-light">{{ Auth::user()->role }}</div>

@if(session()->has('add'))
<div class=" alert alert-success">{{ session()->get('add') }}</div>
@endif

<br>
   <a href="{{route('product.create')}}" class=" btn  btn-success ">add product</a>
    <a href="{{route('products.trash')}}" class=" btn btn-info">Trash</a>
    <div class=" align-items-center">
<form  action="{{route('products.filter')}}" class="d-flex align-items-center mb-3" method="get">
    @csrf
    <input type='text'   name="name" placeholder="search product">
    <button class=" btn btn-info">filter</button>
</form>
    </div>
<div>
    <table class="table     ">
        <tr class=" bg-dark">
            <th>#</th>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quntatiy</th>
            <th>SKU</th>
             <th>Status</th>
              <th>proccess</th>
        </tr>

        @foreach ($products as  $product)
            <tr>
                <td></td>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->qty}}</td>
                <td>{{$product->sku}}</td>
                <td>{{$product->status}}</td>
                <td>
                    <a class=" btn btn-success m-1" href="{{route('product.edit',$product->id)}}">update</a>
                    <form action="{{route('product.destroy',$product->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                    <button class=" btn  btn-danger" >delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
   
    
    
   {{ $products->links() }} 
</div>
</div>
@endsection
