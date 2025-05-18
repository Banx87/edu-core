<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WithdrawRequestController extends Controller
{
    function index(): View
    {
        $withdrawalRequests = Withdraw::with('instructor')->paginate(25);
        return view('admin.withdraw-request.index', compact('withdrawalRequests'));
    }

    function show(Withdraw $withdrawal): View
    {
        return view('admin.withdraw-request.show', compact('withdrawal'));
    }



    function updateStatus(Request $request, Withdraw $withdrawal): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // Update the withdrawal request status
        $withdrawal->update([
            'status' => $request->status,
        ]);

        // subtract the amount from instructor's wallet
        if ($request->status == 'approved') {
            $withdrawal->instructor->decrement('wallet', $withdrawal->amount);
            $withdrawal->instructor->save();
        }

        $withdrawal->save();

        notyf()->success('Withdrawal request status updated successfully.');

        return redirect()->route('admin.withdraw-request.index');
    }
}