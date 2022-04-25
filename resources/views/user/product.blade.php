<div class="latest-products">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Latest Products</h2>
            {{-- <a href="products.html">view all products <i class="fa fa-angle-right"></i></a> --}}

            <form action="{{url('search')}}" method="get" class="form-inline" style="float: right; padding: 10px;">

              @csrf

              <input class="form-control" type="search" name="search" placeholder="search">

              <input type="submit" value="Search" class="btn btn-success">
            </form>

          </div>
        </div>


        @foreach($data as $product)


        <div class="col-md-4">
          <div class="product-item">
            <a><img style="height:300px; widsth:150px" src="/productimage/{{$product->image}}"></a>
            {{-- height="300" width="150" --}}
            <div class="down-content">
              <a href="#"><h4>{{$product->title}}</h4></a>  
              <h6>Rp.{{$product->price}}</h6>
              <p>{{$product->description}}</p>
              <h3>Stok: {{$product->quantity}}</h3>
              <br>

              <form action="{{url('addcart/ ' . $product->id . '/' . $product->title )}}" method="POST">

                @csrf

                <input type="number" value="1" min="1" class="form-control" style="width:100px;" name="quantity">

                <br>
                
                
                <input class="btn btn-primary" type="submit" value="Add to Cart" id="addtocartbutton">
                {{-- @if($post->addtocartbutton == 1)
                  <input type="submit" value="Unpublished">
                @else
                  <input type="submit" value="Publish">
                @endif --}}

              </form>

              
              {{-- <script>

                function change()
                {
                //var elem = document.getElementById("addtocartbutton");
                {document.getElementById("addtocartbutton").style.display="none";}
                // if (elem.value=="Add to Cart") elem.value = "Item Added";
                // else elem.value = "Item Added";
                }

              </script> --}}


              
            </div>
          </div>
        </div>

        @endforeach

        @if(method_exists($data,'links'))

        <div class="d-flex justify-content-center">

          {!! $data->links() !!}
          
        </div>

        @endif



      </div>
    </div>
  </div>