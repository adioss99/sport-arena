@extends('user.dashboard') @section('content')
<section>
    <div class="flex flex-col justify-center items-center gap-2 p-4 w-full">
        <h1 class="text-lg font-bold">Payment</h1>
        <p class="text-md text-slate-500">
            Please complete your payment to confirm your booking.
        </p>
        <div
            class="flex flex-col gap-2 border-1 border-indigo-500 rounded-md p-4 w-5/6 sm:w-1/2"
        >
            <p class="text-sm">
                Booking code:<span class="font-semibold">
                    {{ $booking->booking_code }}</span
                >
            </p>
            <p class="text-sm">
                Booking date:
                <span class="font-semibold"> {{ $booking->boking_date }}</span>
            </p>
            <p class="text-sm">
                Total price:
                <span class="font-semibold">
                    @currency($booking->total_price)
                </span>
            </p>
            <p class="text-sm">
                Customer name:
                <span class="font-semibold"> {{ $booking->user->name }}</span>
            </p>
            <p class="text-sm">
                Customer email:
                <span class="font-semibold"> {{ $booking->user->email }}</span>
            </p>
            <button
                class="mt-2 border-1 bg-slate-50 border-indigo-700 text-indigo-700 hover:bg-indigo-700 hover:text-white rounded-md p-2 py-1"
                id="pay-button"
            >
                Pay
            </button>
        </div>
    </div>
</section>
@endsection @push('scripts')
<script
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"
></script>
<script type="text/javascript">
    document.getElementById("pay-button").onclick = function () {
        // SnapToken acquired from previous step
        snap.pay("{{ $booking->snap_token }}", {
            // Optional
            onSuccess: function (result) {
                /* You may add your own js here, this is just example */
                window.location.href =
                    " {{ route( 'payment.success',$booking->booking_code) }}";
            },
        });
    };
</script>
@endpush
