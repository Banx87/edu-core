@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Blogs</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
                                <i class="ti ti-plus"></i>
                                Add New Blog
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($blogs as $blog)
                                        <tr>
                                            <td style="background-color: aliceblue; width: 100px;">
                                                <img src="{{ asset($blog->image) }}" style="width: 75px !important;"
                                                    alt="$blog->title" />
                                            </td>
                                            <td>
                                                {{ $blog->title }}
                                            </td>
                                            <td>
                                                {{ $blog->slug }}
                                            </td>
                                            <td class="">
                                                {!! $blog->status
                                                    ? '<span class="badge bg-lime text-lime-fg">Active</span>'
                                                    : '<span class="badge bg-pink text-red-fg">Inactive</span>' !!}
                                            </td>
                                            <td style="min-width: 150px;">
                                                <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                                    class="btn-sm btn btn-ghost-primary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.blogs.destroy', $blog->id) }}"
                                                    class="btn-sm btn btn-ghost-danger delete-item">
                                                    <i class="ti ti-trash-x"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No blogs posts found.</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
