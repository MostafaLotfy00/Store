@props([
    'type' => 'text',
    'name',
    'value' => '',
    'place' => 'Enter Value'
    ])

<input
 type="{{ $type }}"
  @class(['form-control', 'is-invalid' => $errors->has($name)])
   name="{{ $name }}" value="{{ old( $name , $value ) }}"
    id="categoryName"  placeholder="{{ $place }}">
<x-input-error :messages="$errors->get($name)" class="mt-2" />

