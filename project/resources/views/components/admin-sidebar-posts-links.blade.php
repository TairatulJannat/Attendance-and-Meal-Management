

<!-- Management_sidebar -->
@if(auth()->user()->userHasRole('Manager'))
<li class="nav-item">
  <a  href="{{route('admin.index')}}" data-toggle="collapse" data-target="#collapseone" aria-expanded="true" aria-controls="collapseone">
   

   <a class="nav-link collapsed" href="{{route('employee.view_employee')}}" style="color: white;"> <i class="fas fa-user-friends"></i><span>Employee</span></a> 
   <a class="nav-link collapsed" href="{{route('attendance.index')}}" style="color: white;"> <i class="fas fa-user-check"></i><span>Today's Meal</span></a>
   
   <a class="nav-link collapsed" onclick="window.open('http://localhost/finger/zktest.php','newwindow','width=300', 'height=250');" style="color: white;"> <i class="fas fa-user-check"></i><span>Start Server</span></a> 
    
      
   <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsedata" aria-expanded="true" aria-controls="collapseone">
  <i class="fas fa-user-cog"></i>
    <span>Expense Manager</span>
  </a>

   
<div id="collapsedata" class="collapse" aria-labelledby="headingdata" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{route('product.index')}}">Create Expense</a>
      <a class="collapse-item" href="{{route('product.product_list')}}">Expense Head</a>
      <a class="collapse-item" href="{{route('expense.index')}}">Employee Expense</a>
      <a class="collapse-item" href="{{route('today.invoice')}}">Product List</a>

    </div> 
</div>







    
  </a>
 
</li>

@endif

<!--Admin sidebar-->
@if(auth()->user()->userHasRole('Admin'))

<li class="nav-item">
<a class="nav-link collapsed" href="{{route('admin.index')}}" style="color: white;"><i class="fas fa-chart-line"></i><span>Dashboard</span></a> 
  <a class="nav-link collapsed" href="{{route('admin.index')}}" data-toggle="collapse" data-target="#collapsedata" aria-expanded="true" aria-controls="collapseone">
  <i class="fas fa-user-cog"></i>
    <span>Admin</span>
  </a>
  <div id="collapsedata" class="collapse" aria-labelledby="headingdata" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Admin:</h6>
      <!-- @if(auth()->user()->userHasRole('Admin')) -->
      <!-- <a class="collapse-item" href="{{route('admin.index')}}">Dashboard</a> -->
      <a class="collapse-item" href="{{route('admin.reports')}}">Guest Reports</a>
      <!-- @endif -->
    </div>
  </div>
  <a class="nav-link collapsed" href="{{route('employee.index')}}" style="color: white;"> <i class="fas fa-user-friends"></i><span>Employee</span></a> 
  <a class="nav-link collapsed" href="{{route('user_role_manage')}}" style="color: white;"> <i class="fas fa-user-friends"></i><span>Role Management</span></a> 
</li>
@endif
<!-- Report -->





