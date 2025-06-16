<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;

class DatabaseResetController extends Controller
{
    function index(): View
    {
        return view("admin.database-reset.index");
    }
    function destroy(Request $request)
    {
        try {
            Artisan::call('migrate:fresh --seed');
            Artisan::call('optimize:clear');

            return response()->json(['status' => 'success', 'message' => 'Database reset successfully.']);
        } catch (\Throwable $th) {
            logger('th');
            throw $th;
        }
    }
}