<?php
use App\Http\Controllers\ProfileController;//9.43.x~
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ReservationController; //Add
use App\Models\Reservation; //Add

//予約：ダッシュボード表示(reservations.blade.php)
// 🔽 追加
Route::resource('reservation', ReservationController::class);
Route::get('/', [ReservationController::class,'index'])->middleware(['auth'])->name('reservation_index');
Route::get('/dashboard', [ReservationController::class,'index'])->middleware(['auth'])->name('dashboard');

//予約：追加 
Route::post('/ reservations',[ReservationController::class,"store"])->name('reservation_store');

//予約：削除 
Route::delete('/reservation/{reservation}', [ReservationController::class,"destroy"])->name('reservation_destroy');

//予約：更新画面
Route::post('/reservationsedit/{reservation}',[ReservationController::class,"edit"])->name('reservation_edit'); //通常
Route::get('/reservationsedit/{reservation}', [ReservationController::class,"edit"])->name('edit');      //Validationエラーありの場合

//予約：更新画面
Route::post('/reservations/update',[ReservationController::class,"update"])->name('reservation_update');

// 予約：確認画面
// Route::get('/reservations/{id}/confirm', [ReservationController::class, 'confirm'])->name('reservation.confirm');


/**
* 「ログイン機能」インストールで追加されています 
*/
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
