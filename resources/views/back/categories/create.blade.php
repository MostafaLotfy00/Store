@extends('back.layout')

@section('page', 'Categories')

@section('breadcrump')
@parent
<li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')

<form class="ml-5" action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="categoryName">Category Name</label>
      <input type="text" class="form-control" name="name" id="categoryName" aria-describedby="emailHelp" placeholder="Enter email">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
   
    <div class="form-group">
        <label for="categoryParent">Category Parent</label>
        <select class="form-control" name="parent_id" id="categoryParent">
          <option value="">Primary Category</option>
          @foreach ($parents as $parent)
          <option value="{{ $parent->id }}">{{ $parent->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="exampleFormControlFile1">image</label>
        <input type="file" class="form-control-file" id="exampleFormControlFile1">
      </div>
      <div class="form-group">
        <label for="exampleFormControlFile1">Status</label>
        
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="active" checked>
        <label class="form-check-label" for="exampleRadios1">
          Active
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="archived">
        <label class="form-check-label" for="exampleRadios2">
          Archived
        </label>
      </div>
      </div>


      <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
      </div>

      
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection