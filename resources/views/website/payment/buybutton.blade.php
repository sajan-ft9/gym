@php
$tuid = now()->timestamp;
$message = "total_amount=$course->price,transaction_uuid=$tuid,product_code=EPAYTEST";
$s = hash_hmac('sha256', $message, '8gBm/:&EnhH.1/q', true);
$signature = base64_encode($s);
session()->put('course', $course->id);
@endphp
<form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST" class="border p-4 rounded shadow-sm">
    <div class="row">
        <!-- Course Price -->
        <input type="hidden" id="amount" name="amount" class="form-control" value="{{ $course->price }}" required>
        <!-- Tax Amount -->

        <input type="hidden" id="tax_amount" name="tax_amount" class="form-control" value="0" required>

        <!-- Total Amount -->

        <input type="hidden" id="total_amount" name="total_amount" class="form-control" value="{{ $course->price }}"
            required>


        <!-- Transaction UUID -->

        <input type="hidden" id="transaction_uuid" name="transaction_uuid" class="form-control"
            value="{{ $tuid }}" required>


        <!-- Product Code -->

        <input type="hidden" id="product_code" name="product_code" class="form-control" value="EPAYTEST" required>


        <!-- Service Charge -->

        <input type="hidden" id="product_service_charge" name="product_service_charge" class="form-control"
            value="0" required>


        <!-- Delivery Charge -->

        <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" class="form-control"
            value="0" required>


        <!-- Success URL -->

        <input type="hidden" id="success_url" name="success_url" class="form-control"
            value="{{ route('website.payment.success') }}" required>


        <!-- Failure URL -->

        <input type="hidden" id="failure_url" name="failure_url" class="form-control"
            value="{{ route('website.payment.failure') }}" required>


        <!-- Signed Field Names -->



        <input type="hidden" id="signed_field_names" name="signed_field_names" class="form-control"
            value="total_amount,transaction_uuid,product_code" required>

        <!-- Signature -->


        <input type="hidden" id="signature" name="signature" class="form-control" value="{{ $signature }}" required>

    </div>

    <!-- Submit Button -->
    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary btn-lg w-100">
            {{ $title ?? 'Buy' }}
        </button>
    </div>
</form>
