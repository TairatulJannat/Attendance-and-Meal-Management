<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  



<!-- print guest data -->

<table class="table table-blue table-striped">
<thead>
<tr>
<th>Product Name</th>
<th>Quantity</th>
<th>Unit</th>
<th>Price</th>
<th>Total Price</th>
<th>Date</th>

</tr>
</thead>
<tbody>
    <?php
    $total_amount = 0;
    ?>
@foreach($items as $item)
    <tr>
    
      <td>{{$item->p_name}}</td>
      <td>{{$item->p_quantity}}</td>
      <td>{{$item->p_unit}}</td>
      <td>{{$item->p_price}}</td>
      <td>{{$item->p_total}}</td>
      <td>{{$item->date}}</td>

      <?php

        $total_amount = $total_amount + $item->p_total;
      ?>
        <!-- Button trigger modal -->
    
      
    </tr>
    
    @endforeach 
    
  </tbody>
  
  <tbody>
  
  
    <tr>

        <td></td>
        <td></td>
        <td></td>
        <td><b>Total =</b></td>
        <td><b>{{$total_amount}}</b></td>
        <td></td>
    </tr>
   
</tbody>

</table>

<a href="{{ route('itemPdfView',['download'=>'pdf']) }}">Download PDF</a>  



<form action="{{route('invoice_image.store')}}" method="post" enctype="multipart/form-data">
  @csrf
  <div style="color:black;">
    <label for="title"><b>Upload Invoice</b></label>
   <input type="file" name="invoice_image"><br>
   <button type="submit" name="submit">Upload</button>
 </div>
</form>
        
</body>
</html>


