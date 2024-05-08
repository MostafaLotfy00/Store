@extends('back.layout')

@section('page', 'Categories')

@section('breadcrump')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')

    <div class="mb-5 ml-3">
        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary">Add New</a>
    </div>

    @if (session('create-status'))
        <div class="alert alert-success">
            {{ session('create-status') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Id</th>
                <th>Name</th>
                <th>Parent</th>
                <th>Created At</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>


            @forelse ($categories as $category)
                <tr>
                    <td></td>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent_id }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="7"> No Data Found</td>
                </tr>
            @endforelse

        </tbody>
    </table>
@endsection
