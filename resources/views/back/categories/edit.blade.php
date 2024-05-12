@extends('back.layout')

@section('page', 'Categories')

@section('breadcrump')
@parent
<li class="breadcrumb-item active">Categories</li>
<li class="breadcrumb-item active">Edit Category</li>
@endsection

@section('content')

<form class="ml-5" action="{{ route('dashboard.categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-group">
      <label for="categoryName">Category Name</label>
      <input type="text" class="form-control" name="name" id="categoryName" value="{{ old('name',$category->name)  }}" aria-describedby="emailHelp" placeholder="Enter email">
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
   
    <div class="form-group">
        <label for="categoryParent">Category Parent</label>
        <select class="form-control" name="parent_id" id="categoryParent">
          <option value="">Primary Category</option>
          @foreach ($parents as $parent)
          <option value="{{ $parent->id }}" @selected( old('parent_id',$category->parent_id)  == $parent->id)>{{ $parent->name }}</option>
          @endforeach
        </select>
        <x-input-error :messages="$errors->get('parent_id')" class="mt-2" />
      </div>

      <div class="form-group">
        <label for="exampleFormControlFile1">image</label>
        <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1" accept="image/*">
        @if ($category->image)
            <img src="{{ asset("uploads/$category->image") }}"  height="60" alt="">
        @endif
        <x-input-error :messages="$errors->get('image')" class="mt-2" />
      </div>
      <div class="form-group">
        <label for="exampleFormControlFile1">Status</label>
        
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="active" @checked( old('status',$category->status) == 'active')>
        <label class="form-check-label" for="exampleRadios1">
          Active
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="archived"  @checked(old('status',$category->status) == 'archived')>
        <label class="form-check-label" for="exampleRadios2">
          Archived
        </label>
      </div>
      <x-input-error :messages="$errors->get('status')" class="mt-2" />
      </div>


      <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">{{ $category->description }}</textarea>
      </div>

    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection