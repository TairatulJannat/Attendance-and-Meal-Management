
<x-admin-master>


@section('content')


        <!-- Blog Post -->
<a href="{{route('today.invoice')}}" class="btn btn-primary">Today's Invoice</a>

<form  method="post" action="">
@csrf


    <div class="form-group" style="color:black;">
        <label for="title"><b>Invoice Search</b></label>
        <input type="date" class="form-control" style="width:70%"  name="date" aria-describedby="" >
    </div>

    <div class="form-group">
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>

</form>
      
@endsection
</x-admin-master>














   
        

