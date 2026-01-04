@extends('admin.layout')


 @section('content')
<div class='container'>
  <h2 class=' body text-center'>Edit Product</h2>
    @if($errors->any())
  @foreach($errors->all() as $error)
  <div class=" alert alert-danger">  {{ $error }}</div>
  @endforeach
  @endif
  
<form action="{{route('product.update',$product->id)}}"  method="post"> 
    @csrf
    @method('PUT')
    <div>
     <label class="  form-label mt-1"> name</label>
      <input name="name" class=" form-control" type="text" value="{{$product->name}}">
     
    </div>

     <div>
     <label class="  form-label mt-1"> price</label>
      <input name="price"  class=" form-control" type="number"  value="{{$product->price}}">
     
    </div>

     <div>
     <label class="  form-label mt-1"> sku</label>
      <input name="sku" type="text" class=" form-control"  value="{{$product->sku}}">
     
    </div>
     <div>
     <label class="  form-label mt-1"> status</label>
      <select name="status"  class=" form-control">
        <option value="active" @if($product->status == 'active') selected @endif >active</option>
        <option value="inactive"  @if($product->status == 'inactive') selected @endif>inactive</option>
      </select>
     
    </div>
     <div>
     <label class="  form-label mt-1"> qty</label>
      <input name="qty" type="number" class=" form-control" value="{{$product->qty}}">
     
    </div>
     <div>
     <button type="submit" class=" btn btn-info m-3"> update  </button>
     
    
     
    </div>
</form>
</div>
@endsection