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

//  start query builder style data insertion

        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

//end of query builder style data insertion

      //  Professional way of eloquent data insertion

        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        return Redirect()->back()->with('success','Brand inserted successfully.');

    }
}
