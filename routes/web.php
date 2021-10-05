<?php

use App\Http\Controllers\BackupController;
use App\Http\Controllers\ConsoleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\SupplierController;
use \App\Http\Controllers\ClientController;
use \App\Http\Controllers\CommandController;
use \App\Http\Controllers\MonthlyProfitController;
use \App\Http\Controllers\CommandMPController;

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

/********************* App routes :: Start *****************************************/

Route::get('/', function () {
    return redirect('dash');
    //return view('welcome');
});

/********************* App routes :: End *******************************************/

/********************* Dashboard routes :: Start ***********************************/

Auth::routes();

// main dash route
Route::get('/dash', [HomeController::class, 'index'])->name('dash');

// any links that have resources route starters must be before the resources routes

// menu-items routes
Route::get('dash/menus/menu-items/{menu}/create', [MenuItemController::class, 'create'])->name('menus.menu-items.create');
Route::get('dash/menus/menu-items/{menu}/edit/{menu_item}', [MenuItemController::class, 'edit'])->name('menus.menu-items.edit');
Route::post('dash/menus/menu-items/{menu}', [MenuItemController::class, 'store']);
Route::post('dash/menus/menu-items/{menu}/update', [MenuItemController::class, 'update_menu']);
Route::post('dash/menus/menu-items/{menu}/update/{menu_item}', [MenuItemController::class, 'update_menuItem']);
Route::post('dash/menus/menu-items/{menu}/delete/{menu_item}', [MenuItemController::class, 'delete_menuItem']);

// menu delete
Route::get('dash/menus/{menu}/delete', [MenuController::class, 'destroy']);

//permissions multi delete
Route::post('dash/permissions/delete-multi', [PermissionController::class, 'deleteMulti']);

//roles multi delete
Route::post('dash/roles/delete-multi', [RoleController::class, 'deleteMulti']);

//users multi delete
Route::post('dash/users/delete-multi', [UserController::class, 'deleteMulti']);

//backups
Route::get('dash/backups', [BackupController::class, 'index']);
Route::get('dash/backups/{backup}/download', [BackupController::class, 'download']);
Route::Delete('dash/backups/{backup}/delete', [BackupController::class, 'delete']);
Route::get('dash/backups/backup', [BackupController::class, 'backup']);

//exports and imports and PDFs
//Users
Route::get('dash/users/export', [UserController::class, 'export']);
Route::get('dash/users/{user}/pdf', [UserController::class, 'generatePdf']);

//console route
Route::get('dash/console', [ConsoleController::class, 'index']);
Route::get('dash/ide-helper', [ConsoleController::class, 'ideHelper']);
Route::get('dash/clear-cache', [ConsoleController::class, 'clearCache']);
Route::get('dash/optimize-cache', [ConsoleController::class, 'optimizeCache']);
Route::get('dash/add-model', [ConsoleController::class, 'addModel']);
Route::get('dash/commands/create/{client_id}', [CommandController::class, 'create']);
Route::post('dash/commands/store', [CommandController::class, 'store']);
Route::get('dash/commands/{id}/edit', [CommandController::class, 'edit']);
Route::post('dash/commands/{id}/update', [CommandController::class, 'update']);
Route::post('dash/commands/{id}/destroy', [CommandController::class, 'destroy']);
Route::get('dash/commands/{id}/viewInvoice', [CommandController::class, 'viewInvoice']);
Route::post('dash/monthlyProfit/{client}/{month}/{year}/store', [MonthlyProfitController::class, 'store']);
Route::get('dash/monthlyProfit/{id}/show', [MonthlyProfitController::class, 'show']);
// resources routes
Route::resources([
    'dash/permissions' => PermissionController::class,
    'dash/roles' => RoleController::class,
    'dash/menus' => MenuController::class,
    'dash/users' => UserController::class,
    'dash/products' => ProductController::class,
    'dash/suppliers' => SupplierController::class,
    'dash/clients' => ClientController::class,
    'dash/commands' => CommandController::class,
    'dash/CommandsMP' => CommandMPController::class,
    'dash/monthlyProfit' => MonthlyProfitController::class,
]);

/********************* Dashboard routes :: End **************************************/

// The fallback route should always be the last route registered by your application.
Route::fallback(function(){
    //test if you are in the dashboard
    if (substr(request()->path(), 0, strlen('dash')) === 'dash')
        return view('errors.dashboard.404')->with('error',true);
    else
        return view('errors.app.404')->with('error',true);
});
