@extends('back.layout')

@section('page', 'Products')

@section('breadcrump')
@parent
<li class="breadcrumb-item active">Products</li>
<li class="breadcrumb-item active">Edit Product</li>
@endsection

@section('content')
<x-alert type="success" />
<form class="ml-5" action="{{ route('dashboard.products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-group">
      <label for="categoryName">Product Name</label>
      {{-- <input type="text" class="form-control" name="name" id="categoryName" value="{{ old('name',$category->name)  }}" aria-describedby="emailHelp" placeholder="Enter email"> --}}
      <x-form.input type="text" name="name" place="Enter Name" value="{{ $product->name }}" />
      {{-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}}
    </div>
   
    <div class="form-group">
        <label for="categoryParent">Product Category</label>
        <select class="form-control" name="category_id" id="categoryParent">
          <option value="">Primary Category</option>
          @foreach ($categories as $category)
          <option value="{{ $category->id }}" @selected( old('category_id',$product->category_id)  == $category->id)>{{ $category->name }}</option>
          @endforeach
        </select>
        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
      </div>

      <div class="form-group">
        <label for="categoryName">Product Price</label>
        {{-- <input type="text" class="form-control" name="name" id="categoryName" value="{{ old('name',$category->name)  }}" aria-describedby="emailHelp" placeholder="Enter email"> --}}
        <x-form.input type="text" name="price" place="Enter price" value="{{ $product->price }}" />
        {{-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}}
      </div>

      <div class="form-group">
        <label for="categoryName">Compare Price</label>
        {{-- <input type="text" class="form-control" name="name" id="categoryName" value="{{ old('name',$category->name)  }}" aria-describedby="emailHelp" placeholder="Enter email"> --}}
        <x-form.input type="text" name="compare_price" place="Enter price" value="{{ $product->compare_price }}" />
        {{-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}}
      </div>

      <div class="form-group">
        <label for="categoryName">Tags</label>
        {{-- <input type="text" class="form-control" name="name" id="categoryName" value="{{ old('name',$category->name)  }}" aria-describedby="emailHelp" placeholder="Enter email"> --}}
        <x-form.input type="text" name="tags" place="Enter Tags" value="{{ $tags }}" />
        {{-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}}
      </div>

   

      <div class="form-group">
        <label for="exampleFormControlFile1">image</label>
        <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1" accept="image/*">
        @if ($product->image)
            <img src="{{ asset("uploads/$product->image") }}"  height="60" alt="">
        @endif
        <x-input-error :messages="$errors->get('image')" class="mt-2" />
      </div>
      <div class="form-group">
        <label for="exampleFormControlFile1">Status</label>
        
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="active" @checked( old('status',$product->status) == 'active')>
        <label class="form-check-label" for="exampleRadios1">
          Active
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="archived"  @checked(old('status',$product->status) == 'archived')>
        <label class="form-check-label" for="exampleRadios2">
          Archived
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="draft"  @checked(old('status',$product->status) == 'draft')>
        <label class="form-check-label" for="exampleRadios2">
          Draft
        </label>
      </div>
      <x-input-error :messages="$errors->get('status')" class="mt-2" />
      </div>


      <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">{{ $product->description }}</textarea>
      </div>

    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection