<x-admin-master>


    @section('content')

    <h1 style="color:blue">Employee Guest</h1>

    <div class="row">
        <div class="col-sm-6">
            <form method="post" action="{{route('guest.store')}}" enctype="multipart/form-data">
                @csrf


                <!-- <div class="form-group">
                    <label for="category">Employee</label>
                    <select name="user_id" id="">
                    <option disabled selected value> -- select an option -- </option>
                        @foreach($users as $user)
                        
                        <option value="{{$user->id}}">{{$user->name}} (ID: {{$user->user_ref_id}} DEPT: {{$user->department}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="category">Employee</label>
                    
                    <select name="user_id" id="">
                    <option disabled selected value> -- select an option -- </option>
                        @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->user_ref_id}} (Name: {{$user->name}} DEPT: {{$user->department}})</option>
                        @endforeach
                    </select>
                </div> -->


                <div class="form-group" style="color:black;">
                    <label for="title"><b>Employee ID<span style="color: red;">*</span></b></label>
                    <input type="text" style="width:50%" class="form-control my-3 search-input" name="user_id" id="title" aria-describedby="" placeholder="enter employee id">
                    
                    
                </div>
                
                <!-- <div class="form-group" style="color:black;">
                    <label for="title"><b>Employee Name</b></label>
                    <input type="text"  style="width:50%" class="form-control my-3 search-result" name="user_name" id="title" aria-describedby="">
                </div> -->





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
                    <label for="title"><b>Employee Name</b></label>
                    <input type="text" style="width:50%" class="form-control" name="user_name" id="name" aria-describedby="" placeholder="enter employee name">
                </div>

                <div class="form-group" style="color:black;">
                    <label for="title"><b>Guest Name<span style="color: red;">*</span></b></label>
                    <input type="text" style="width:50%" class="form-control" name="name" aria-describedby="" placeholder="enter guest name">
                </div>

                <!-- <div class="form-group" style="color:black;">
                    <label for="title"><b>Employee Referance Id</b></label>
                    <input type="text" style="width:50%" class="form-control" name="user_ref_id" id="title" aria-describedby="" placeholder="enter refer id">
                </div> -->

                

                <div class="form-group" style="color:black;">
                    <label for="title"><b>Phone Number<span style="color: red;">*</span></b></label>
                    <input type="text" style="width:50%" class="form-control" name="phone_number" id="title" aria-describedby="" placeholder="enter phone number">
                </div>


        </div>

        <div class="col-sm-6">

            <div class="form-group" >
                <input type="hidden"  name="guest_status" value="emp_guest">
            </div>


            <!-- <div class="form-group" style="color:black;">
                <label for="file"><b>Image</b></label>
                <input type="file" style="width:50%" class="form-control" name="guest_image" id="guest_image">
            </div> -->
    <!-- webcam query -->
            <div class="col">
          
            <div id="my_camera"></div> 
            <script language="JavaScript">
            Webcam.set({
                width: 320,
                height: 220,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach('#my_camera');
            
            
            function take_snapshot() {
            
                // take snapshot and get image data
                Webcam.snap(function(data_uri){
      $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
                });
            }

            </script>
                <div id="results"></div>
                <div class="form-group">
                <br>
                <input class="btn btn-success" type=button value="Take Snapshot" onClick="take_snapshot()" style="margin:middle;" />
                <input type="hidden" name="guest_image" class="image-tag">
                </div>

            </div>


        </div>


    </div>


    <div class="wsite-form-radio-container">

        <label class="wsite-form-label" style="width: 100%; color:blue">Please submit</label><br>
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">

    </div>
    </form>
            
         





    @endsection

</x-admin-master>