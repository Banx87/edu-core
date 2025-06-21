@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Custom Pages</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.custom-page.create') }}" class="btn btn-primary">
                                <i class="ti ti-plus space"></i>
                                Add New
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Show In Nav</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($customPages as $page)
                                        <tr>
                                            <td>
                                                {{ $page->title }}
                                            </td>
                                            <td>
                                                <code class="text-danger">
                                                    {{ url('/') }}/pages/{{ $page->slug }}
                                                </code>
                                            </td>
                                            <td>
                                                @if ($page->show_at_nav == 1)
                                                    <span class="badge bg-lime text-lime-fg">Yes</span>
                                                @else
                                                    <span class="badge bg-pink text-red-fg">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($page->status == 1)
                                                    <span class="badge bg-lime text-lime-fg">Yes</span>
                                                @else
                                                    <span class="badge bg-pink text-red-fg">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.custom-page.edit', $page->id) }}"
                                                    class="btn-sm btn-primary"><i class="ti ti-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.custom-page.destroy', $page->id) }}"
                                                    class="btn-sm text-danger delete-item"><i class="ti ti-trash-x"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No Data Found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $customPages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
