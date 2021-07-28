<x-admin-master>
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <form  method="post" action="{{route('product.store')}}">
    @csrf
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
$(document).ready(function(){
$("#newrows").click(function(){
var addcontrols="<tr>"
  addcontrols+="<td> <input type='text' class='form-control' style='width:70%' name='p_name[]'  id='title' aria-describedby='' placeholder='enter product name'></td>"
  addcontrols+="<td> <input type='text' class='form-control' style='width:70%' name='p_unit[]'  id='title' aria-describedby='' placeholder='enter product unit'></td>"
  addcontrols+="<td> <input type='number' class='form-control' style='width:70%' name='p_price[]'    aria-describedby=''placeholder='enter product price'></td>"
  addcontrols+="<td> <input type='number' class='form-control' style='width:70%' name='p_quantity[]'   aria-describedby=''placeholder='enter product quantity'></td>"
  addcontrols+="<td> <input type='number' class='form-control' style='width:70%' name='p_total[]'   aria-describedby='' placeholder='enter total amount'></td>"

              $(function(){
              $('#value1[], #value2[]').keyup(function(){
                
                  var value1 = parseFloat($('#value1').val()) || 0;
                  console.log(value1);
                  var value2 = parseFloat($('#value2').val()) || 0;
                  console.log(value2);
                  $('#mul').val(value1 * value2);
              });
              });

          
                  
  addcontrols+="<td> <input type='date' class='form-control' style='width:70%' name='date[]'  id='title' aria-describedby=''></td>"

  addcontrols+="</tr>";
  $("table tbody").append( addcontrols);
                });
            });
   
    </script>
</head>


<body>
<table class="table table-blue table-striped">
  <thead>
    <tr>
      <th>Expense Head</th>
      <th>Unit</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Total Amount</th>
      <th>Date</th>
    
   
   
    </tr>
  </thead>
   <tbody>
  </tbody> 
  <tfoot>
  <tr>
  <td><input type="button"  class="btn btn-primary btn-sm" value ="Add" id="newrows"></td>
  </tr>
  </tfoot>
</table>
<div class="form-group">
   <a href=""><button type="submit" name="submit[]" class="btn btn-primary">SUBMIT</button></a> 
</div>

    
</body>
</html>


</form>


@endsection 

</x-admin-master>