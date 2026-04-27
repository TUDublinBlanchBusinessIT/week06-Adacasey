@section('content')
<div style="padding-top:1%">
    <nav class="navbar navbar-right navbar-expand-sm navbar-dark bg-dark">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><button id="checkOut" onclick="window.location.href='{{route('scorder.checkout')}}'" type="button" style="margin-right:5px;" class="btn btn-primary navbar-btn center-block">Check Out</button></li>
            <li class="nav-item"><button id="emptycart" type="button" style="margin-right:5px;" class="btn btn-primary navbar-btn center-block">Empty Cart</button></li>
            <li class="nav-item"><span style="font-size:40px;margin-right:0px;" class="glyphicon glyphicon-shopping-cart navbar-btn"></span></li>
            <li class="nav-item"><div class="navbar-text" id="shoppingcart" style="font-size:12pt;margin-left:5px;margin-right:0px;">{{$totalItems}}</div></li>
            <li class="nav-item"><div class="navbar-text" style="font-size:14pt;margin-left:0px;">Item(s)</div></li>
        </ul>
    </nav>
</div>
<script>
$(".bth,.addItem").click(function() {
    var total = parseInt($('#shoppingcart').text());
    var i=$(this).val();
    $('#shoppingcart').text(total);
    $.ajax({
      type: "GET",
      url: "{{url('product/additem/')}}" + "/" + i,
      success: function(response) {
          total=total+1;
          $('#shoppingcart').text(response.total);
      },
      error: function() {
          alert("problem communicating with the server");
      }
    });
});

$("#emptycart").click(function() { 
    $.ajax({
        type: "get", 
        url: "{{ url('product/emptycart') }}",
        success: function() {
            $('#shoppingcart').text(0);
        },
        error: function() {
            alert("problem communicating with the server");
        }
    });
});
</script>
@endsection