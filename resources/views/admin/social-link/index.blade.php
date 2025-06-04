@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Social Links</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.social-links.create') }}" class="btn btn-primary">
                                <i class="ti ti-plus"></i>
                                Add New Social Link
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Icon</th>
                                        <th>Url</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($socialLinks as $social)
                                        <tr>
                                            <td style="background-color: #cfcfcf; width: 65px !important;">
                                                @if (preg_match('/\.(png|jpg|jpeg|gif|bmp|svg)$/i', $social->icon))
                                                    <img src="{{ asset($social->icon) }}" alt="{{ $social->name }}"
                                                        style="width: 25px !important">
                                                @else
                                                    <i class="{{ $social->icon }}" style="font-size: 25px !important "></i>
                                                @endif

                                            </td>
                                            <td>
                                                {{ $social->url }}
                                            </td>
                                            <td class="">
                                                {!! $social->status
                                                    ? '<span class="badge bg-lime text-lime-fg">Yes</span>'
                                                    : '<span class="badge bg-pink text-red-fg">No</span>' !!}
                                            </td>
                                            <td style="min-width: 150px;">
                                                <a href="{{ route('admin.social-links.edit', $social->id) }}"
                                                    class="btn-sm btn btn-ghost-primary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.social-links.destroy', $social->id) }}"
                                                    class="btn-sm btn btn-ghost-danger delete-item">
                                                    <i class="ti ti-trash-x"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No categories found.</td>
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
