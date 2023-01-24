<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>


    <title>Sixteen Clothing HTML Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">


    {{-- ini buat payment gateway midtrans --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-SRKlFarLXz2AGOuh"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="redirect"><h2>UAKB <em>Mart</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="redirect">Home
                 
                </a>
              </li> 
              {{-- <li class="nav-item">
                <a class="nav-link" href="products.html">Our Products</a>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link" href="aboutus">About Us</a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li> --}}


              <li class="nav-item">

              @if (Route::has('login'))
              
                  @auth

                  <li class="nav-item active">
                    <a class="nav-link" href="{{url('showcart')}}">
                      <span class="sr-only">(current)</span>
                      <i class="fas fa-shopping-cart"></i>
                      Cart [{{$count}}]</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="{{url('showhistory')}}">History</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="{{url('userprofile',$userid)}}">Profile
                    </a>
                  </li>
                      
                        <x-app-layout>
    
                    </x-app-layout>
                
                  @else
                      <li><a class="nav-link" href="{{ route('login') }}" >Log in</a></li>

                      @if (Route::has('register'))
                          <li><a class="nav-link" href="{{ route('register') }}" >Register</a></li>
                      @endif
                  @endauth
              
          @endif

            </li>

            </ul>
          </div>
        </div>
      </nav>

      @if(session()->has('message'))

        <div class="alert alert-success">

        <button type="button" class="close" data-dismiss="alert">x</button>

        {{session()->get('message')}}

        </div>

        @endif

    </header>


    <div style="padding:100px;" align="center">

    <table>
        <tr style="background-color:black; color:white;">
          {{-- <td style="padding:10px; font-size:20px color:white;">Product Image</td> --}}
          <td style="padding:10px; font-size:20px color:white;">Product ID</td>
            <td style="padding:10px; font-size:20px color:white;">Product Name</td>
            <td style="padding:10px; font-size:20px color:white;">Quantity</td>
            <td style="padding:10px; font-ssize:20px color:white;">Price</td>
            <td style="padding:10px; font-ssize:20px color:white;">Action</td>
        </tr>



        <form id="formorder" action="{{url('order')}}" method="POST">
          @foreach($cart as $carts)

          {{-- <form action="{{url('order/ ' . $carts->product_id)}}" method="POST"> --}}

          @csrf

        {{-- @foreach($cart as $carts) --}}

        
        <tr style="background-color: black">

          {{-- <td style="padding:10px; color:white;">
            
            <img height="100" width="100" src="/productimage/{{$carts->image}}" alt="">

          </td> --}}

          <td style="padding:10px; color:white;">

            <input type="text" name="productid[]" value="{{$carts->product_id}}" hidden>

            {{$carts->product_id}}

          </td>

            <td style="padding:10px; color:white;">

              <input type="text" name="productname[]" value="{{$carts->product_title}}" hidden>

              {{$carts->product_title}}

            </td>
            <td style="padding:10px; color:white;">

              <input type="text" name="quantity[]" value="{{$carts->quantity}}" hidden>

              {{$carts->quantity}}

            </td>
            <td style="padding:10px; color:white;">

              <input type="text" name="price[]" value="{{$carts->price}}" hidden>
              
              Rp. {{$carts->price}}
            
            </td>
            <td style="padding:10px; color:white;">
              
              <a class="btn btn-danger" onclick="return confirm('Are You Sure?')" href="{{url('delete',$carts->id)}}">Delete</a></td>

        </tr>

        <tr style="background-color:white; color:white;">
          <td style="padding:10px; font-ssize:20px color:white;"></td>
          <td style="padding:10px; font-ssize:20px color:white;"></td>
          <td style="padding:10px; font-ssize:20px color:white;"></td>
          <td style="padding:10px; font-ssize:20px color:white;"></td>
          <td style="padding:10px; font-ssize:20px color:white;"></td>
        </tr>
        

        <tr style="background-color:black; color:white;">
          <td style="padding:10px; font-ssize:20px color:white;">Harga Sebelum Diskon</td>
          <td style="padding:10px; font-ssize:20px color:white;"></td>
          <td style="padding:10px; font-ssize:20px color:white;">Rp. {{$totalx2}}</td>
          <td style="padding:10px; font-ssize:20px color:white;"></td>
          <td style="padding:10px; font-ssize:20px color:white;"></td>
        </tr>
        
        <tr style="background-color:black; color:white;">
          <td style="padding:10px; font-ssize:20px color:white;">Diskon</td>
          <td style="padding:10px; font-ssize:20px color:white;">{{$diskon2}}%</td>
          <td style="padding:10px; font-ssize:20px color:white;">Rp. {{$diskon_temp}}</td>
          <td style="padding:10px; font-ssize:20px color:white;"></td>
          <td style="padding:10px; font-ssize:20px color:white;"></td>
        </tr>
        @endforeach
        <tr style="background-color:black; color:white;">
        <td style="padding:10px; font-ssize:20px color:white;">Total</td>
        
        <td style="padding:10px; font-ssize:20px color:white;"></td>
        <td style="padding:10px; font-ssize:20px color:white;">Rp. {{$totalx}}</td>
        <td style="padding:10px; font-ssize:20px color:white;"></td>
        <td style="padding:10px; font-ssize:20px color:white;"></td>
        </tr>

    </table>

    <br>
    
    

    {{-- <button id="confirmorder" class="btn btn-success" onclick="return confirm('Confirm Order?')">Confirm Order</button> --}}
    {{-- <button id="pay-button">Pay!</button> --}}
  </form>


{{-- <div class="section-heading">
  <h2 align="left">Ongkir</h2>
</div> --}}

<p style="font-size: 30px" align="left">Ongkir</p>
<br>
  <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Rp.</span>
    <input type="text" style="padding:10px;" name="total_ongkir" id="totalongkir" value="{{$hargaongkirbeneran}}" class="form-control total_ongkir"
        readonly />
    <input type="text" name="jasa_pengiriman" value="{{$jasapengirimanbeneran}}"
        class="form-control jasa_pengiriman" readonly/>
  </div>

  
  <form action="{{url('ongkir')}}">
    <button id="cekongkir" class="btn btn-md btn-primary">Cek Ongkir</button>

</form>

  <br>

  {{-- ini buat midtrans start --}}

  <button id="pay-button" class="btn btn-success" style="display: none;">Pay!</button>

  {{-- <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script> --}}
<script>

var val = {{$hargaongkirbeneran}};
// var val = input[name="total_ongkir"];
  // Executed when DOM is loaded
  // $(document).ready(function() {
     // Executed when select is changed
      // $('hargaongkirbeneran').on('change',function() {
      //     var x = $hargaongkirbeneran;
  
      //     if (x < 2) {
      //        $("#pay-button").hide();
      //     } else {
      //        $("#pay-button").show();
      //     }
      // });

  //     $('input[name="total_ongkir"]').on('not null', function(){
  //   var qty = $(this).val();
  // if ($.isNumeric(qty) && qty > 0) {
  //       $('#pay-button').show();
  //   } else {
  //       $('#pay-button').hide();
  //   }

  // It must not be visible at first time
  // $("#pay-button").css("display","none");

    if (val>1) {
    // alert("this is not null")
    $("#pay-button").show();
} else {
    // alert("this is null")
    $("#pay-button").hide();
}

// if(val==null){
//   alert("this is null")
// } else{
//   alert("this is not null")
// }
  
      

        // if($hargaongkirbeneran > 1){
        //   $("#pay-button").show();
        // }
  // }); 
  </script>


{{-- <button id="pay-button" class="btn btn-success" >Pay!</button> --}}
  {{-- <button id="pay-button" class="btn btn-success" style="display: none;">Pay!</button> --}}

  <form action="" id="submit_form" method="POST">
      @csrf
      <input type="hidden" name="json" id="json_callback">
  </form>

  <script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay('{{$snap_token}}', {
        onSuccess: function(result){
          /* You may add your own implementation here */
          alert("payment success!"); 
          console.log(result);
          send_response_to_form(result);
          // $('#formorder').submit();
          
          // $('#formorder').submit('order_transaction_id');
        },
        onPending: function(result){
          /* You may add your own implementation here */
          alert("wating your payment!"); 
          console.log(result);
          send_response_to_form(result);
        },
        onError: function(result){
          /* You may add your own implementation here */
          alert("payment failed!"); 
          console.log(result);
          send_response_to_form(result);
        },
        onClose: function(){
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      })
    });

    function send_response_to_form(result){
      document.getElementById('json_callback').value = JSON.stringify(result);
      // alert(document.getElementById('json_callback').value)
      $('#submit_form').submit();
    }
   
    // function sendorder(){
      // $('#formorder').submit('order_transaction_id');
    // }
  </script>

  {{-- ini buat midtrans end --}}

</div>
    


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>


    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>

{{-- {{session()->get('alert-success')}} --}}
    {{-- @if(session('alert-success')) --}}
    
    <script>
      // $('#formorder').submit();
    // alert("{{session('alert-success')}}")
          // $('#formorder').submit('order_transaction_id');
          // $('#formorder').submit();

    </script>

    {{-- $('#formorder').submit('order_transaction_id'); --}}
      
      
    

    
    {{-- @elseif(session('alert-failed'))
    <script>alert("{{session('alert-failed')}}")</script>
    @endif --}}



    @if(session()->has('alert-success'))

    <script>
      $('#formorder').submit();

</script>
    {{session()->get('alert-success')}}

    </div>

    @endif
  
  
  </body>

</html>
