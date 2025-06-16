@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Database Reset</h3>
                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="database-reset-submit">
                            @csrf
                            @method('DELETE')
                            <h4 class="alert alert-danger">
                                Warning: This will reset all data in the database! <br /> This action cannot be
                                undone.
                            </h4>
                            <button type="submit" id="db_reset_btn" class="btn btn-danger">
                                <i class="ti ti-skull me-3"></i>
                                Reset Entire Database
                                <i class="ti ti-skull ms-3"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
