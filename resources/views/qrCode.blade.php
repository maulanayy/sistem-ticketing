<!DOCTYPE html>
<html>

<head>
    <title>Print QR</title>
</head>

<body>
    <div class="row">
        <div style="max-width:80mm !important;  margin: 0 auto 0 auto; vertical-align: top; border-style: solid;border-width: 1px;">
            <div style="widht:80mm; margin-left: 15px; margin-top:10px;margin-bottom:0px">
                <div style="float: left;">
                    <img src="{{ asset('/images/Logo_2.png') }}" width="80" width="80" alt="The Logo" class="brand-image" style="opacity: .8">
                </div>
                <div style="float: right; margin-right:5px">
                    <p style="font-size: 8.5pt;text-transform: uppercase; margin: 1px 1px 1px 1px;">TAMAN WISATA ALAM SEVILLAGE</p>
                    <p style="font-size: 8.5pt; margin-top:1px;margin-bottom: 5px;">Tanggal {{$ticket->created_at}} </p>
                    <p style="font-size: 8.5pt;font-weight: bold;text-transform: uppercase;margin: 1px 1px 5px 1px;">- CASHIER </p>
                </div>
            </div>
            
            <div style="widht:80mm; font-size:8pt; padding:2mm 0 2mm 0; margin-top: 60px; margin-bottom: 0px; ">
                <hr style="border-style: dashed;">
                <p style="font-size:8.5pt;font-weight:bold;margin-left:30px;margin-bottom:0px">Struk Pembelian</p>
                <p style="font-size:8.5pt;margin-left:30px;margin-top:5px;margin-bottom:0px">Pengunjung {{$ticket->amount}} Rp.{{$ticket_detail->harga*$ticket->amount}}</p>
                <p style="font-size:8.5pt;margin-left:30px;margin-top:5px;margin-bottom:0px">Discount 0</p>
                <br>
                <p style="font-size:8.5pt;margin-top:5px;margin-left:30px;margin-bottom:0px">TOTAL Rp.{{$ticket->harga_ticket}}</p>
                <p style="font-size:8.5pt;margin-left:30px;margin-top:5px;margin-bottom:0px">Diterima Rp.{{$ticket->cash}}</p>
                <p style="font-size:8.5pt;margin-left:30px;margin-top:5px">Kembali Rp.{{$ticket->kembalian}}</p>
                <p style="font-size:8.5pt;text-align: center;margin-top:5px">*** Terima Kasih ***</p>
                <hr style="border-style: dashed;">
                <p style="font-size:6.5pt;text-align: center;margin-top:5px">Taman Wisata Alam Sevillage " Tiket berlaku satu kali masuk "</p>
                <hr style="border-style: dashed;">
                <p style="text-align: center;margin-top:15px;margin-bottom:15px">
                    {!! QrCode::size(100)->generate($ticket->ticket_code) !!}
                </p>
                <hr style="border-style: dashed;">
                <p style="font-size:6.5pt;text-align: center;margin-top:5px;margin-bottom:0px">Taman Wisata Alam Sevillage " Barcode hanya buat buka gate "</p>
            </div>
{{--             
            <div style="text-align: center; margin-top:50px">
                <p>Struk Pembelian</p>
                <p style="font-size: 8.5pt">{!! QrCode::size(80)->generate($ticket->ticket_code) !!}</p>
            </div> --}}
        </div>
       
    </div>
    {{-- <div class="visible-print text-center">

        <h2>NAMA : {{ $ticket->nama_customer }}</h2>
        {!! QrCode::size(150)->generate($ticket->ticket_code) !!}

    </div> --}}

</body>

</html>
