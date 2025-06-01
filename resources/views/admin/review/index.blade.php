@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Course Levels</h3>
                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Icon</th>
                                        <th>Course</th>
                                        <th>User</th>
                                        <th>Rating</th>
                                        <th>Review</th>
                                        <th></th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($reviews as $review)
                                        <tr>
                                            <td style="width: 50px !important; height: 50px !important;">
                                                <img src="{{ asset($review->course->thumbnail) }}" alt="">
                                            </td>
                                            <td>
                                                {{ $review->course->title }}
                                                <div class="text-muted">{{ $review->course->instructor->name }}</div>
                                            </td>
                                            <td>
                                                {{ $review->user->name }}
                                                <div class="text-muted">{{ $review->user->email }}</div>
                                            </td>
                                            <td>
                                                @for ($i = 1; $i <= $review->rating; $i++)
                                                    <i class="ti ti-star-filled"
                                                        style="color: #f1cd00; font-size: 12px;"></i>
                                                @endfor
                                            </td>
                                            <td style="min-width: 350px">
                                                {{ $review->review }}
                                            </td>
                                            <td>
                                                @if ($review->status == '0')
                                                    <span class="badge bg-yellow text-yellow-fg">Pending</span>
                                                @elseif($review->status == '1')
                                                    <span class="badge bg-success text-green-fg">Approved</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.reviews.update', $review->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="status" onchange="this.form.submit()">
                                                        <option value="0" @selected($review->status == 0)>Pending</option>
                                                        <option value="1" @selected($review->status == 1)>Approved
                                                        </option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.reviews.destroy', $review->id) }}"
                                                    class="btn-sm text-danger delete-item">
                                                    <i class="ti ti-trash-x"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No reviews found.</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    {{ $reviews->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
