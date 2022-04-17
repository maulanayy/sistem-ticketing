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
    <div id="bodyData">
        <h1 style="font-size: 75px;margin-top:0px;margin-bottom:0px"> SELEMAT DATANG</h1>
        <center>
        <img src="{{ asset('/images/Logo_2.png') }}"width="1080" width="1080" alt="The Logo" class="brand-image" style="opacity: .8;text-align:center;margin-top:100px">
        </center>
    </div>  

</body>

</html>

<style>
    h1 {text-align: center;}
</style>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    setInterval(function(){ 
        console.log("WAW")
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: 'group-last',
            dataType: 'json',
            success: function (data) {  
                console.log(data)
                const now = new Date();
                const update = new Date(data.updated_at)
                const between = now-update
                var bodyData = '';
                $("#bodyData").html(bodyData);
                if (between < 60000){

                    bodyData = `
                    <h1>COUNTING TICKET<h1>
                        </br>
                        <h1>${data.nama_customer}</h1>
                        </br>
                        <h1>${data.amount-data.amount_scanned}</h1>
                        </br>
                    <h1>${data.updated_at}</h1>
                    `
                    $("#bodyData").html(bodyData);
                }else{
                    bodyData = `<h1 style="font-size: 75px;margin-top:0px;margin-bottom:0px"> SELEMAT DATANG</h1>
                    <center>
                    <img src="{{ asset('/images/Logo_2.png') }}"width="1080" width="1080" alt="The Logo" class="brand-image" style="opacity: .8;text-align:center;margin-top:100px">
                    </center>
                    `
                    $("#bodyData").html(bodyData);
                }
            },error:function(){ 
                console.log(data);
            }
        });
    }, 2000);
});
</script>