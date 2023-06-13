<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BoardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// as는 라우트네임 prefix 는 url
Route::group(['as'=>'boards', 'prefix' =>'boards'], static function() {
    // products 로 get 요청이 올 경우 ProductController 의 index 함수를 실행합니다.
    // name 은 별명으로 나중에 route('products.index') 로 쉽게 주소 출력이 가능합니다.
    Route::get('/', [BoardController::class, 'index'])->name('.index');
    Route::get('/create', [BoardController::class, 'create'])->middleware('auth')->name('.create');
    // store 요청은 form 을 통해 post 로 옵니다.
    Route::post('/store', [BoardController::class, 'store'])->name('.store');
    // {product}는 주소의 변경가능한 값이 오는 것을 product로 받는 것을 의미합니다, 이 값은 현재 아이디가 오는 데
    // 해당 아이디에 맞춘 모델 객체를 ProductController의 show 함수에 매개변수로 보내는 동작을 수행합니다.
    Route::get('/{board}',[BoardController::class, 'show'])->name(".show");

    Route::get('/{board}/edit', [BoardController::class, 'edit'])->name(".edit");
    // Laravel에서 업데이트의 대한 메서드로는 Patch 또는 Put을 권장합니다.
    Route::patch('/{board}', [BoardController::class, 'update'])->name('.update');

    Route::delete('/{board}', [BoardController::class, 'destroy'])->name('.destroy');
});

require __DIR__.'/auth.php';
