<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactCon;
use App\Http\Controllers\CategoryCon;
use App\Models\User;
use App\Http\Controllers\BrandCon;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});







Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    
    $users = User::all();




    return view('dashboard',compact('users'));
})->name('dashboard');



//Category Controller

    Route::get('/category/all', [CategoryCon::class, 'AllCat'])->name('all.category');
    Route::post('/category/add', [CategoryCon::class,'AddCat'])->name('store.category');
    Route::get('/category/edit/{id}', [CategoryCon::class, 'Edit']);

    Route::post('/category/update/{id}',[CategoryCon::class, 'Update']);

    Route::get('/softdelete/category/{id}', [CategoryCon::class, 'SoftDelete']);

    Route::get('/category/restore/{id}', [CategoryCon::class, 'Restore']);

    Route::get('/permdelete/category/{id}', [CategoryCon::class, 'PermDelete']);


//Brand Controller Routes
        Route::get('/brand/all', [BrandCon::class, 'AllBrand'])->name('all.brand');
        Route::post('/brand/add', [BrandCon::class,'AddBrand'])->name('store.brand');







Route::get('/about', function () {
    return view('about');
    //echo "THIS IS THE ABOUT PAGE";
});



// Route::get('/about', function () {
//     return view('about');
//     //echo "THIS IS THE ABOUT PAGE";
// })->middleware('check');



// Route::get('/contact', function () {
//     return view('contact');
//     //echo "THIS IS THE CONTACT PAGE";
// });

Route::get('/contact', [ContactCon::class, 'index']);



Route::get('/map', function () {
    return view('map');
    //echo "THIS IS THE CONTACT PAGE";
});
