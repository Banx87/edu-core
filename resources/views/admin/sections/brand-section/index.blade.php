@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Brand Section</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.brand-section.create') }}" class="btn btn-primary">
                                <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                                Add New
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Url</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($brands as $brand)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($brand->image) }}" alt="{{ $brand->name }}"
                                                    class="img-fluid w-100" style="max-width: 75px" />
                                            </td>
                                            <td>
                                                {{ $brand->url }}
                                            </td>
                                            <td>
                                                @if ($brand->status == 1)
                                                    <span class="badge bg-green text-green-fg">Active</span>
                                                @elseif ($brand->status == 0)
                                                    <span class="badge bg-red text-red-fg">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.brand-section.edit', $brand->id) }}"
                                                    class="btn-sm btn-primary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.brand-section.destroy', $brand->id) }}"
                                                    class="btn-sm text-danger delete-item">
                                                    <i class="ti ti-trash-x"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No levels found.</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- <div class="mt-3">
                    {{ $brands->links() }}
                </div> --}}
            </div>
        </div>
    </div>
@endsection
