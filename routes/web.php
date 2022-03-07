<?php

use App\Http\Controllers\AccountActivitiesController;
use App\Http\Controllers\AjaxMainController;
use App\Http\Controllers\BankAccountsController;
use App\Http\Controllers\BankDefinitionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChartJsController;
use App\Http\Controllers\Common\GenresController;
use App\Http\Controllers\Common\PlatformController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Epin\EpinProductController;
use App\Http\Controllers\Epin\EpinProductEntityController;
use App\Http\Controllers\EpinStockController;
use App\Http\Controllers\Genba\GenbaPriceController;
use App\Http\Controllers\Genba\GenbaProductController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\CompanyProductsController;
use App\Http\Controllers\ExchangePricesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EpayOrdersController;
use App\Http\Controllers\EpayProductsController;
use App\Http\Controllers\EpayReportsController;
use App\Http\Controllers\Genba\GenbaOrderLogsShredController;
use App\Http\Controllers\RazerOrdersController;
use App\Http\Controllers\RazerProductsController;

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

// Route::get('/', function () {
//     return redirect('/dashboard');
// });


Route::middleware(['auth'])->group(function () {
    Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');
    Route::get('/', function () {
        //return view('dashboard');
        return view('index');
    })->name('dashboard');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::resource('categories', CategoryController::class);
    Route::resource('epinProducts', EpinProductController::class);
    Route::resource('companies', CompanyController::class);
    Route::post('/saveCompanyProduct', [CompanyProductsController::class,'saveCompanyProduct'])->name('saveCompanyProduct.index');
    Route::post('/saveCurrency', [ExchangePricesController::class,'saveCurrency'])->name('saveCurrency.index');
    Route::resource('companiesProduct', CompanyProductsController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('genres', GenresController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('permission', RoleController::class);
    Route::resource('platforms',PlatformController::class);
    Route::resource('genbaProducts',GenbaProductController::class);
    Route::resource('genbaPrices',GenbaPriceController::class);
    // Route::get('epinStocks/productEntity',EpinStockController::class,'productEntity');
    Route::get('epinStocks/productEntity',[EpinStockController::class,'productEntity'])->name('epinStocks.productEntity');
    Route::resource('epinStocks',EpinStockController::class);
    Route::resource('transactions',TransactionController::class);
    Route::resource('bankDefinitions',BankDefinitionController::class);
    Route::resource('bankAccounts',BankAccountsController::class);
    Route::resource('exchangePrices',ExchangePricesController::class);
    Route::resource('accountActivities',AccountActivitiesController::class);
    Route::resource('razerProducts',RazerProductsController::class);
    Route::resource('razerOrders',RazerOrdersController::class);
    Route::resource('epayProducts',EpayProductsController::class);
    Route::resource('epayOrders',EpayOrdersController::class);
    Route::resource('epayReports',EpayReportsController::class);
    // Route::get('transactionJs',[ChartJsController::class, 'transactionJs'])->name('transactionJs.index');
    Route::resource('genbaOrderLogsShred', GenbaOrderLogsShredController::class);

    // Route::get('/epinStocks',[EpinStockController::class,'index'])->name('epinStocks.index');
    // route::post('/epinStocks',[EpinStockController::class,'store'])->name('epinStocks.store');
    // route::get('/epinStocks/{id}',[EpinStockController::class,'show'])->name('epinStocks.show');
    // route::post('epinStocks/create',[EpinStockController::class,'create'])->name('epinStocks.create');
    // route::delete('/epinStocks/{id}',[EpinStockController::class,'destroy'])->name('epinStocks.destroy');

    Route::get('/epinProductEntities', [EpinProductEntityController::class, 'index'])->name('epinProductEntities.index');
    Route::post('/epinProductEntities', [EpinProductEntityController::class, 'store'])->name('epinProductEntities.store');
    Route::get('/epinProductEntities/{id}', [EpinProductEntityController::class, 'show'])->name('epinProductEntities.show');
    Route::get('/epinProductEntities/create', [EpinProductEntityController::class, 'create'])->name('epinProductEntities.create');
    Route::delete('/epinProductEntities/{id}', [EpinProductEntityController::class, 'destroy'])->name('epinProductEntities.destroy');

    Route::get('/resetNote', [AjaxMainController::class, 'resetNote'])->name('resetNote.index');
    Route::get('/flagStatus', [AjaxMainController::class, 'flagStatus'])->name('flagStatus.index');
    Route::get('ajaxData', [AjaxMainController::class, 'getAjaxData'])->name('getAjaxData');
    Route::get('ajaxData2', [AjaxMainController::class, 'getAjaxData2'])->name('getAjaxData2');
    
});
Route::get('media',[MediaController::class,'index']);



require __DIR__ . '/auth.php';
