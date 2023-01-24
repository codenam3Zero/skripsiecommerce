


<!DOCTYPE html>
<html lang="en">
  <head>
   
    @include('admin.css')

   
  </head>
  <body>
   
      
      
      <!-- partial -->
      
      @include('admin.sidebar')

      @include('admin.navbar')


        <!-- partial -->
       
        <div style="padding-bottom: 30px" class="container-fluid page-body-wrapper">

            <div class="container" align="center">


                @if(session()->has('message'))

        <div class="alert alert-success">

        <button type="button" class="close" data-dismiss="alert">x</button>

        {{session()->get('message')}}

        </div>

        @endif


                <table>


                    <tr align="center" style="background-color: grey">

                        {{-- <td style="padding:20px;">Title</td>
                        <td style="padding:20px; width:400px">Description</td>
                        <td style="padding:20px;">Quantity</td> --}}
                        <td style="padding:20px;">Name</td>
                        <td style="padding:20px;">Image</td>
                        <td style="padding:20px;">Status Verifikasi</td>
                        <td style="padding:20px;">Verifikasi</td>
                        <td style="padding:20px;">Delete</td>

                    </tr>

                    @foreach($data as $fotoktm)

                    <tr align="center" style="background-color: black;">

                        {{-- <td >{{$fotoktm->title}}</td>
                        <td >{{$fotoktm->description}}</td>
                        <td >{{$fotoktm->quantity}}</td> --}}
                        <td >{{$fotoktm->user_name}}</td>
                        <td >
                            <img height="400" width="400" src="/productimage/{{$fotoktm->image}}">
                        </td>

                        <td >{{$fotoktm->status_verifikasi}}</td>

                        <td style="padding:10px;">
                            <a class="btn btn-success" onclick="return confirm('Verifikasi KTM?')" href="{{url('verifikasifotoktm',$fotoktm->id)}}">
                                Verifikasi
                            </a>
                        </td>

                        <td>
                            <a class="btn btn-danger" onclick="return confirm('Are You Sure?')" href="{{url('deletektm',$fotoktm->id)}}">Delete</a>
                        </td>

                        {{-- <td>
                            <a class="btn btn-primary" href="{{url('updateview',$product->id)}}">Update</a>
                        </td>

                        <td>
                            <a class="btn btn-danger" onclick="return confirm('Are You Sure?')" href="{{url('deleteproduct',$product->id)}}">Delete</a>
                        </td> --}}

                    </tr>

                    @endforeach

                </table>


            </div>

        </div>

          <!-- partial -->
        

        @include('admin.script')


    <!-- End custom js for this page -->
  </body>
</html>