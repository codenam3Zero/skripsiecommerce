<!DOCTYPE html>
<html lang="en">

  <head>
    <base href="/public">

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
              
              <li class="nav-item">
                <a class="nav-link" href="aboutus">About Us</a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li> --}}


              <li class="nav-item">

              @if (Route::has('login'))
              
                  @auth

                  

                  <li class="nav-item">
                    <a class="nav-link" href="{{url('showcart')}}">
                      
                      <i class="fas fa-shopping-cart"></i>
                      Cart [{{$count}}]</a>
                  </li>

                  <li class="nav-item active">
                    <a class="nav-link" href="{{url('showhistory')}}">History
                      <span class="sr-only">(current)</span>
                    </a>
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
          <td style="padding:10px;">ID</td>
          <td style="padding:10px;">Status</td>
          <td style="padding:10px;">Name</td>
          <td style="padding:10px;">Email</td>
          <td style="padding:10px;">Phone</td>
          <td style="padding:10px;">Transaction ID</td>
          <td style="padding:10px;">Order ID</td>
          {{-- <td style="padding:10px;">Ongkir</td>
          <td style="padding:10px;">Jasa Pengiriman</td> --}}
          <td style="padding:10px;">Total Price</td>
          <td style="padding:10px;">Payment Type</td>
          <td style="padding:10px;">Confirmation Status</td>
          {{-- <td style="padding:10px;">Details</td> --}}
          {{-- <td style="padding:10px;">Confirm Payment</td> --}}
        </tr>



        <form action="{{url('order')}}" method="POST">

          @csrf

        @foreach($history as $transactions)

        
        <tr style="background-color: #FFFDD0; color:black">
          

          {{-- <td style="padding:10px; color:white;">
            
            <img height="100" width="100" src="/productimage/{{$carts->image}}" alt="">

          </td> --}}
            

          {{-- <td style="padding:20px;">{{$orders->name}}</td> --}}
                        {{-- <td style="padding:20px;">{{$orders->phone}}</td>
                        <td style="padding:20px;">{{$orders->address}}</td>
                        <td style="padding:20px;">{{$orders->product_id}}</td>
                        <td style="padding:20px;">{{$orders->product_name}}</td>
                        <td style="padding:20px;">{{$orders->price}}</td>
                        <td style="padding:20px;">{{$orders->quantity}}</td>
                        <td style="padding:20px;">{{$orders->status}}</td> --}}

          <td style="padding:10px;">{{$transactions->id}}</td>
          <td style="padding:10px;">{{$transactions->status}}</td>
          <td style="padding:10px;">{{$transactions->user_name}}</td>
          <td style="padding:10px;">{{$transactions->user_email}}</td>
          <td style="padding:10px;">{{$transactions->user_phone}}</td>
          <td style="padding:10px;">{{$transactions->transaction_id}}</td>
          <td style="padding:10px;">{{$transactions->order_id}}</td>
          {{-- <td style="padding:10px;">Rp.{{$transactions->total_ongkir}}</td>
          <td style="padding:10px;">{{$transactions->jasa_pengiriman}}</td> --}}
          <td style="padding:10px;">Rp.{{$transactions->gross_amount}}</td>
          <td style="padding:10px;">{{$transactions->payment_type}}</td>
          <td style="padding:10px;">{{$transactions->confirmation}}</td>
          {{-- <td style="padding:10px;">
            <a class="btn btn-success" href="{{url('showhistorydetail',$transactions->id)}}">
              Details
          </a>
          </td> --}}
          {{-- <td style="padding:10px;">Confirm Payment</td> --}}

        @endforeach

    </table>

    <br>
    <br>

    <table>
        <tr style="background-color: black; color:white">
            <td style="padding:10px;">ID</td>
            <td style="padding:10px;">Transaction ID</td>
            {{-- <td style="padding:10px;">Name</td> --}}
            {{-- <td style="padding:10px;">Email</td> --}}
            {{-- <td style="padding:10px;">Phone</td> --}}
            {{-- <td style="padding:10px;">Transaction ID</td> --}}
            <td style="padding:10px;">Product Name</td>
            <td style="padding:10px;">Quantity</td>
            <td style="padding:10px;">Price</td>
            {{-- <td style="padding:10px;">Confirmation Status</td>
            <td style="padding:10px;">Details</td>
            <td style="padding:10px;">Confirm Payment</td> --}}
        </tr>



        @foreach($order as $orders)
        {{-- <tr align="center" style="border: 1px solid black;" style="background-color: white; color:black"> --}}
          <tr style="background-color: #FFFDD0; color:black">
            <td style="padding:10px;">{{$orders->id}}</td>
            <td style="padding:10px;">{{$orders->transaction_id}}</td>
            <td style="padding:10px;">{{$orders->product_name}}</td>
            {{-- <td style="padding:10px;">{{$transactions->user_email}}</td> --}}
            {{-- <td style="padding:10px;">{{$transactions->user_phone}}</td> --}}
            <td style="padding:10px;">{{$orders->quantity}}</td>
            <td style="padding:10px;">{{$orders->price}}</td>
            {{-- <td style="padding:10px;">{{$transactions->gross_amount}}</td>
            <td style="padding:10px;">{{$transactions->payment_type}}</td>
            <td style="padding:10px;">{{$transactions->confirmation}}</td> --}}
            {{-- <td style="padding:10px;"> --}}
                
        </tr>

        @endforeach

        <tr style="background-color: black; color:white">
          <td style="padding:10px;">Ongkir</td>
          <td style="padding:10px;"></td>
          <td style="padding:10px;"></td>
          <td style="padding:10px;">{{$transactions->jasa_pengiriman}}</td>
          <td style="padding:10px;">Rp. {{$transactions->total_ongkir}}</td>
      <tr>
        
        <tr style="background-color: #FFFDD0; color:black">
            <td style="padding:10px;">Total</td>
            <td style="padding:10px;"></td>
            <td style="padding:10px;"></td>
            <td style="padding:10px;"></td>
            <td style="padding:10px;">Rp. {{$transactions->gross_amount}}</td>
        <tr>
        
    </table>

    <br>
    {{-- <button class="btn btn-success" >Confirm Order</button> --}}

  </form>

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


  </body>

</html>
