<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\vehicle;
use App\models\blog;
use App\models\wishlist;
use App\models\brand;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class mainhomecontroller extends Controller
{
    function car_show(request $request){
        $types = brand::get();
        $query = vehicle::query();
        if($request->ajax())
        {
            if(empty($request->category)){
                $cars = $query->get();
<<<<<<< HEAD
                if($cars)
                $output ='';
                {
                    foreach($cars as $car)
                    {
                        $output .=
                        '
                        <div class="col-xl-4 col-lg-6">
                        <div class="de-item mb30">
                                <div class="d-img">
                                    <img src="'. $car->car_image .'" class="img-fluid"
                                        style="width: 100%;height: 240px;" alt=" '.$car->car_name .'">
                                </div>
                                <div class="d-info">
                                    <div class="d-text">
                                        <a class="h2" href="/car/'.$car->id.'">
                                            <h3> '.$car->car_name .'</h3>
                                        </a>
                                        <div class="d-item_like">
                                        <a onclick="addToWishlist({{'. $car->id .'}})" href="javascript:void(0);"><i class="fa fa-heart"></i></a><span> '.$car->car_review.' </span>
                                            // <i class="fa fa-heart"></i><span> '.$car->car_review.' </span>
                                        </div>
                                        <div class="d-atr-group">
                                            <span class="d-atr"><img src="images/icons/1-green.svg" alt="">
                                            '.$car->car_passenger.' </span>
                                            <span class="d-atr"><img src="images/icons/3-green.svg" alt="">
                                            '.$car->car_gate.' </span>
                                            <span class="d-atr"><img src="images/icons/4-green.svg" alt="">
                                            '.$car->car_type .'</span>
                                            <span class="d-atr"> '.$car->brand_name .'</span>
                                        </div>
                                        <div class="d-price">
                                            Daily rate from <span>$ '.$car->car_rent.' </span>
                                            <a class="btn-main" href="/car/'.$car->id.'">Rent
                                                Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        ';
                    }
                }
                return response()->json($output);
            }
            else{
=======
            }else{
>>>>>>> parent of 98a9d03 (o)
                $cars = $query->where(['car_type'=>$request->category])->get();
                if($cars)
                $output ='';
                {
                    foreach($cars as $car)
                    {
                        $output .=
                        '
                        <div class="col-xl-4 col-lg-6">
                        <div class="de-item mb30">
                                <div class="d-img">
                                    <img src="'. $car->car_image .'" class="img-fluid"
                                        style="width: 100%;height: 240px;" alt=" '.$car->car_name .'">
                                </div>
                                <div class="d-info">
                                    <div class="d-text">
                                        <a class="h2" href="">
                                            <h3> '.$car->car_name .'</h3>
                                        </a>
                                        <div class="d-item_like">
                                            <i class="fa fa-heart"></i><span> '.$car->car_review.' </span>
                                        </div>
                                        <div class="d-atr-group">
                                            <span class="d-atr"><img src="images/icons/1-green.svg" alt="">
                                            '.$car->car_passenger.' </span>
                                            <span class="d-atr"><img src="images/icons/3-green.svg" alt="">
                                            '.$car->car_gate.' </span>
                                            <span class="d-atr"><img src="images/icons/4-green.svg" alt="">
                                            '.$car->car_type .'</span>
                                            <span class="d-atr"> '.$car->brand_name .'</span>
                                        </div>
                                        <div class="d-price">
                                            Daily rate from <span>$ '.$car->car_rent.' </span>
                                            <a class="btn-main" href="">Rent
                                                Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        ';
                    }
                }
                return response()->json($output);
            }
        }
        $cars = $query->get();
        return view('car',compact('cars','types'));
    }
    function car_show_home(request $request){
        $types = brand::get();
        $query = vehicle::query();
        $cars = $query->get();
        return view('index',compact('cars','types'));
    }
    function blog_show(request $request){
        $blogs=blog::all();
        return view('blog',compact('blogs'));
    }
    function blog_single($slug){
        $blogs=blog::where('slug',$slug)->get();
        // dd($blogs);
        return view('blog-single',compact('blogs'));
    }
    function single_car_show($slug){
        $cars=vehicle::where('id',$slug)->get();
        // dd($blogs);
        return view('car-single',compact('cars'));
    }

    function dashboard(){
        $id=auth()->user()->id;
        // $users=DB::table('users')->where('id',$id)->get();
        $users=user::where('id',$id)->get();
        return view('account-dashboard',compact('users'));
    }
    function singleuser_dashboard(){
        $id=auth()->user()->id;
        // $users=DB::table('users')->where('id',$id)->get();
        $users=User::where('id',$id)->get();
        return view('account-profile',compact('users'));
    }
    function singleuser_dashboard_update($id,request $request){
        $users=DB::table('users')->where('id',$id)->update([
            'name'=> $request->username,
            'email'=> $request->email_address,
            'password'=> Hash::make($request->user_password),
        ]);

        return redirect()->back();
    }
    public function addToWishlist(Request $request)
    {
        if(Auth::check()== false)
        {
            session(['url.intended'=>url()->previous()]);
            return response()->jsoon([
                'status'=>false
            ]);
        }
        $wishlist = new wishlist;
        $wishlist -> user_id =Auth::user()->id;
        $wishlist -> user_id =$request->id;
        $wishlist->save();
        return response()->json([
            'status'=>true
        ]);
    }
}
