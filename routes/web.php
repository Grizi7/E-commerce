<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Admins;
use App\Http\Controllers\Admin\Items;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/admin', function () {
    return view('admin.auth.signin');
});

// admins routes
Route::get('/admin/admins',[Admins::class,'index']);
Route::get('/admin/admins/add', [Admins::class,'create']);
Route::post('/admin/admins/add', [Admins::class,'store']);
Route::get('/admin/admins/stored/{id}', [Admins::class,'stored']);
Route::get('/admin/admins/edit/{id}', [Admins::class,'edit']);
Route::patch('/admin/admins/edit/{id}', [Admins::class,'update']);
Route::get('/admin/admins/updated/{id:updated_at}', [Admins::class,'updated']);
Route::delete('/admin/admins', [Admins::class,'destroy']);


// products routes
Route::get('/admin/products',[Items::class,'index']);
Route::get('/admin/products/add', [Items::class,'create']);
Route::post('/admin/products/add', [Items::class,'store']);
Route::get('/admin/products/stored/{id}', [Items::class,'stored']);
Route::get('/admin/products/edit/{id}', [Items::class,'edit']);
Route::patch('/admin/products/edit/{id}', [Items::class,'update']);
Route::get('/admin/products/updated/{id:updated_at}', [Items::class,'updated']);
Route::delete('/admin/products', [Items::class,'destroy']);


Route::group(['middleware'=>[]],function(){
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::get('/dashboard', function () {
        return view('admin.index');
    });
});
