@extends('back.layout')

@section('page', 'Categories')

@section('breadcrump')
    @parent
    <li class="breadcrumb-item ">Categories</li>
    <li class="breadcrumb-item active ">Trashed</li>
@endsection

@section('content')

    <div class="mb-5 ml-3">
        <a href="{{ route('dashboard.categories.index') }}" class="btn btn-sm btn-outline-primary">Back</a>
    </div>

    <x-alert type="success" />

    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input type="text" name="name" place="Enter Name" value="{{ request('name') }}" class="mx-2" />
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
                <th>Parent</th>
                <th>Status</th>
                <th>Deleted At</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>


            @forelse ($categories as $category)
                <tr>
                    <td><img src="{{ asset("uploads/$category->image") }}" height="50" alt=""></td>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->category->name ?? '' }}</td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->deleted_at->format('d M, Y h:i a') }}</td>
                    <td>
                        <form action="{{ route('dashboard.categories.restore', $category->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-outline-info">Restore</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.categories.force-delete', $category->id) }}" method="post">
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
    {{ $categories->withQueryString()->links() }}
@endsection
