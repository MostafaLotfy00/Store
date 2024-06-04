@extends('back.layout')

@section('page', 'Profile')

@section('breadcrump')
@parent
<li class="breadcrumb-item active">Profile</li>
<li class="breadcrumb-item active">Edit Profile</li>
@endsection

@section('content')
<x-alert type="success" />
<form class="ml-5" action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PATCH")

    <div class="row">
        <div class="col-md-6">
    <div class="form-group">
      <label for="categoryName">First Name</label>
      {{-- <input type="text" class="form-control" name="name" id="categoryName" value="{{ old('name',$category->name)  }}" aria-describedby="emailHelp" placeholder="Enter email"> --}}
      <x-form.input type="text" name="first_name" place="Enter First Name" value="{{ $user->profile->first_name }}" />
      {{-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}}
    </div>
    
    <div class="form-group">
      <label for="categoryName">Last Name</label>
      {{-- <input type="text" class="form-control" name="name" id="categoryName" value="{{ old('name',$category->name)  }}" aria-describedby="emailHelp" placeholder="Enter email"> --}}
      <x-form.input type="text" name="last_name" place="Enter Last Name" value="{{ $user->profile->last_name }}" />
      {{-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}}
    </div>

    <div class="form-group">
        <label for="exampleFormControlFile1">image</label>
        <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1" accept="image/*">
        @if ($user->profile->image)
            <img src="{{ asset("uploads/{$user->profile->image}") }}"  height="60" alt="">
        @endif
        <x-input-error :messages="$errors->get('image')" class="mt-2" />
      </div>


    <div class="form-group">
      <label for="categoryName">Phone</label>
      {{-- <input type="text" class="form-control" name="name" id="categoryName" value="{{ old('name',$category->name)  }}" aria-describedby="emailHelp" placeholder="Enter email"> --}}
      <x-form.input type="text" name="phone" place="Enter phon" value="{{ $user->profile->phon }}" />
      {{-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}}
    </div>

    <div class="form-group">
      <label for="categoryName">Birthday</label>
      {{-- <input type="text" class="form-control" name="name" id="categoryName" value="{{ old('name',$category->name)  }}" aria-describedby="emailHelp" placeholder="Enter email"> --}}
      <x-form.input type="date" name="birthday" place="Enter Birthday" value="{{ $user->profile->birthday }}" />
      {{-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}}
    </div>
   
    <div class="form-group">
        <label for="exampleFormControlFile1">Gender</label>
        
      <div class="form-check">
        <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="male" @checked( old('gender',$user->profile->gender) == 'male')>
        <label class="form-check-label" for="exampleRadios1">
          Male
        </label>
      </div>
        
      <div class="form-check">
        <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="female" @checked( old('gender',$user->profile->gender) == 'female')>
        <label class="form-check-label" for="exampleRadios1">
          Female
        </label>
      </div>
     
      <x-input-error :messages="$errors->get('gender')" class="mt-2" />
      </div>
      
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label for="categoryName">Street Address</label>
        {{-- <input type="text" class="form-control" name="name" id="categoryName" value="{{ old('name',$category->name)  }}" aria-describedby="emailHelp" placeholder="Enter email"> --}}
        <x-form.input type="text" name="address" place="Enter Address" value="{{ $user->profile->birthday }}" />
        {{-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}}
      </div>

      <div class="form-group">
        <label for="categoryName">City</label>
        {{-- <input type="text" class="form-control" name="name" id="categoryName" value="{{ old('name',$category->name)  }}" aria-describedby="emailHelp" placeholder="Enter email"> --}}
        <x-form.input type="text" name="city" place="Enter Address" value="{{ $user->profile->city }}" />
        {{-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}}
      </div>

      <div class="form-group">
        <label for="categoryName">ٍState</label>
        {{-- <input type="text" class="form-control" name="name" id="categoryName" value="{{ old('name',$category->name)  }}" aria-describedby="emailHelp" placeholder="Enter email"> --}}
        <x-form.input type="text" name="state" place="Enter Address" value="{{ $user->profile->state }}" />
        {{-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}}
      </div>

      <div class="form-group">
        <label for="categoryName">Postal Code</label>
        {{-- <input type="text" class="form-control" name="name" id="categoryName" value="{{ old('name',$category->name)  }}" aria-describedby="emailHelp" placeholder="Enter email"> --}}
        <x-form.input type="text" name="postal_code" place="Enter Address" value="{{ $user->profile->postal_code }}" />
        {{-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}}
      </div>
      <div class="form-group">
        <label for="categoryParent">Country</label>
        <select class="form-control" name="country" id="categoryParent">
          <option value="">Country</option>
          @foreach ($countries as $country => $value)
          <option value="{{ $country }}" @selected( old('country',$user->profile->country)  == $country)>{{ $value }}</option>
          @endforeach
        </select>
        <x-input-error :messages="$errors->get('country')" class="mt-2" />
      </div>

      <div class="form-group">
        <label for="categoryParent">Locale</label>
        <select class="form-control" name="locale" id="categoryParent">
          <option value="">Locale</option>
          @foreach ($locales as $locale => $value)
          <option value="{{ $locale }}" @selected( old('locale',$user->profile->locale)  == $locale)>{{ $value }}</option>
          @endforeach
        </select>
        <x-input-error :messages="$errors->get('country')" class="mt-2" />
      </div>
      </div>
{{-- 


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
      </div> --}}

    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection