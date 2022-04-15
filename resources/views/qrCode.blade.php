<!DOCTYPE html>

<html>

<head>

    <title>Print QR</title>

</head>

<body>

<div class="visible-print text-center">

    <h2>NAMA : {{$ticket->nama_customer}}</h2>
    {!! QrCode::size(150)->generate($ticket->ticket_code); !!}

</div>

</body>

</html>