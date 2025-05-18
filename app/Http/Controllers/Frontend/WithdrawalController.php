<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    function index(): View
    {
        return view('frontend.instructor-dashboard.withdrawal.index');
    }

    function requestPayoutIndex(): View
    {
        $instructor = Auth::user();
        $currentBalance = Auth::user()->wallet;
        $pendingBalance = Withdraw::where('instructor_id', $instructor->id)
            ->where('status', 'pending')
            ->sum('amount');
        $totalPayout =  Withdraw::where('instructor_id', $instructor->id)
            ->where('status', 'approved')
            ->sum('amount');
        return view('frontend.instructor-dashboard.withdrawal.request-payout', compact('currentBalance', 'pendingBalance', 'totalPayout'));
    }

    function requestPayout(Request $request): RedirectResponse
    {
        $request->validate([
            'amount' => 'required|numeric|min:1|max:' . Auth::user()->wallet,
            // 'payout_gateway' => 'required|string',
        ]);

        // Check if the instructor has already requested a payout
        $pendingWithdrawals = Withdraw::where('instructor_id', Auth::user()->id)
            ->where('status', 'pending')
            ->count();
        if ($pendingWithdrawals > 0) {
            notyf()->error('You already have a pending payout request.');
            return redirect()->back();
        }

        Withdraw::create([
            'instructor_id' => Auth::user()->id,
            'amount' => $request->amount,
            // 'payout_gateway' => $request->payout_gateway,
        ]);

        notyf()->success('Payout request submitted successfully.');
        return redirect()->back();
    }
}