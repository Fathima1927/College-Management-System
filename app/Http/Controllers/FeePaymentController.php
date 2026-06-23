<?php

namespace App\Http\Controllers;

use App\Models\FeePayment;
use Illuminate\Http\Request;

class FeePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $payments = FeePayment::all();
    return view('fee-payments.index', compact('payments'));
}

public function create()
{
    return view('fee-payments.create');
}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    FeePayment::create([
        'student_name' => $request->student_name,
        'fee_name' => $request->fee_name,
        'amount' => $request->amount,
        'payment_mode' => $request->payment_mode,
        'status' => $request->status,
        'payment_date' => $request->payment_date,
    ]);

    return redirect()->route('fee-payments.index');
}

    /**
     * Display the specified resource.
     */
    public function show(FeePayment $feePayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeePayment $feePayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FeePayment $feePayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeePayment $feePayment)
    {
        //
    }

    public function pending()
{
    $payments = FeePayment::where('status', 'Pending')->get();

    return view('fee-payments.pending', compact('payments'));
}
 
    public function paid()
{
    $payments = FeePayment::where('status', 'Paid')->get();

    return view('fee-payments.paid', compact('payments'));

}
}