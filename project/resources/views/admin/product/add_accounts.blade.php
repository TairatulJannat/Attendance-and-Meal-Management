<x-admin-master>
@section('content')
<!-- <h1 style="color:blue">GUEST REPORT</h1> -->


<form  method="post" action="{{route('expense.store')}}">
@csrf
<div class="form-group" style="color:black;">
<label for="title"><b>Employee ID</b></label>
<input type="text"  style="width:50%" class="form-control my-3 search-input" name="user_ref_id" id="title" aria-describedby="" placeholder="Enter ID">
</div>



                <script type="text/javascript">
                    $(document).ready(function(){
                        $(".search-input").on('keyup',function(){
                            var _q=$(this).val();
                            if(_q.length>=0){
                                $.ajax({
                                    url:"{{url('emp_name_search')}}",
                                    data: {
                                        q:_q
                                    },
                                    dataType:'json',
                                    beforeSend:function(){
                                        // $(".search-result").html('<li>Loading...</li>');
                                    },
                                    success:function(res){

                                        // console.log(res.data[0].name);

                                        $('#name').val(res.data[0].name);

                                        var _html='';
                                        $.each(res.data, function(index,data){
                                            _html+='<li>'+data.name+'</li>';
                                        });
                                       $(".search-result").html(_html);
                                    }
                                })
                            }
                        });
                    });

                </script>

<div class="form-group" style="color:black;">
<label for="title"><b>Name</b></label>
<input type="text" style="width:50%" class="form-control" name="name" id="name" aria-describedby="" placeholder="enter name ">
</div>

<div class="form-group" style="color:black;">
<label for="title"><b>Paid Amount</b></label>
<input type="number" style="width:50%" class="form-control" name="paid_amount" id="title" aria-describedby="" placeholder="enter paid amount">
</div>
<!-- <div class="form-group" style="color:black;">
<label for="title"><b>Meal Amount</b></label>
<input type="number" style="width:50%" class="form-control" name="meal_amount" id="title" aria-describedby="" placeholder="enter meal amount">
</div> -->
<!-- <div class="form-group" style="color:black;">
<label for="title"><b>Due Amount</b></label>
<input type="number" style="width:50%" class="form-control" name="due_amount" id="title" aria-describedby="" placeholder="enter due amount">
</div> -->
<div class="form-group" style="color:black;">
<label for="title"><b>Date</b></label>
<input type="date" style="width:50%" class="form-control" name="date" id="title" aria-describedby="" placeholder="enter date">
</div>


<label class="wsite-form-label" style="width: 100%; color:blue">Please submit</label><br>
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>



</form>




@endsection 

</x-admin-master>


