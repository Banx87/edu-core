@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Footer Column Two</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.footer-column-two.create') }}" class="btn btn-primary">
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
                                        <th>Url</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($columnTwo as $column)
                                        <tr>
                                            <td>
                                                {{ old('title', $column->title) }}
                                            </td>
                                            <td>
                                                {{ old('url', $column->url) }}
                                            </td>
                                            <td>
                                                @if ($column->status == 1)
                                                    <span class="badge bg-lime text-lime-fg">Yes</span>
                                                @else
                                                    <span class="badge bg-pink text-red-fg">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.footer-column-two.edit', $column->id) }}"
                                                    class="btn-sm btn-primary"><i class="ti ti-edit"></i></a>
                                                <a href="{{ route('admin.footer-column-two.destroy', $column->id) }}"
                                                    class="btn-sm text-danger delete-item"><i class="ti ti-trash-x"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No Columns found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
