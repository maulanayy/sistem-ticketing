<!DOCTYPE html>

<html>

<head>

    <title>Print QR</title>

</head>

<body>

<div class="visible-print text-center">
</br>
</br>
</br>
    <h1>COUNTING TICKET<h1>
    </br>
    <h1>{{$ticket->nama_customer}}</h1>
    </br>
    <h1>{{$ticket->amount-$ticket->amount_scanned}}</h1>
    </br>
    <h1>{{$ticket->created_at}}</h1>
</div>

</body>

</html>

<style>
    h1 {text-align: center;}
</style>