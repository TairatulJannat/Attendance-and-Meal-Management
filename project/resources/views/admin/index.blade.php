<x-admin-master>
    @section('content')


        
        <!-- <h1 class="h3 mb-4 text-gray-800">Dashboard</h1> -->

        <!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="{{asset('dashboard/dashboard.css')}}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  .column1 {
    width: 100%;
    height: 200px;
    display: block;
    margin-bottom: 10px;
    height: auto;
    margin-top: 0px;
    margin-left:0px:
    background-color: red; /* For browsers that do not support gradients */
  background-image: linear-gradient(to right, red , yellow);
  margin-left: 277px;
  }
  .card1 {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 20px;
  text-align: center;
  /* background-image: linear-gradient(to right, rgb(233, 84, 84) , rgb(94, 0, 78)); */
  background-color:  RoyalBlue; 
  color: white;
  width: 100%;
  height: 30%;
  display: flex;
  margin-top: 0px;
}


.card1:hover {
  background-color: DodgerBlue;
}
.btn {
  background-color: DodgerBlue;
  border: none;
  color: white;
  padding: 50px 60px;
  font-size: 20px;
  cursor: pointer;
  margin: 50px 40px 0px 80px;
} 

/* Darker background on mouse-over */
.btn:hover {
  background-color: RoyalBlue;
}

  
.btn1 {
  background-color: navy;
  border: none;
  color: white;
  padding: 50px 60px;
  font-size: 30px;
  text-align: center;
  cursor: pointer;
  margin: 50px 40px 0px 80px;
}

/* Darker background on mouse-over */
 .btn1:hover {
  background-color: mediumblue;
}


</style>
</head>
<body>

@if(auth()->user()->userHasRole('Manager'))

<div class="row">
  <div class="col-sm-4">
  <a href="{{route('guest.employee')}}"><button style="width: 70%; font-size:100%;" class="btn"><i class="fas fa-user-plus fa-2x"></i><br><br>EMPLOYEE GUEST</button></a>
  </div>
  <div class="col-sm-4">
  <a href="{{route('guest.management')}}"><button style="width: 70%; font-size:100%;" class="btn"><i class="fas fa-user-cog fa-2x"></i><br><br>MANAGEMENT GUEST</button></a>
  </div>
  <div class="col-sm-4">
  <a href="{{route('guest.special')}}"><button width=50 height=20 style="width: 70%; font-size:100%;" class="btn"><i class="fas fa-user-lock fa-2x" ></i><br><br>SPECIAL GUEST</button></a>
  </div>
</div>


<div class="row">
  <div class="col-sm-4">
    <a href="{{route('admin.today_emp_guest')}}"><button style="width:70% ; font-size: 300%;" class="btn1" ><b>{{$employee_guests->count()}}</b></button></a>
  </div>
  <div class="col-sm-4">
  <a href="{{route('admin.today_management_guest')}}"><button style="width: 70%; font-size: 300%;" class="btn1"><b>{{$management_guests->count()}}</b></button></a>
  </div>
  <div class="col-sm-4">
  <a href="{{route('admin.today_special_guest')}}"><button style="width: 70%; font-size: 300%;" class="btn1"><b> {{$special_guests->count()}}</b></button></a>
  </div>
</div>
<br>
<br>

@endif


@if(auth()->user()->userHasRole('Admin'))
<div class="row">
<div style="width:100%;margin-left:-150px;margin-right:100px;" class="col-sm-4" >
  <div  class="column1">
    <div class="card1" >
      <h2><b>Today's Total Guest</b></h2>
      <h1 style="margin-left:0px; width:300px; height: 120px;">{{$today_total_guests->count()}}</h1>
    </div>
  </div>
</div>
<div class="col-sm-4">
  <div class="column1">
    <div class="card1">
      <h3><b>Today's Total Employee</b></h3>
      <h1 style="margin-left: 10px; width:300px;height: 120px;">{{$today_total_emp->count()}}</h1>
    </div>
  </div>
</div>
</div>



<div class="row">
  <div class="col-sm-4">
    <a href="{{route('admin.today_emp_guest')}}"><button  style="width: 70%; font-size:20px;" class="btn1">Today's Employee Guest : {{$employee_guests->count()}}</button></a>
  </div>
  <div class="col-sm-4">
  <a href="{{route('admin.today_management_guest')}}"><button style="width: 70%; font-size:20px;" class="btn1">Today's Management Guest : {{$management_guests->count()}}</button></a>
  </div>
  <div class="col-sm-4">
  <a href="{{route('admin.today_special_guest')}}"><button style="width: 70%; font-size:20px;" class="btn1">Today's Special Guest : {{$special_guests->count()}}</button></a>
  </div>
</div>


@endif
<br>
<br>
</body>
</html>













       


    @endsection


</x-admin-master>