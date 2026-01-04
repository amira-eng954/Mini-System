@extends('admin.layout')


 @section('content')
<div class=" container mt-2">
   <h2 class=' body text-center'>add Product</h2>
  @if($errors->any())
  @foreach($errors->all() as $error)
  <div class=" alert alert-danger">  {{ $error }}</div>
  @endforeach
  @endif
<form action="{{route('product.store')}}"  method="post"> 
    @csrf
    <div>
     <label class=" form-label mt-1"> name</label>
      <input name="name" class=" form-control" type="text">
     
    </div>

     <div>
     <label  class="  form-label mt-1"> price</label>
      <input name="price" type="number" class=" form-control">
     
    </div>

     <div>
     <label  class=" form-label mt-1"> sku</label>
      <input name="sku" type="text" class=" form-control">
     
    </div>
     <div>
     <label  class=" form-label mt-1"> status</label>
      <select name="status"  class=" form-control">
        <option value="active">active</option>
        <option value="inactive">inactive</option>
      </select>
     
    </div>
     <div>
     <label  class=" form-label mt-1"> qty</label>
      <input name="qty" type="number" class=" form-control">
     
    </div>
     <div>
     <button type="submit" class='btn btn-info m-3'> create  </button>
     
    
     
    </div>

</form>
</div>

 
@endsection