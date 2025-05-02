@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Course Sub Categories of ({{ $course_category->name }})</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.course-sub-categories.create', $course_category->id) }}"
                                class="btn btn-primary">
                                <i class="ti ti-plus"></i>
                                New Sub Category
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Icon</th>
                                        <th>Name</th>
                                        <th>Trending</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sub_categories as $category)
                                        <tr>
                                            <td>
                                                <i class="{{ $category->icon }} ""></i>
                                            </td>
                                            <td>
                                                {{ $category->name }}
                                            </td>
                                            <td class="">
                                                {!! $category->set_trending
                                                    ? '<span class="badge bg-lime text-lime-fg space-left-10"> Yes</span>'
                                                    : '<span class="badge bg-pink text-red-fg space-left-12"> No </span>' !!}
                                            </td>
                                            <td class="">
                                                {!! $category->status
                                                    ? '<span class="badge bg-lime text-lime-fg"> Active</span>'
                                                    : '<span class="badge bg-pink text-red-fg"> Inactive </span>' !!}
                                            </td>
                                            <td>
                                                {{ $category->status ? 'Active' : 'Inactive' }}
                                            </td>
                                            <td style="min-width: 150px;">
                                                <a href="{{ route('admin.course-sub-categories.edit', ['course_category' => $category->parent_id, 'course_sub_category' => $category->id]) }}"
                                                    class="btn-sm btn btn-ghost-primary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.course-sub-categories.destroy', ['course_category' => $category->parent_id, 'course_sub_category' => $category->id]) }}"
                                                    class="btn-sm btn btn-ghost-danger delete-item">
                                                    <i class="ti ti-trash-x"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No Subcategories found.</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    {{ $sub_categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
