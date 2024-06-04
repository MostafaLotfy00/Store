@extends('back.layout')

@section('page', 'Categories')

@section('breadcrump')
@parent
<li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')

<form class="ml-5" action="{{ route('dashboard.categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="categoryName">Category Name</label>
      {{-- <input type="text" @class(['form-control', 'is-invalid' => $errors->has('name')]) name="name" value="{{ old('name') }}" id="categoryName"  placeholder="Enter name"> --}}
      <x-form.input type="text" name="name" place="Enter Name" />
      {{-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}}
    </div>
   
    <div class="form-group">
        <label for="categoryParent">Category Parent</label>
        <select class="form-control" name="parent_id" id="categoryParent">
          <option value="">Primary Category</option>
          @foreach ($parents as $parent)
          <option value="{{ $parent->id }}" @selected(old('parent_id') == $parent->id)>{{ $parent->name }}</option>
          @endforeach
        </select>
        <x-input-error :messages="$errors->get('parent_id')" class="mt-2" />
      </div>

      <div class="form-group">
        <label for="exampleFormControlFile1">image</label>
        <input type="file" name="image" value="{{ old('image') }}" class="form-control-file" id="exampleFormControlFile1">
        <x-input-error :messages="$errors->get('image')" class="mt-2" />
      </div>
      <div class="form-group">
        <label for="exampleFormControlFile1">Status</label>
        
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="active" @checked(old('status') == 'active')>
        <label class="form-check-label" for="exampleRadios1">
          Active
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="archived" @checked(old('status') == 'archived')>
        <label class="form-check-label" for="exampleRadios2">
          Archived
        </label>
      </div>
      <x-input-error :messages="$errors->get('status')" class="mt-2" />
      </div>


      <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">{{ old('description') }}</textarea>
      </div>

      
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection