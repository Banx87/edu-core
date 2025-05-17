<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayoutGateway;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Finally_;
use Stripe\Payout;

class PayoutGatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $gateways = PayoutGateway::all();
        return view('admin.payout-gateway.index', compact('gateways'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.payout-gateway.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gateway_name' => 'required|string|max:255|unique:payout_gateways',
            'status' => 'required|boolean',
        ]);

        $gateway = new PayoutGateway();
        $gateway->gateway_name = $request->input('gateway_name');
        $gateway->status = $request->input('status');
        $gateway->save();

        notyf()->success('Payout Gateway created successfully.');
        return redirect()->route('admin.payout-gateway.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PayoutGateway $payout_gateway): View
    {
        return view('admin.payout-gateway.edit', compact('payout_gateway'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PayoutGateway $payout_gateway)
    {
        $request->validate([
            'gateway_name' => 'required|string|max:255|unique:payout_gateways',
            'status' => 'required|boolean',
        ]);

        $payout_gateway->gateway_name = $request->input('gateway_name');
        $payout_gateway->status = $request->input('status');
        $payout_gateway->save();

        notyf()->success('Payout Gateway updated successfully.');
        return redirect()->route('admin.payout-gateway.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PayoutGateway $payout_gateway)
    {
        try {
            $payout_gateway->delete();
            notyf()->success('Payout Gateway deleted successfully.');
            return response()->json(['success' => 'Payout Gateway deleted successfully.']);
        } catch (Exception $e) {
            logger()->error('Error deleting payout gateway: ' . $e->getMessage());
            notyf()->error('Payout Gateway cannot be deleted.');
            return response()->json(['error' => 'Payout Gateway cannot be deleted.'], 422);
        }
    }
}
