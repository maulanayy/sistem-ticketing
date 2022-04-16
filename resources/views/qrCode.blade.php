<!DOCTYPE html>
<html>

<head>
    <title>Print QR</title>
</head>

<body>
    <div class="row">
        <div style="max-width:80mm !important; height:100mm; margin: 0 auto 0 auto; vertical-align: top; border-style: solid;">
            <div style="float: left; margin-left: 15px; margin-top:10px">
                <img src="{{ asset('/images/Logo_2.png') }}" width="80" width="80" alt="The Logo" class="brand-image" style="opacity: .8">
            </div>
            <div style="float: right; margin-right:10px">
                <p style="font-size: 8.5pt;text-transform: uppercase; ">TAMAN WISATA ALAM SEVILLAGE</p>
                <p style="font-size: 8.5pt; margin-top:1px">Tanggal {{$ticket->created_at}} </p>
                <p style="font-size: 8.5pt;font-weight: bold;text-transform: uppercase;">-CASHIER </p>
            </div>
            <div style="text-align: center;margin: 0 10mm 0 10mm;">
                <p style="font-size: 8.5pt;font-weight:bold;">Struk Pembelian</p>
            </div>
            <div style="text-align: center;margin: 0 10mm 0 10mm;">
                <p style="font-size: 8.5pt">{!! QrCode::size(80)->generate($ticket->ticket_code) !!}</p>
            </div>
        </div>
       
    </div>
    {{-- <div class="visible-print text-center">

        <h2>NAMA : {{ $ticket->nama_customer }}</h2>
        {!! QrCode::size(150)->generate($ticket->ticket_code) !!}

    </div> --}}

</body>

</html>
