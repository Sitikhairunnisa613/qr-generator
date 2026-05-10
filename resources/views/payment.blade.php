<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
</head>

<body style="background:#ffe4f1;font-family:Arial;text-align:center;padding:50px">

    <div style="background:white;padding:25px;border-radius:20px;display:inline-block">

        <h2 style="color:#ff69b4">PAYMENT PAGE</h2>

        <p><b>ID:</b> {{ $payment->invoice_id }}</p>
        <p><b>Nominal:</b> Rp {{ $payment->nominal }}</p>

        <p>
            <b>Status:</b>
            @if($payment->status == 'PAID')
                <span style="color:green">PAID</span>
            @else
                <span style="color:red">PENDING</span>
            @endif
        </p>

        @if($payment->status != 'PAID')
        <a href="/payment/paid/{{ $payment->invoice_id }}">
            <button style="background:#ff69b4;color:white;border:none;padding:10px 20px;border-radius:10px;">
                BAYAR SEKARANG
            </button>
        </a>
        @else
            <h3 style="color:green">Pembayaran Selesai</h3>
        @endif

    </div>

</body>
</html>