<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
    <title>Laravel Raja Ongkir - SantriKoding.com</title>
</head>
<body style="background: #f3f3f3">

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-3">
            {{-- <div class="card">
                <div class="card-body">
                    <h3>ORIGIN</h3>
                    <hr>
                    <div class="form-group">
                        <label class="font-weight-bold">PROVINSI ASAL</label>
                        <select class="form-control provinsi-asal" name="province_origin">
                            <option value="0">-- pilih provinsi asal --</option>
                            @foreach ($provinces as $province => $value)
                                <option value="{{ $province  }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">KOTA / KABUPATEN ASAL</label>
                        <select class="form-control kota-asal" name="city_origin">
                            <option value="">-- pilih kota asal --</option>
                        </select>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3>DESTINATION</h3>
                    <hr>
                    <div class="form-group">
                        <label class="font-weight-bold">PROVINSI TUJUAN</label>
                        <select class="form-control provinsi-tujuan" name="province_destination">
                            <option value="0">-- pilih provinsi tujuan --</option>
                            @foreach ($provinces as $province => $value)
                                <option value="{{ $province  }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">KOTA / KABUPATEN TUJUAN</label>
                        <select class="form-control kota-tujuan" name="city_destination">
                            <option value="">-- pilih kota tujuan --</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3>KURIR</h3>
                    <hr>
                    <div class="form-group">
                        <label>PROVINSI TUJUAN</label>
                        <select class="form-control kurir" name="courier">
                            <option value="0">-- pilih kurir --</option>
                            <option value="jne">JNE</option>
                            <option value="pos">POS</option>
                            <option value="tiki">TIKI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">BERAT (GRAM)</label>
                        <input type="number" class="form-control" name="weight" id="weight" placeholder="Masukkan Berat (GRAM)">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <button class="btn btn-md btn-primary btn-block btn-check">CEK ONGKOS KIRIM</button>
            <form action="{{url('showcart')}}">
                <br>
                <button id="" class="btn btn-md btn-primary btn-block">Back</button>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card d-none ongkir">
                <div class="card-body">
                    <ul class="list-group" id="ongkir"></ul>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<div class="form-group mt-3">
    <label class="font-weight-bold">Ongkos Kirim</label>
    <select class="form-control ongkos-kirim" name="harga_ongkir">
        <option value="0">-- pilih ongkir --</option>
    </select>
</div>
<script>
    $(document).ready(function(){
        //active select2
        $(".provinsi-asal , .kota-asal, .provinsi-tujuan, .kota-tujuan").select2({
            theme:'bootstrap4',width:'style',
        });
        //ajax select kota asal
        $('select[name="province_origin"]').on('change', function () {
            let provindeId = $(this).val();
            if (provindeId) {
                jQuery.ajax({
                    url: '/cities/'+provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        $('select[name="city_origin"]').empty();
                        $('select[name="city_origin"]').append('<option value="">-- pilih kota asal --</option>');
                        $.each(response, function (key, value) {
                            $('select[name="city_origin"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                $('select[name="city_origin"]').append('<option value="">-- pilih kota asal --</option>');
            }
        });
        //ajax select kota tujuan
        $('select[name="province_destination"]').on('change', function () {
            let provindeId = $(this).val();
            if (provindeId) {
                jQuery.ajax({
                    url: '/cities/'+provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        $('select[name="city_destination"]').empty();
                        $('select[name="city_destination"]').append('<option value="">-- pilih kota tujuan --</option>');
                        $.each(response, function (key, value) {
                            $('select[name="city_destination"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                $('select[name="city_destination"]').append('<option value="">-- pilih kota tujuan --</option>');
            }
        });
        //ajax check ongkir
        let isProcessing = false;
        $('.btn-check').click(function (e) {
            e.preventDefault();

            let token            = $("meta[name='csrf-token']").attr("content");
            // let city_origin      = $('select[name=city_origin]').val();
            let city_origin      = 256;
            let city_destination = $('select[name=city_destination]').val();
            let courier          = $('select[name=courier]').val();
            let weight           = $('#weight').val();

            if(isProcessing){
                return;
            }

            isProcessing = true;
            jQuery.ajax({
                url: "/ongkir",
                data: {
                    _token:              token,
                    city_origin:         city_origin,
                    city_destination:    city_destination,
                    courier:             courier,
                    weight:              weight,
                },
                dataType: "JSON",
                type: "POST",
                success: function (response) {
                    isProcessing = false;
                    if (response) {

                    $('select[name="harga_ongkir"]').empty();
                            $('select[name="harga_ongkir"]').append(
                                '<option value="">-- pilih ongkir --</option>');
                            $.each(response[0]['costs'], function(key, value) {
                                $('select[name="harga_ongkir"]').append('<option value="' +
                                    value.cost[0].value + response[0].code
                                    .toUpperCase() + ' : ' + value.service + '">' +
                                    response[0].code
                                    .toUpperCase() + ' : ' + value.service + ' - Rp. ' +
                                    value.cost[0].value + ' (' + value.cost[0].etd +
                                    ' hari)' + '</option>');
                        // $('#ongkir').empty();
                        // $('.ongkir').addClass('d-block');
                        // $.each(response[0]['costs'], function (key, value) {
                        //     $('#ongkir').append('<li class="list-group-item">'+response[0].code.toUpperCase()+' : <strong>'+value.service+'</strong> - Rp. '+value.cost[0].value+' ('+value.cost[0].etd+' hari)</li>')
                        //     dd(value.cost[0].value);
                        //     console.log(value.cost[0].value);
                        //     button > value cost dikirim pakai get ke /showcart >
                        
                        
                        });
                        

                    }
                }
            });

        });

    });

//ajax coba coba
//     $('select[name="harga_ongkir"]').on('change', function() {
//         let hargaOngkir = $(this).val();

//         if(hargaOngkir) {
//             var value = parseInt(hargaOngkir);
//             value = isNaN(value) ? 0 : value;
//             $('.total_ongkir').val(value);
//             $('span[name="total_harga"]').append('<b><strong>Rp. </strong></b>');

//             let withoutNumbers = hargaOngkir.replace(/[0-9]/g, '');
//             if(withoutNumbers) {
//                 $('.jasa_pengiriman').val(withoutNumbers);
//             } else {
//                 $('.jasa_pengiriman').val();
//             }
//         } else {
//             $('.total_ongkir').val(0);
//         }
// }


</script>

<script>

$('select[name="harga_ongkir"]').on('change', function() {
        let hargaOngkir = $(this).val();

        if(hargaOngkir) {
            var value = parseInt(hargaOngkir);
            value = isNaN(value) ? 0 : value;
            $('.total_ongkir').val(value);
            $('span[name="total_harga"]').append('<b><strong>Rp. </strong></b>');

            let withoutNumbers = hargaOngkir.replace(/[0-9]/g, '');
            if(withoutNumbers) {
                $('.jasa_pengiriman').val(withoutNumbers);
            } else {
                $('.jasa_pengiriman').val();
            }
        } else {
            $('.total_ongkir').val(0);
        }
})


</script>





<form action="{{url('showcart')}}">

    
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Rp.</span>
        <input type="text" name="total_ongkir" value="0" class="form-control total_ongkir"
            readonly />
        <input type="text" name="jasa_pengiriman" value="belum ada"
            class="form-control jasa_pengiriman" readonly/>
    </div>


<div class="d-grid gap-2 col-6 mx-auto mt-3">
    <button class="btn btn-primary" type="submit">Konfirmasi Ongkir</button>
</div>
</form>

</body>
</html>

{{-- <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Rp.</span>
    <input type="text" name="total_ongkir" value="0" class="form-control total_ongkir"
        readonly />
    <input type="text" name="jasa_pengiriman" value="belum ada"
        class="form-control jasa_pengiriman" readonly/>
</div> --}}


{{-- <form action="{{url('addcart/ ' . $product->id . '/' . $product->title )}}" method="POST">

    @csrf

    <input type="number" value="1" min="1" class="form-control" style="width:100px;" name="quantity">

    <br>
    
    
    <input class="btn btn-primary" type="submit" value="Add to Cart" id="addtocartbutton">
    

  </form> --}}



  {{-- <form action="{{url('addcart/ ' . $value.cost[0].value)}}" method="POST">

    @csrf

    <input type="number" value="1" min="1" class="form-control" style="width:100px;" name="hargaongkir">

    <br>
    
    
    <input class="btn btn-primary" type="submit" value="Pilih" id="buttonhargaongkir">
    

  </form> --}}



  {{-- <form action="{{url('showcart/ ' . $value.cost[0].value)}}" method="POST">

    @csrf

    <input type="number" value="1" min="1" class="form-control" style="width:100px;" name="hargaongkir">

    <br>
    
    
    <input class="btn btn-primary" type="submit" value="Pilih" id="buttonhargaongkir">
    

  </form> --}}

  {{-- <form action="{{route('addongkir','$value.cost[0].value')}}" method="POST">@csrf<input value="$value.cost[0].value" min="1" class="form-control" style="width:100px;" name="hargaongkirharga"><br><input class="btn btn-primary" type="submit" value="Pilih" id="buttonhargaongkir"></form>   --}}

