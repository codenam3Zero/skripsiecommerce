<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Product;

use App\Models\Order;

//asslinya admin tidak bustuh 3 ini
use App\Models\Cart;

use Illuminate\Support\Facades\DB;

use App\Models\User;

class AdminController extends Controller
{
    public function product()
    {
        
        if(Auth::id())
        {
            
        //$usertype=Auth::user()->usertype;

        if(Auth::user()->usertype=='0')
        {
            //return view('user.error');
            return redirect()->back();
        }

        else
        {
        return view('admin.product');
        }

        
    }

    else
        {
            return redirect('login');
        }
    }

    public function uploadproduct(Request $request)
    {
        $data=new product;

        $image=$request->file;

        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->file->move('productimage',$imagename);

        $data->image=$imagename;


        $data->title=$request->title;

        $data->price=$request->price;

        $data->description=$request->des;

        $data->quantity=$request->quantity;


        $data->save();

        return redirect()->back()->with('message','Product Added Succesfully');
    }




    public function showproduct()
    {
        $usertype=Auth::user()->usertype;

        if($usertype!='1')
        {
            return view('user.error');
        }
        else
        {
        $data=product::all();

        return view('admin.showproduct',compact('data'));
        }
    }

    public function deleteproduct($id)

    {
        $data=product::find($id);

        $data->delete();

        return redirect()->back()->with('message','Product Deleted');
    }


    public function updateview($id)
    {
        $data=product::find($id);

        return view('admin.updateview',compact('data'));
    }

    public function redirect2()
    {
        // if(Auth::id())

        // {
        //     return redirect('redirect');
        // }

        // else

        {
            
            $data = product::paginate(9);

            $count=0;
            return view('user.home',compact('data','count'));
        }

        
    }

    public function redirect3()
    {

       
        
            $data = product::paginate(9);

            $user=auth()->user();

            //$userid=user::where('id',$user->id)->get();
            $userid = Auth::user()->id;

            $count=cart::where('phone',$user->phone)->count();

            return view('user.home',compact('data','count','userid'));
        

    }


    public function updateproduct(Request $request,$id)
    {
        $data=product::find($id);

        $data2=new product;
        //$data2= new product;

        $image=$request->file;

        if($image)
        {

        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->file->move('productimage',$imagename);

        $data->image=$imagename;
    }

        $data->title=$request->title;

        $data->price=$request->price;

        $data->description=$request->des;

        //ambil quantity dari form
        $data->quantity=$request->quantity;

        //ambil addquantity dari form
        $data2->quantity=$request->addquantity;

        //addquantity form jadi variabel
        $varaddquantity=$data2->quantity;

        //quantity dari form jadi variabel
        $varquantity=$data->quantity;

        //$data->addquantity=$request->addquantity;

        //$data2->addquantity=$request->addquantity;

        //$varquantity=$data->quantity;

        //$varaddquantity=$data2;

        //(int)$var3=(int)$varquantity+(int)$varaddquantity;

        $data->quantity=$varquantity+$varaddquantity;

            $data->save();

        // if($varaddquantity!=0)
        // {
        //     $data->quantity=$varquantity+$varaddquantity;

        //     $data->save();
        // }
        // else
        // {
        //     $data->save();
        // }

        

        return redirect()->back()->with('message','Product Updated Succesfully');
    }

    public function showorder()
    {

        $usertype=Auth::user()->usertype;

        if($usertype!='1')
        {
            return view('user.error');
        }
        else
        {
        $order=order::all();

        return view('admin.showorder',compact('order'));
        }
    }

    public function updatestatus($id)
    {

        $order=order::find($id);

        $order->status='delivered';

        $order->save();

        return redirect()->back();
    }
}
