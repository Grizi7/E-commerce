<?php



use App\Models\User;
use Illuminate\Support\Facades\Route;

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
Route::get('/admin/admins', function () {
    return view('admin.admins', [
        'do' => 'view',
        $admins = User::all()->where('role', true)
    ]);
});
Route::get('/admin/admins/add', function () {
    return view('admin.admins', [
        'do' => 'add',
    ]);
});
Route::get('/admin/admins/edit/{id}', function ($id) {
    return view('admin.admins', [
        'do' => 'edit',
        'admin' => User::findOrFail($id)->where('role', true)
    ]);
});
Route::get('/admin/admins/delete/{id}', function ($id) {
    return view('admin.admins', [
        'do' => 'delete',
        'admin' => User::findOrFail($id)->where('role', true)
    ]);
});


Route::group(['middleware'=>[]],function(){
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::get('/dashboard', function () {
        return view('admin.index');
    });
});
