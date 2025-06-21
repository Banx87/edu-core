@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Testimonials</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.testimonial-section.create') }}" class="btn btn-primary">
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Title</th>
                                        <th>Rating</th>
                                        <th>Review</th>
                                        <th>Logo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($testimonials as $testimonial)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}"
                                                    class="img-fluid w-100" style="max-width: 50px" />
                                            </td>
                                            <td>{{ $testimonial->name }}</td>
                                            <td>{{ $testimonial->title }}</td>
                                            <td style="min-width: 145px">
                                                @for ($i = 0; $i < $testimonial->rating; $i++)
                                                    <i class="ti ti-star" style="color: gold; font-size: 15px"></i>
                                                @endfor
                                            </td>
                                            <td>{{ \Illuminate\Support\Str::limit($testimonial->review, 150, '...') }}</td>
                                            <td>
                                                <img src="{{ asset($testimonial->logo) }}" alt="{{ $testimonial->logo }}"
                                                    class="img-fluid w-100" style="max-width: 50px" />
                                            </td>
                                            <td style="min-width: 100px">
                                                <a href="{{ route('admin.testimonial-section.edit', $testimonial->id) }}"
                                                    class="btn-sm btn-primary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.testimonial-section.destroy', $testimonial->id) }}"
                                                    class="btn-sm text-danger delete-item">
                                                    <i class="ti ti-trash-x"></i></a>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No testimonials found.</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    {{ $testimonials->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
