@extends('back.layout')

@section('page', 'Products')

@section('breadcrump')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection

@section('content')

    <div class="mb-5 ml-3">
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary mr-2">Add New</a>
        {{-- <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-sm btn-outline-danger">Trashed</a> --}}
    </div>

    <x-alert type="success" />

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input type="text" name="name" place="Enter Name" value="{{ request('name') }}"  class="mx-2"/>
        <select name="status" class=" form-control mx-2">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
        </select>
        <button class="btn btn-dark mx-2">Filter</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Id</th>
                <th>Name</th>
                <th>Category</th>
                <th>Store</th>
                <th>Status</th>
                <th>Created At</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>


            @forelse ($products as $product)
                <tr>
                    <td><img src="{{ asset("uploads/$product->image") }}" height="50" alt=""></td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->store->name }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->created_at->format('d M, Y h:i a')  }}</td>
                    <td>
                        <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="8"> No Data Found</td>
                </tr>
            @endforelse

        </tbody>
    </table>
    {{ $products->withQueryString()->links() }}
@endsection
