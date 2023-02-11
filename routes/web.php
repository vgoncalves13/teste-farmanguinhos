<?php

use Illuminate\Support\Facades\Route;

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
    //Redirect to login page
    return redirect('/login');
});

Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'index'])->middleware(['auth'])->name('dashboard');
//Route to delete a user
Route::delete('users/{id}', function ($id) {
    App\Models\User::destroy($id);
    return redirect('/dashboard');
})->middleware(['auth'])->name('users.destroy');

// Route::get('create_user', function () {
//     return view('create-user');
// })->middleware(['auth'])->name('create_user');

require __DIR__.'/auth.php';
