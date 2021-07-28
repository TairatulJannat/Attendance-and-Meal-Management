<x-admin-master>
@section('content')
@if(auth()->user()->userHasRole('Manager'))
<h1 style="color:blue">Employee</h1>

<div class="row">
<div class="col-sm-6">
<form  method="post" action="" enctype="multipart/form-data">
@csrf
<div class="form-group" style="color:black;">
    <label for="title"><b>Name</b></label>
    <input type="text" style="width:50%" class="form-control" name="name" id="title" aria-describedby="" placeholder="Enter employee name">
</div>

<div class="form-group" style="color:black;">
    <label for="title"><b>Department</b></label>
    <input type="text"  style="width:50%" class="form-control" name="department_name" id="title" aria-describedby="" placeholder="department">
</div>

<div class="form-group" style="color:black;">
    <label for="title"><b>Designation</b></label>
    <input type="text"  style="width:50%" class="form-control" name="designation" id="title" aria-describedby="" placeholder="Enter designation">
</div>
<div class="form-group" style="color:black;">
    <label for="title"><b>Phone Number</b></label>
    <input type="text"  style="width:50%" class="form-control" name="emp_phone_number" id="title" aria-describedby="" placeholder="Enter employee phone number">
</div>


</div>

<div class="col-sm-6">

<div class="form-group" style="color:black;">
    <label for="title"><b>Email</b></label>
    <input type="text"  style="width:50%" class="form-control" name="emp_email" id="title" aria-describedby="" placeholder="Enter employee email">
</div>


<div class="form-group" style="color:black;">
    <label for="title"><b>Employee Id</b></label>
    <input type="text"  style="width:50%" class="form-control" name="emp_id" id="title" aria-describedby="" placeholder="Enter employee id">
</div>


<div class="form-group" style="color:black;">
    <label for="file"><b>Image</b></label>
    <input type="file"   style="width:50%" class="form-control" name="employee_image" id="employee_image">
</div>


</div>


</div>

</form>


<div class="wsite-form-radio-container">

<label class="wsite-form-label" style="width: 100%; color:blue">Please submit</label><br>
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>

@endif
@endsection 

</x-admin-master>