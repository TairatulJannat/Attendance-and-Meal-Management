<x-admin-master>
@section('content')
<h1 style="color:blue">GUEST REPORT</h1>

@if(auth()->user()->userHasRole('Admin'))

<form  method="post" action="{{route('report.generates')}}" enctype="multipart/form-data">
@csrf
<div class="form-group" style="color:black;">
<label for="title"><b>Employee</b></label>
<select id="employee" name="emp_search" style="width:42%">
       <option value="all">All</option>
       <option value="single">Single</option>
</select>
</div>


<div class="form-group" style="color:black;">
<label for="title"><b>Employeement ID (for single search)</b></label>
<input type="text"  style="width:50%" class="form-control" name="user_refer_id" id="title" aria-describedby="" placeholder="Enter id">
</div>

<div class="form-group" style="color:black;">
<label for="title"><b>From</b></label>
<input type="date" style="width:50%" class="form-control" name="from_date" id="title" aria-describedby="" placeholder="date">
</div>

<div class="form-group" style="color:black;">
<label for="title"><b>To</b></label>
<input type="date" style="width:50%" class="form-control" name="To_date" id="title" aria-describedby="" placeholder="date">
</div>

<div class="wsite-form-radio-container">

<label class="wsite-form-label" style="width: 100%; color:blue">Please submit</label><br>
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>



</form>

@endif


@endsection 

</x-admin-master>


