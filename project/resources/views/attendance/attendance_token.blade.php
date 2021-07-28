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

<!-- print employee data -->
<body>
<h2>TOKEN NO: {{$user->id}}</h2> 
<h6>Name: {{$user->name}}</h6>
<h6>Department: {{$user->department}}</h6>
<h6>Designation: {{$user->designation}}</h6>
<h6>Date&Time: {{$attendance->date}}</h6>
<button onclick="window.print();" class="btn btn-primary" id="print-btn">Welcom To Our Company</button>
        <script src="{{ asset('js/app.js') }}" type="text/js"></script>

</body>
</html>