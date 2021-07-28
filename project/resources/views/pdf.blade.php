<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <h4>Employee name: {{$employee->name}} </h4>
    <h4>Employee Refer ID:{{$employee->emp_ref_id}} </h4>
    <h4>Employee Join Time: {{$employee->created_at}}</h4>
    <a href="{{route('print.page')}}">Print</a>
</head>
<body>
    
</body>
</html>