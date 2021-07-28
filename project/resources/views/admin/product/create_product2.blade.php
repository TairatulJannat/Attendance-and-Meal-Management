<x-admin-master>
@section('content')
  <div class="container">
    <br />
    <br />
    <h2 align="center">Add Expenses</h2>
    <div class="form-group" width=75%>
      <form  id="add_name" method="post" action="{{route('product.store')}}">
        @csrf
        
          <table class="table table-bordered" id="articles">
            <tr>

              <td><input  type="text" id="name-0" name="p_name[]" placeholder="Name" class="form-control name_list" /></td>
              <td><input  type="text" id="unit-0" name="p_unit[]" placeholder="Unit" class="form-control name_list" /></td>
              <td><input  type="number" id="quantity-0" name="p_quantity[]" placeholder="quantity" class="form-control name_list" /></td>
              <td><input  type="number" id="price-0" name="p_price[]" placeholder="price" class="form-control name_list" /></td>

              <td><input type="number" id="total-0" name="p_total[]" placeholder="total" class="form-control name_list" readonly /></td>
              <td> <input type='date' class='form-control name_list' name='date[]'></td>"
              <td><button type="button" name="add" id="add" class="btn btn-success">Add new</button></td>
            </tr>
          </table>
          <input type="submit" name="submit"  class="btn btn-info" value="Submit" />
        
      </form>
    </div>
  </div>


<script>
  $(document).ready(function() {
  var i = 0;
  $("#quantity-" + i).change(function() {
    upd_art(i)
  });
  $("#price-" + i).change(function() {
    upd_art(i)
  });

   $("#name-" + i).change(function() {
    upd_art(i)
  });


  $('#add').click(function() {
    i++;
    $('#articles').append('<tr id="row' + i + '"><td><input type="text" placeholder="Name" id="name-' + i + '" name="p_name[]"  class="form-control name_list" /><td><input type="text" id="unit-' + i + '" name="p_unit[]" placeholder="Unit" class="form-control name_list" /><td><input type="number" id="quantity-' + i + '" name="p_quantity[]" placeholder="quantity" class="form-control name_list" /></td> <td><input type="number" id="price-' + i + '" name="p_price[]" placeholder="price" class="form-control name_list" /></td> <td><input type="number" id="total-' + i + '" name="p_total[]" placeholder="total" class="form-control name_list" readonly /><td><input type="date" class="form-control name_list" name="date[]"></td> <td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');

    $("#quantity-" + i).change(function() {
      upd_art(i)
    });
    $("#price-" + i).change(function() {
      upd_art(i)
    });
    $("#name-" + i).change(function() {
      upd_art(i)
    });


  });


  $(document).on('click', '.btn_remove', function() {
    var button_id = $(this).attr("id");
    $('#row' + button_id + '').remove();
  });




  // $('#submit').click(function() {
  //   alert($('#add_name').serialize()); //alerts all values           
  //   $.ajax({
  //     url: "wwwdb.php",
  //     method: "POST",
  //     data: $('#add_name').serialize(),
  //     success: function(data) {
  //       $('#add_name')[0].reset();
  //     }
  //   });
  // });

  function upd_art(i) {
    var qty = $('#quantity-' + i).val();
    var price = $('#price-' + i).val();
    var name = $('#name-' + i).val();
    // console.log(name);
    // console.log(price);
    var totNumber = (qty * price);
    var tot = totNumber.toFixed(2);
    $('#total-' + i).val(tot);



            var _q= name;
            if(_q.length>1){
                $.ajax({
                    url:"{{url('product_unit_search')}}",
                    data: {
                        q:_q
                    },
                    dataType:'json',
                    beforeSend:function(){
                        // $(".search-result").html('<li>Loading...</li>');
                    },
                    success:function(res){

                        console.log(res.data[0].p_unit);

                        $('#unit-' + i).val(res.data[0].p_unit);

                        var _html='';
                        $.each(res.data, function(index,data){
                            _html+='<li>'+data.p_unit+'</li>';
                        });
                       $(".search-result").html(_html);
                    }
                })
            }
    
  }



  //  setInterval(upd_art, 1000);
});

</script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


@endsection 

</x-admin-master>