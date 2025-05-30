@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Contact Cards</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.contact.create') }}" class="btn btn-primary">
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
                                        <th>Icon</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contactCards as $card)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($card->icon) }}" alt="{{ $card->title }}"
                                                    style="width: 50px !important;">
                                            </td>
                                            <td>
                                                {{ $card->title }}
                                            </td>
                                            <td class="">
                                                {!! $card->status
                                                    ? '<span class="badge bg-lime text-lime-fg"> Yes</span>'
                                                    : '<span class="badge bg-pink text-red-fg"> No </span>' !!}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.contact.edit', $card->id) }}"
                                                    class="btn-sm btn-primary"><i class="ti ti-edit"></i></a>
                                                <a href="{{ route('admin.contact.destroy', $card->id) }}"
                                                    class="btn-sm text-danger delete-item"><i class="ti ti-trash-x"></i></a>
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
                <div class="mt-3">
                    {{-- {{ $cards->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
