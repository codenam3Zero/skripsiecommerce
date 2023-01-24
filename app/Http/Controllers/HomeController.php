<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\Models\User;

use App\Models\fotoktm;

use App\Models\Product;

use App\Models\Cart;

use App\Models\Order;

use App\Models\Transaction;

use App\Models\City;

use App\Models\Province;

use App\Models\Diskon;

use App\Models\user_diskon;

use Kavist\RajaOngkir\Facades\RajaOngkir;

class HomeController extends Controller
{
    public function redirect()
    {

        if(Auth::id())
        {

        $usertype=Auth::user()->usertype;

        if($usertype=='1')
        {
            return view('admin.home');
        }
 
        else  
        {
            $data = product::paginate(9);

            $user=auth()->user();

            //$userid=user::where('id',$user->id)->get();
            $userid = Auth::user()->id;

            //$count=cart::where('phone',$user->phone)->count();

            $count=cart::where('user_id',$user->id)->count();

            return view('user.home',compact('data','count','userid'));
        }

    }

        else
        {
            $data = product::paginate(9);

            return view('user.home',compact('data'));
        }

        // else
        // {
        //     $data = product::paginate(9);
            
        //     return view('user.home');
        // }
        
    }

    public function index()
    {
        if(Auth::id())

        {
            return redirect('redirect');
        }

        else

        {
            
            $data = product::paginate(9);

            return view('user.home',compact('data'));
        }

        
    }


    public function search(Request $request)
    {
        $search=$request->search;

        if($search=='')
        {
            $data = product::paginate(9);

            return view('user.home',compact('data'));
        }

        $data=product::where('title','like','%'.$search.'%')->get();

        return view('user.home',compact('data'));
    }

    public function addcart(Request $request ,$id,$title)
    {
        

        if(Auth::id())
        {
            $data=cart::where('product_title',$title)->first();
            //$data->save();
            //$data->quantity;
            //$data=cart::find($productname);
            //$productname=cart::find('product_name');
            $var1;
            $user=auth()->user();

            $product=product::find($id);

            $productname=$product->title;

            $stockqty=$product->quantity;
            
            
            //$qty2;
            $cart=new cart;

            
            $cart->user_id=$user->id;
            $cart->product_id=$product->id;
            $cart->name=$user->name;
            $cart->phone=$user->phone;
            $cart->address=$user->address;

            $cart->product_title=$product->title;

            $cart->price=$product->price;

            $cart->quantity=$request->quantity;

            $cart2=$cart->quantity;

            //tadi yg dipake yg ini
            //$var2 = \DB::select('SELECT * from carts WHERE phone = ? AND product_title = ?', [$user->phone, $cart->product_title]);

            //sekarang coba yg ini
            $var2 = \DB::select('SELECT * from carts WHERE user_id = ? AND product_title = ?', [$user->id, $cart->product_title]);

            //$var3 = \DB::select('SELECT quantity from carts WHERE phone = ? AND product_title = ?', [$user->phone, $cart->product_title]);


            $var4 = cart::where('user_id',$user->id)
                    ->where('product_title',$cart->product_title)
                    ->sum('quantity');

            //$var4 = cart::where('phone',$user->phone,'product_title',$cart->product_title)->get();
            //$cart2=$cart->quantity::where($cart->product_title==$productname);

            //$cartproductname=cart::find($productname)->where($user->phone==$cart->phone);
            //$cartqty=$cartproductname->quantity;
            // $var1=cart::find($productname)->where($cart->phone==$user->phone)==null

            //$cart3;

            if($cart->quantity > $stockqty)
            {
                return back()->with('message','Pembelian Melebihi Stok Tersedia');
            }

            else
            {

                if($var2==null)
                {
                    $cart->save();
                    return redirect()->back()->with('message','Product Added Succesfully');
                }

                else

                if((int)$var4+$cart->quantity > $stockqty)
                {
                    return back()->with('message','Pembelian Melebihi Stok Tersedia');
                }

                else
                { 
                    //$data = new stdClass();
                    
                    //$cart->quantity=$request->quantity;
                    $cart->quantity=(int)$var4+$cart->quantity;
                    $var5=$cart->quantity;
                    // $data->name=$cart->name;
                    // $data->phone=$cart->phone;
                    // $data->address=$cart->address;
                    // $data->product_title=$cart->product_title;
                    // $data->price->$cart->price;
                    $data->quantity=$var5;
                    $data->save();
                    //$cart->save();
                    return redirect()->back()->with('message','Product Added Succesfully');
                }

                // if($cart->quantity + $cart2 > $stockqty)
                // {
                //     return back()->with('message','Pembelian Melebihi Stok Tersedia');
                // }
            }
            
            // else
            // {
            //     $cart->save();
            // return redirect()->back()->with('message','Product Added Succesfully');
            // }

            // if($productname==$cart->product_title)
            //     {
            //         $cart2->quantity=cart::find($productname)->quantity;

            //         if($cart->quantity + $cart2->quantity <= $stockqty)
            //         {

                    


                    
            //         $cart3->quantity=$cart->quantity + $cart2->quantity;
            //         $cart->quantity=$cart3->quantity;
            //         $cart->save();

            //         return redirect()->back()->with('message','Product Added Succesfully');

            //         }

            //         else if($cart->quantity + $cart2->quantity > $stockqty)
            //         {
            //             return back()->with('message','Pembelian Melebihi Stok Tersedia');
            //         }
            //     }

            //     else
            //     {

                
            //     $cart->save();
            // return redirect()->back()->with('message','Product Added Succesfully');
            //     }

            

            // if($cart->quantity > $stockqty)
            // {
            //     return back()->with('message','Pembelian Melebihi Stok Tersedia');
            // }
            // else
            // {

            //     if($productname==$cart->product_title)
            //     {
            //         $cart2->quantity=$request->quantity;

            //         if($cart->quantity + $cart2->quantity <= $stockqty)
            //         {

                    


                    
            //         $cart3->quantity=$cart->quantity + $cart2->quantity;
            //         $cart3->save();

            //         return redirect()->back()->with('message','Product Added Succesfully');

            //         }

            //         else if($cart->quantity + $cart2->quantity > $stockqty)
            //         {
            //             return back()->with('message','Pembelian Melebihi Stok Tersedia');
            //         }
            //     }

            //     else
            //     {

                
            //     $cart->save();
            // return redirect()->back()->with('message','Product Added Succesfully');
            //     }

            // }
        }





        else
        {
            return redirect('login');
        }


    }

    public function showcart(Request $request)
    {

        //$totalongkirbeneran=$request->total_ongkir;

        $userid = Auth::user()->id;

        $userdiskon=user_diskon::where('user_id', $userid)->first();
        
        // $hargaongkirbeneran=0;
        $jasapengirimanbeneran=$request->jasa_pengiriman;
        $hargaongkirbeneran=$request->total_ongkir;

        // if($hargaongkirbeneran==0)
        // {
        //     $hargaongkirbeneran==null;
        // }

        // dd($request->total_ongkir);
        // dd($request->jasa_pengiriman);

        // dd($hargaongkir2);
        // $ongkir=0;
        // $ongkir=$ongkir+$hargaongkir2;
        // if(session()->has('hargaongkir2'))
        // {
        //     $hargaongkir3 = session()->get('hargaongkir2');
        //     $ongkir = $ongkir + $hargaongkir3;
        // } else
        // {
        //     $ongkir = 0;
        // }
        // if($hargaongkir==null)
        // {
        //     $hargaongkir=1;
        // } 
        // $hargaongkir;
        // $hargaongkir;
        // $ongkir = $hargaongkir;
        $totalx=1;
        $user=auth()->user();
        

        // $total2 = cart::where('user_id',$userid)
        // ->select('id','price')
        // ->sum('id'*'price');

        

        $totalx2 = cart::where('user_id',$userid)
                    ->sum(DB::raw('price * quantity'));

        if($totalx2==0){
            $totalx=1;
        } else  
        {
            $totalx = cart::where('user_id',$userid)
                    ->sum(DB::raw('price * quantity'));
            // $totalx = $totalx + $ongkir;
        }

        // $total = \DB::select('SELECT SUM(quantity * price) FROM carts WHERE user_id = ?', [$userid]);
        
        

        // $total2 = $total[0];

        // $cartotal = new cart;

        // $cartotal->price = $total2;
        // $total3 = (int)$cartotal->price;
        // dd($totalx);
        // $total1 = cart::where('user_id',$user->id)
        // ->sum('price');

        // $total2 = cart::where('user_id',$user->id)
        // ->sum('quantity');

        // $total3 = $total1 * $total2;

        $userid = Auth::user()->id;
        $username = Auth::user()->name;
        $useremail = Auth::user()->email;
        $userphone = Auth::user()->phone;
        $useraddress = Auth::user()->address;

        // Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'SB-Mid-server-RRvJJlHi9BZXkBb21Z9CUnTQ';
// \Midtrans\Config::$serverKey = 'Mid-server-YMLuwBJ50AMss0SXr1BH7hWe';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;
 
$diskon2=0;
$diskon_temp=0;
$temp=0;
// $temp=$userdiskon->status_pakai;
if($totalx!=1){

if($userdiskon!=null)
{
    
if($userdiskon->status_pakai==0)
        {
            $diskon = diskon::find($userdiskon->diskon_id);
            $diskon2=10;
            $totalx2 = $totalx;
            $diskon_temp = (float)($totalx * (float)($diskon->diskon/100)); 
            $totalx = $totalx - $diskon_temp;
            
        } else{
            $diskon_temp=0;
        }
    }

    } else{
        $totalx=1;
        $diskon_temp=0;
        //$diskon2=0;
    }
            
        

    $params = array(
    'transaction_details' => array(
        'order_id' => rand(),
        //gross amount =  total harga
        
        'gross_amount' => $totalx + $request->total_ongkir,
    ),

    // 'item_details' => array(
    //    [
    //     'id' => 'a01',
    //     'price' => '7000',
    //     'quantity' => 1,
    //     'name' => "Apple"
    //    ],
    //    [
    //     'id' => 'b01',  
    //     'price' => '7000',
    //     'quantity' => 1,
    //     'name' => "Orange"
    //    ]
    //     ),

    'customer_details' => array(
        'first_name' => $username,
        'last_name' => '',
        'email' => $useremail,
        'phone' => $userphone,
    ),
);
 
    $snapToken = \Midtrans\Snap::getSnapToken($params);

    $snap_token = $snapToken;

    //return $snapToken;

    //return view('user.payment', ['snap_token'=>$snapToken]);

    //return view('user.payment', compact('snap_token','userid'));



        // $userid = Auth::user()->id;
        // $user=auth()->user();

        //$item=new cart;

        

        $cart=cart::where('user_id',$user->id)->get();

            $count=cart::where('user_id',$user->id)->count();

            

        return view('user.showcart',compact('count','cart','userid','totalx','snap_token','hargaongkirbeneran','jasapengirimanbeneran','diskon_temp','diskon2','totalx2'));
    }



    public function deletecart($id)
    {
        $data=cart::find($id);

        $data->delete();

        return redirect()->back()->with('message','Product Removed Succesfully');
    }

    public function aboutus()
    {
        if(Auth::id())
        {

        $userid = Auth::user()->id;
        $user=auth()->user();

        $data = product::paginate(9);


        $cart=cart::where('user_id',$user->id)->get();

            $count=cart::where('user_id',$user->id)->count();


        return view('user.aboutus',compact('count','cart','data','userid'));

        }

        else
        {
            return view('user.aboutus');
        }
        
    }

    public function confirmorder(Request $request)
    {
        //$product=product::all();

        $user=auth()->user();

        $name=$user->name;

        $phone=$user->phone;

        $address=$user->address;

        // $order_transaction_id=$id;

        


        foreach($request->productname as $key=>$productname)
        {
            $user=auth()->user();
            $userid = Auth::user()->id;

           
            $order_transaction_id = DB::table('transactions')
            ->where('user_id',$userid)
            ->MAX('id');
            // ->latest()
            // ->first('id');

            // $tes = 

            
            // $tes = \DB::select('SELECT id FROM transactions ORDER BY id DESC LIMIT 1');
            // $tes = \DB::select('SELECT LAST_INSERT_ID()');
            // die(var_dump($tes));
            // dd($tes);

            // $order_transaction_id = (String)$tes;
            // dd($order_transaction_id);
            // dd($tes);
            // die(var_dump($tes));
            
            //dd($tes);

            //$order_transaction_id = \DB::select('SELECT id from transactions WHERE user_id = ? ORDER BY id DESC LIMIT 1', [$userid]);
            // dd($tes);
            

            // $order_transaction_id = (int)$string;

            // dd($order_transaction_id);
            

            // $order_transaction_id = DB::table('transactions')
            // ->where('user_id',$userid)
            // ->orderBy('id','desc')->first();
            // ->latest('id')
            // ->first();
            
            //DB::table('transactions')->latest()->first()->value('id');

            $order=new order;

            $order->user_id=$user->id;  

            //$productid=cart::where('product_id',$product->id)->get();

            // $product=product::find($id);

            $order->product_id=$request->productid[$key];

            $order->product_name=$request->productname[$key];

            $order->price=$request->price[$key];

            $order->quantity=$request->quantity[$key];

            $order->name=$name;

            $order->phone=$phone;

            $order->address=$address;

            $order->transaction_id=$order_transaction_id;

            
            $order->save();



        }

        DB::table('carts')->where('user_id',$user->id)->delete();


        return redirect()->back()->with('message','Product Ordered Succesfully');
    }

    public function userprofile()
    {

        //$userid=user::where('id',$user->id)->get();

        
        //$userid=user::find($id)->get();

        $user=auth()->user();

        //$userid =user::find($id);

        $userid = Auth::user()->id;
        $username = Auth::user()->name;
        $useremail = Auth::user()->email;
        $userphone = Auth::user()->phone;
        $useraddress = Auth::user()->address;

        //$data = product::paginate(9);

        //$userid=user::where('id',$user->id)->get();


        $cart=cart::where('user_id',$user->id)->get();

            $count=cart::where('user_id',$user->id)->count();


        return view('user.userprofile',compact('count','cart','userid','username','useremail','userphone','useraddress'));
        
    }

    public function updateuserprofile(Request $request,$id)
    {
       $data=user::find($id); 

        $data->name=$request->name;

        $data->email=$request->email;

        $data->phone=$request->phone;

        $data->address=$request->address;

        //$data->password=$request->password;


        $data->save();

        return redirect()->back()->with('message','Profile Updated Succesfully');
    }


    public function updateuserktm(Request $request,$id)
    {
        
    $data=new fotoktm;
    $user=auth()->user();
    $userid = Auth::user()->id;

    //    $data->userid=user::find($id); 

       $image=$request->file;

       $imagename=time().'.'.$image->getClientOriginalExtension();

       $request->file->move('productimage',$imagename);

       $data->image=$imagename;

        // $data->name=$request->name;

        // $data->email=$request->email;

        // $data->phone=$request->phone;

        // $data->address=$request->address;

        //$data->password=$request->password;

        $data->user_name=Auth::user()->name;

        $data->user_id=$userid;


        $data->save();

        return redirect()->back()->with('message','KTM Berhasil di Upload!');
    }

    // public function showhistory()
    // {
    //     $userid = Auth::user()->id;
    //     $user=auth()->user();
        

    //     $history=order::where('phone',$user->phone)->get();

    //     $cart=cart::where('user_id',$user->id)->get();

    //         $count=cart::where('user_id',$user->id)->count();


    //     return view('user.showhistory',compact('count','cart','userid','history'));
    // }

    public function showhistory()
    {
        
        $user=auth()->user();
        $userid = Auth::user()->id;
        

        $history=transaction::where('user_id',$userid)->get();

        $cart=cart::where('user_id',$user->id)->get();

            $count=cart::where('user_id',$user->id)->count();


        return view('user.showhistory',compact('count','cart','userid','history'));
    }



//     public function payment(Request $request)
//     {
       

//         $total = cart::where('user_id',$user->id)
//         ->sum('price');

//         $user=auth()->user();
//         $userid = Auth::user()->id;
//         $username = Auth::user()->name;
//         $useremail = Auth::user()->email;
//         $userphone = Auth::user()->phone;
//         $useraddress = Auth::user()->address;


//         $cart_temp=new cart;

//         $cart_temp=cart::where('user_id',$user->id)->get();


//         // Set your Merchant Server Key
// \Midtrans\Config::$serverKey = 'SB-Mid-server-RRvJJlHi9BZXkBb21Z9CUnTQ';
// // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
// \Midtrans\Config::$isProduction = false;
// // Set sanitization on (default)
// \Midtrans\Config::$isSanitized = true;
// // Set 3DS transaction for credit card to true
// \Midtrans\Config::$is3ds = true;
 
//     $params = array(
//     'transaction_details' => array(
//         'order_id' => rand(),
//         //gross amount =  total harga
//         'gross_amount' => $total,
//     ),

//     // 'item_details' => array(
//     //    [
//     //     'id' => 'a01',
//     //     'price' => '7000',
//     //     'quantity' => 1,
//     //     'name' => "Apple"
//     //    ],
//     //    [
//     //     'id' => 'b01',  
//     //     'price' => '7000',
//     //     'quantity' => 1,
//     //     'name' => "Orange"
//     //    ]

//     // foreach($request->cart_temp as $key=>$cart_temp)
//     // {
//     //     [
//     //     'id' => 'a01',
//     //     'price' => '7000',
//     //     'quantity' => 1,
//     //     'name' => "Apple"
//     //     ]
//     // }

//         // ),

//     'customer_details' => array(
//         'first_name' => $username,
//         'last_name' => '',
//         'email' => $useremail,
//         'phone' => $userphone,
//     ),
// );
 
//     $snapToken = \Midtrans\Snap::getSnapToken($params);

//     $snap_token = $snapToken;

//     //return $snapToken;

//     //return view('user.payment', ['snap_token'=>$snapToken]);

//     return view('user.payment', compact('snap_token','userid'));


//     }

    public function payment_post(Request $request)
    {

        //$userdiskon=user_diskon::where('user_id', $userid)->first();

         $userid = Auth::user()->id;

        $userdiskon=user_diskon::where('user_id', $userid)->first();


        if($userdiskon==null)
        {
            // $userdiskon->save();

        $user=auth()->user();
        $userid = Auth::user()->id;
        $username = Auth::user()->name;
        $useremail = Auth::user()->email;
        $userphone = Auth::user()->phone;
        $useraddress = Auth::user()->address;
        
        $json = json_decode($request->get('json'));

        $transaction = new transaction();
        $transaction->status = $json->transaction_status;
        $transaction->user_id = $userid;
        $transaction->user_name = $username;
        $transaction->user_email = $useremail;
        $transaction->user_phone = $userphone;
        $transaction->transaction_id = $json->transaction_id;
        $transaction->order_id = $json->order_id;
        $transaction->gross_amount = $json->gross_amount;
        $transaction->payment_type = $json->payment_type;
        $transaction->payment_code = isset($json->payment_code) ? $json->payment_code :  null;
        $transaction->pdf_url = isset($json->pdf_url) ? $json->pdf_url :  null;
        $transaction->total_ongkir = $request->total_ongkir;
        $transaction->jasa_pengiriman = $request->jasa_pengiriman;
        }
            else
            {
        $userdiskon->status_pakai=1;
        $userdiskon->save();

        $user=auth()->user();
        $userid = Auth::user()->id;
        $username = Auth::user()->name;
        $useremail = Auth::user()->email;
        $userphone = Auth::user()->phone;
        $useraddress = Auth::user()->address;
        
        $json = json_decode($request->get('json'));

        $transaction = new transaction();
        $transaction->status = $json->transaction_status;
        $transaction->user_id = $userid;
        $transaction->user_name = $username;
        $transaction->user_email = $useremail;
        $transaction->user_phone = $userphone;
        $transaction->transaction_id = $json->transaction_id;
        $transaction->order_id = $json->order_id;
        $transaction->gross_amount = $json->gross_amount;
        $transaction->payment_type = $json->payment_type;
        $transaction->payment_code = isset($json->payment_code) ? $json->payment_code :  null;
        $transaction->pdf_url = isset($json->pdf_url) ? $json->pdf_url :  null;
        $transaction->total_ongkir = $request->total_ongkir;
        $transaction->jasa_pengiriman = $request->jasa_pengiriman;
            }
        
            
        //$transaction->save();
    
        return $transaction->save() ? redirect(url('/showcart'))->with('alert-success', 'Transaksi Berhasil') : redirect(url('/'))->with('alert-failed', 'Terjadi Kesalahan');
    //view('user.showcart', compact('order_transaction_id'))
    }





    // public function change()
    // {

    //     var elem = document.getElementById("myButton1");
    // if (elem.value=="Close Curtain") elem.value = "Open Curtain";
    // else elem.value = "Close Curtain";


    // }

    public function cekongkir()
    {

        // $cost = RajaOngkir::ongkosKirim([
        //     'origin'    => 255,
        //     'destination'    => $destination,
        //     'weight'    => $weight,
        //     'courier'    => $courier,
        // ])->get();

        $user=auth()->user();
        $userid = Auth::user()->id;

        $provinces = Province::pluck('name', 'province_id');
        return view('user.ongkir', compact('provinces','userid'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities($id)
    {
        $city = City::where('province_id', $id)->pluck('name', 'city_id');
        return response()->json($city);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check_ongkir(Request $request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => $request->city_origin, // ID kota/kabupaten asal
            'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
            'weight'        => $request->weight, // berat barang dalam gram
            'courier'       => $request->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();


        return response()->json($cost);
    }

    public function showhistorydetail($id)
    {
        $user=auth()->user();
        $userid = Auth::user()->id;

        $history=transaction::where('id',$id)->get();
        $order=order::where('transaction_id',$id)->get();
        $cart=cart::where('user_id',$user->id)->get();

            $count=cart::where('user_id',$user->id)->count();

        return view('user.showhistorydetail',compact('history', 'order','count','userid'));
    }

    public function hargaongkir(Request $request)
    {   
        $hargaongkir2 = $request->hargaongkirharga;
        $user=auth()->user();
        $userid = Auth::user()->id;
        $count=cart::where('user_id',$user->id)->count();
        // $hargaongkir2 = $hargaongkir;
        $cart=cart::where('user_id',$user->id)->get();

        
        // View::share($hargaongkir2);
        // showcart();

    //     $snapToken = \Midtrans\Snap::getSnapToken($params);

    // $snap_token = $snapToken;

        // return view('user.showcart', compact('userid','count','hargaongkir'));

        // return redirect()->route('showcart')->compact('hargaongkir2');

        // return redirect()->route('showcart',['hargaongkir2'=>$hargaongkir]);

        // return view('user.home',compact('hargaongkir2','count','userid'));

        return redirect('showcart', compact($hargaongkir2));
    }

    
}
