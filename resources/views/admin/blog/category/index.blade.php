@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Blog Categories</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.blog-categories.create') }}" class="btn btn-primary">
                                <i class="ti ti-plus"></i>
                                Add New Category
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td>
                                                {{ $category->name }}
                                            </td>
                                            <td>
                                                {{ $category->slug }}
                                            </td>
                                            <td class="">
                                                {!! $category->status
                                                    ? '<span class="badge bg-lime text-lime-fg">Active</span>'
                                                    : '<span class="badge bg-pink text-red-fg">Inactive</span>' !!}
                                            </td>
                                            <td style="min-width: 150px;">
                                                <a href="{{ route('admin.blog-categories.edit', $category->id) }}"
                                                    class="btn-sm btn btn-ghost-primary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.blog-categories.destroy', $category->id) }}"
                                                    class="btn-sm btn btn-ghost-danger delete-item">
                                                    <i class="ti ti-trash-x"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No categories found.</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
