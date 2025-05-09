@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Course Levels</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.course-levels.create') }}" class="btn btn-primary">
                                <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                                Add New Course Level
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Instructor</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Approved</th>
                                        <th>Action</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($courses as $course)
                                        <tr>
                                            <td>
                                                {{ $course->title }}
                                            </td>
                                            <td>
                                                {{ $course->instructor->name }}
                                            </td>
                                            <td>
                                                {{ $course->instructor->price }}
                                            </td>
                                            <td>
                                                @if ($course->is_approved == 'pending')
                                                    <span class="badge bg-yellow text-yellow-fg">Pending</span>
                                                @elseif($course->is_approved == 'approved')
                                                    <span class="badge bg-green text-green-fg">Approved</span>
                                                @elseif($course->is_approved == 'rejected')
                                                    <span class="badge bg-red text-red-fg">Rejected</span>
                                                @endif

                                            </td>
                                            <td>
                                                <select name="" class="form-control update-approval-status"
                                                    data-id="{{ $course->id }}">
                                                    <option @selected($course->is_approved == 'pending') value="pending">Pending</option>
                                                    <option @selected($course->is_approved == 'approved') value="approved">Approved</option>
                                                    <option @selected($course->is_approved == 'rejected') value="rejected">Rejected</option>
                                                </select>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.courses.create', $course->id) }}"
                                                    class="btn-sm btn-primary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.course-levels.destroy', $course->id) }}"
                                                    class="btn-sm text-danger delete-item"> <i
                                                        class="ti ti-trash-x"></i></a>
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
                    {{-- {{ $courses->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('header_scripts')
    @vite('resources/js/admin/course.js')
@endpush
