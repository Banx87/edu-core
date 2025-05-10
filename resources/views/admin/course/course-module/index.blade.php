@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Course Levels</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
                                <i class="ti ti-plus mr-3"></i>
                                Add New Course
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
                                                <a href="{{ route('admin.courses.edit', ['id' => $course->id, 'step' => 1]) }}"
                                                    class="btn-sm btn-primary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                {{-- <a href="{{ route('admin.courses.destroy', $course->id) }}"
                                                    class="btn-sm text-danger delete-item"> <i
                                                        class="ti ti-trash-x"></i></a> --}}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No courses found.</td>
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
