<!DOCTYPE html>
<html lang="en">
  <head>
   
    <base href="/public">
    @include('admin.css')

  </head>
  <body>
   
      
      
      <!-- partial -->
      
      @include('admin.sidebar')

      @include('admin.navbar')


        <!-- partial -->

        <div class="container-fluid page-body-wrapper">

            <div class="container" align="center">
                
                <table>
                    <tr style="background-color: grey;">
                        <td style="padding:10px;">ID</td>
                        <td style="padding:10px;">Status</td>
                        <td style="padding:10px;">Name</td>
                        <td style="padding:10px;">Email</td>
                        <td style="padding:10px;">Phone</td>
                        <td style="padding:10px;">Transaction ID</td>
                        <td style="padding:10px;">Order ID</td>
                        <td style="padding:10px;">Total Price</td>
                        <td style="padding:10px;">Payment Type</td>
                        <td style="padding:10px;">Confirmation Status</td>
                        {{-- <td style="padding:10px;">Details</td>
                        <td style="padding:10px;">Confirm Payment</td> --}}
                    </tr>


                    @foreach($transaction as $transactions)
                    <tr align="center" style="background-color: black;">
                        <td style="padding:10px;">{{$transactions->id}}</td>
                        <td style="padding:10px;">{{$transactions->status}}</td>
                        <td style="padding:10px;">{{$transactions->user_name}}</td>
                        <td style="padding:10px;">{{$transactions->user_email}}</td>
                        <td style="padding:10px;">{{$transactions->user_phone}}</td>
                        <td style="padding:10px;">{{$transactions->transaction_id}}</td>
                        <td style="padding:10px;">{{$transactions->order_id}}</td>
                        <td style="padding:10px;">Rp.{{$transactions->gross_amount}}</td>
                        <td style="padding:10px;">{{$transactions->payment_type}}</td>
                        <td style="padding:10px;">{{$transactions->confirmation}}</td>
                        {{-- <td style="padding:10px;"> --}}
                            {{-- <a class="btn btn-success" href="{{url('showtransactiondetail',$transactions->id)}}">
                                Details
                            </a> --}}
                        {{-- </td> --}}
                        {{-- <td style="padding:10px;"> --}}
                            {{-- <a class="btn btn-success" onclick="return confirm('Confirm Transaction?')" href="{{url('updatestatus',$transactions->id)}}">
                                Confirm
                            </a> --}}

                            {{-- <form action="{{url('updatestatus',$transactions->id)}}">
                                <button id="cekongkir" class="btn btn-md btn-primary">Confirm</button>
                            
                            </form> --}}

                        {{-- </td> --}}
                        {{-- <td style="padding:20px;"> --}}
                            {{-- <a class="btn btn-success" href="{{url('updatestatus',$orders->id)}}">
                                Confirm
                            </a> --}}
                        {{-- </td> --}}
                    </tr>

                    @endforeach



                </table>

                <br>
                <br>

                <table>
                    <tr style="background-color: grey;">
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
                    <tr align="center" style="background-color: black;">
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

                    <tr align="center" style="background-color: black;">
                        <td style="padding:10px;">Ongkir</td>
                        <td style="padding:10px;"></td>
                        <td style="padding:10px;"></td>
                        <td style="padding:10px;">{{$transactions->jasa_pengiriman}}</td>
                        <td style="padding:10px;">Rp. {{$transactions->total_ongkir}}</td>
                    <tr>
                    
                    <tr align="center" style="background-color: black;">
                        <td style="padding:10px;">Total</td>
                        <td style="padding:10px;"></td>
                        <td style="padding:10px;"></td>
                        <td style="padding:10px;"></td>
                        <td style="padding:10px;">Rp. {{$transactions->gross_amount}}</td>
                    <tr>
                    
                </table>
            </div>

        </div>

          <!-- partial -->
        

        @include('admin.script')


    <!-- End custom js for this page -->
  </body>
</html>