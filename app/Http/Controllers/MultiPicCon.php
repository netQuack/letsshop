<?php

namespace App\Http\Controllers;

use App\Models\MultiPics;
use Illuminate\Http\Request;
use Image;
use Auth;
use Illuminate\Support\Carbon;

class MultiPicCon extends Controller
{
    //


    public function __construct(){

        $this->middleware('auth');
    }


    public function MultiPics(){



    $images = MultiPics::all();

    return view('admin.multipics.index', compact('images'));
    }

    
    public function AddImages(Request $request){

        //image insertion
        $image = $request->file('image');



        foreach($image as $multi_img){
         
        //IMAGE INTERVENTION
        $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
        Image::make($multi_img)->resize(300,200)->save('images/multipics/'.$name_gen);
        $last_img = 'images/multipics/'.$name_gen;

        MultiPics::insert([
        'image' => $last_img,
        'created_at' => Carbon::now()
    ]);
    }//end of loop 
        return Redirect()->back()->with('success','Brands multiple images are inserted successfully.');



}}
