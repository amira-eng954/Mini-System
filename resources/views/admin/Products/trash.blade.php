@extends('admin.layout')

@section('content')


<div class='container m-5'>
     <h2 class=' body text-center'>Trashed Products</h2>
    
@if(session()->has('add'))
  <div class=' alert alert-success'>{{ session()->get('add') }}</div>
@endif
    <table class="table table-bordered mt-3">
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quntatiy</th>
            <th>SKU</th>
             <th>Status</th>
              <th>Deleted_at</th>
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
                <td>{{$product->deleted_at}}</td>
                <td>
                      <form action="{{route('products.restore',$product->id)}}" method="post">
                        @csrf
                        @method('PUT')
                    <button class=" btn   btn-info" >restore</button>
                    </form>
                    
                    <form action="{{route('products.force-delete',$product->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                    <button class=" btn  btn-danger" >delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <a  class=' btn btn-info' href="{{route('product.index')}}">back</a>
   {{ $products->links() }} 
</div>
@endsection