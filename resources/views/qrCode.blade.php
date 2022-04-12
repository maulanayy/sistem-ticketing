<!DOCTYPE html>

<html>

<head>

    <title>How to Generate QR Code in Laravel 8? - ItSolutionStuff.com</title>

</head>

<body>

    

<div class="visible-print text-center">

    <h2>NAMA : {{$ticket->nama_customer}}</h2>
     
    {!! QrCode::size(250)->generate($ticket->ticket_code); !!}

     
</div>

    

</body>

</html>