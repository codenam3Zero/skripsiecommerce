<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\Models\User;

use App\Models\Product;

use App\Models\Cart;

use App\Models\Order;

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

    public function showcart()
    {
        $userid = Auth::user()->id;
        $user=auth()->user();

        $cart=cart::where('user_id',$user->id)->get();

            $count=cart::where('user_id',$user->id)->count();


        return view('user.showcart',compact('count','cart','userid'));
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


        foreach($request->productname as $key=>$productname)
        {


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

    public function showhistory()
    {
        $userid = Auth::user()->id;
        $user=auth()->user();

        $history=order::where('phone',$user->phone)->get();

        $cart=cart::where('user_id',$user->id)->get();

            $count=cart::where('user_id',$user->id)->count();


        return view('user.showhistory',compact('count','cart','userid','history'));
    }





    // public function change()
    // {

    //     var elem = document.getElementById("myButton1");
    // if (elem.value=="Close Curtain") elem.value = "Open Curtain";
    // else elem.value = "Close Curtain";


    // }
}
