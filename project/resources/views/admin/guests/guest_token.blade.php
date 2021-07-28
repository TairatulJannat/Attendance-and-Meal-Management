<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    
</head>

<style>
/* @page{
    width: 80mm;
    height: 100mm;
    margin:0;
} */

</style>

<!-- print guest data -->
<body>
<h2>TOKEN NO: {{$users->id}}</h2>
<h6>Guest Name: {{$users->name}}</h6>
<h6>Employee Refer ID: {{$users->user_ref_id}}</h6>
<h6>Phone Number: {{$users->phone_number}}</h6>
<h6>Date&Time: {{$users->created_at}}</h6>
<button onclick="window.print();" class="btn btn-primary" id="print-btn">GLOBE GROUP LTD.</button>
        <script src="{{ asset('js/app.js') }}" type="text/js"></script>

</body>
</html>