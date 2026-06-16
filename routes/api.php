
<?php

use App\Http\Controllers\Admin\Auth\LoginAdminController;
use App\Http\Controllers\Category\CreateCategoryController;
use App\Http\Controllers\SubCategory\SubCategoryController;
use App\Http\Controllers\Users\LoginController;
use App\Http\Controllers\Users\RegisterController;
use App\Http\Controllers\Users\verifyAccountController;
use App\Http\Controllers\Admin\Auth\RegisterAdminController;
use App\Http\Controllers\attributeProducts\PhoneProdController;
use App\Http\Controllers\CartItem\crudCartItemController;
use App\Http\Controllers\Offer\OfferController;
use App\Http\Controllers\Order\crudOrderController;
use App\Http\Controllers\Product\CrudProductController;
use Illuminate\Support\Facades\Cookie;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Http\Controllers\Property\Color\ColorController;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Property\CrudPropertyController;
use App\Http\Controllers\Property\ColorImageProduct\ColorImageproController;
// use App\Http\Controllers\Users\VideoController;
// use App\Http\Controllers\VideoController;
use App\Http\Controllers\information\InfoSiteController;

use Illuminate\Support\Facades\Route;
// Route::get('users/{id}', [UserController::class, 'getInfo']);
Route::get('/infosite', [InfoSiteController::class, 'getInfo']);
//Authentication::
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/verifiy',[verifyAccountController::class, 'verify']);
// Route::post('/verify/whatsup', [verifyAccountController::class, 'whatsup']);
Route::post('/token_refresh', [LoginController::class, 'refresh']);


// Category::
Route::get('/Category',[CreateCategoryController::class,'index']);
Route::post('/category/create',[CreateCategoryController::class,'create']);

//subcategory::
Route::prefix('Subcategory')->group(function () {
Route::get('/',[SubCategoryController::class,'index']);
Route::get('/Tag',[SubCategoryController::class,'filter']);
Route::post('/Create',[SubCategoryController::class,'create']);
});
//Product::
Route::get('/Product',[CrudProductController::class,'index']);
Route::post('/Product/Create',[CrudProductController::class,'create']);

//Color&&ColorImage::
//Color::
Route::get('/Color',[ColorController::class,'index']);
Route::post('/color/Create',[ColorController::class,'create']);
//ColorImage::
Route::post('/colorImage',[ColorImageproController::class,'create']);
Route::get('/colorImage/list',[ColorImageproController::class,'index']);
//Property::
Route::post('/Property/Create',[CrudPropertyController::class,'createProperty']);
Route::get('/Product/{id}',[CrudProductController::class,'show']);
//


//Offer::
Route::prefix('/Offer')->group(function () {


Route::get('/index',[OfferController::class,'index'])->middleware('auth:customer');
Route::post('/Create',[OfferController::class,'create'])->middleware('auth:customer');
Route::post('/{id}/addproducts',[OfferController::class,'addingProducts'])->middleware('auth:customer');
Route::get('/{id}',[OfferController::class,'show'])->middleware('auth:customer');
});
// CartItem::
Route::get('/Cart',[crudCartItemController::class,'show'])->middleware('auth:customer');
Route::post('/CartItem/Create',[crudCartItemController::class,'create'])->middleware(['auth:customer','verify.csrf.header']);
Route::post('/CartItem/{id}/update',[crudCartItemController::class,'update']);
//Order::
Route::post('/Order/Create',[crudOrderController::class,'create'])->middleware('auth:customer');

//Admin::
Route::post('/Admin/register',[RegisterAdminController::class,'register']);
Route::post('/Admin/login',[LoginAdminController::class,'login']);
Route::post('/csrf-token',[LoginAdminController::class,'csrf']);












// Route::get('/login', function () {
//     return response()->json(['error' => 'Unauthorized'], 401);
// })->name('login');
// Route::get('/ping', function () {
//     return ['pong' => true];
// });
