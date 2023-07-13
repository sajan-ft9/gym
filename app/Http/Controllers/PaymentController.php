<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Payment;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paymentFields = $request->validate([
            'member_id' => 'required|exists:members,id',
            'paid_amount' => 'required|numeric|min:0|max:100000',
            'remaining_amount' => 'required|numeric|min:0|max:100000',
            'remarks' => 'required|string|max:255',
        ]);

        $subFields = $request->validate([
            'member_id' => 'required|exists:members,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date'
        ]);

        $paymentFields['payment_date'] = Carbon::now()->toDateTimeString();


        DB::beginTransaction();

        try {

            Payment::create($paymentFields);
            Subscription::create($subFields);


            DB::commit();

            return redirect()->back()->with('success', 'Payment done ssuccessfully');
        } catch (Exception $e) {

            DB::rollBack();
            return redirect()->back()->with('danger', 'Payment failed');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
