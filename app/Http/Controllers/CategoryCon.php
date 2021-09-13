<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;

class CategoryCon extends Controller
{
    public function AllCat(){

        //read the data
        //$categories = Category::all();

       // $categories = Category::latest()->get();

        //end of reading data


        //read data with quesry builder

        $categories = DB::table('categories')->latest()->paginate(5);


        //end of reading data with query builder




        return view('admin.category.index', compact('categories'));


    }


    public function AddCat(Request $request){


        $validated = $request->validate([
        'category_name' => 'required|unique:categories|max:20',
        //'body' => 'required',
    ],

    [
        'category_name.required' => 'Please input the category name.',
        'category_name.max' => 'Input limit is 20 charecters.',

    ]);




        // eloquent old style of data insertion
        
        Category::insert([
        'category_name' => $request->category_name,
        'user_id' => Auth::user()->id,
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

        return Redirect()->back()->with('success','Category inserted successfully');

    }



}
