<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Auth;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;


class BrandCon extends Controller
{
    

    public function AllBrand(){



         $brands = Brand::latest()->paginate(5);

        return view('admin.brand.index', compact('brands'));

    }


   public function AddBrand(Request $request){

        $validated = $request->validate([
        'brand_name' => 'required|unique:brands|max:20',
        //'body' => 'required',
    ],
    [
        'brand_name.required' => 'Please input the brand name.',
        'brand_name.max' => 'Input limit is 20 charecters.',

    ]);

        //image insertion
        $brand_image = $request->file('brand_image');
        //auto generate
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'images/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name);
        // eloquent old style of data insertion
        
        Brand::insert([
        'brand_name' => $request->brand_name,
        'brand_image' => $last_img,
        'created_at' => Carbon::now()
    ]);

        return Redirect()->back()->with('success','Brand inserted successfully.');

    }

    public function Edit($id){

        //eloquent style
        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }
   

    //update

    public function Update(Request $request, $id){
        //eloquent style
        $validated = $request->validate([
        'brand_name' => 'required|min:4',
        
    ],
    [
        'brand_name.required' => 'Please input the brand name.',
        'brand_name.min' => 'Input 4 charecters atleast.',
    ]);
        
        //image update

        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');

        if($brand_image){


        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'images/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name);
         

        unlink($old_image);
        Brand::find($id)->update([
        'brand_name' => $request->brand_name,
        'brand_image' => $last_img,
        'created_at' => Carbon::now()]);
        return Redirect()->back()->with('success','Brand updated successfully.');

        }
        else{

        Brand::find($id)->update([
        'brand_name' => $request->brand_name,
        'created_at' => Carbon::now()]);
        return Redirect()->back()->with('success','Brand updated successfully.');




        }

       
    }





}
