<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DppController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\AdpCostController;
use App\Http\Controllers\RadpCostController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\SubExpenditureController;
use App\Http\Controllers\ProjectDatabaseController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

route::get('/', [HomeController::class, 'index' ]);

Route::get('/AddProject', [ProjectController::class, 'showAddProjectForm']);
Route::get('/getSubCRCOptions', [ProjectController::class, 'getSubCRCOptions']);       // Dynamic Dropdown
Route::post('/AddProject', [ProjectController::class, 'addProject'])->name('addProject');

Route::get('/ProjectDatabase', [ProjectDatabaseController::class, 'showProjects'])->name('showProjects');
Route::get('/ProjectView/{id}', [ProjectDatabaseController::class, 'viewProject'])->name('viewProject');
Route::get('/ProjectEdit/{id}', [ProjectDatabaseController::class, 'editProject'])->name('editProject');
Route::delete('/ProjectDatabase/{id}', [ProjectDatabaseController::class, 'deleteProject'])->name('deleteProject');
Route::get('/getSubCRCOptions', [ProjectDatabaseController::class, 'getSubCRCOptions'])->name('getSubCRCOptions');
Route::post('/ProjectUpdate/{id}', [ProjectDatabaseController::class, 'updateProject'])->name('updateProject');

Route::get('/DppInformation', [DppController::class, 'showDppForm']);
Route::get('/getSubEconomicCodes', [DppController::class, 'getSubEconomicCodes']);
Route::get('/getCategoryCodes', [DppController::class, 'getCategoryCodes']); 
Route::get('/getSubCRCOptions', [DppController::class, 'getSubCRCOptions']);       // Dynamic Dropdown

Route::get('/FinanceProject', [FinanceController::class, 'showFinanceForm']);
Route::get('/getSubEconomicCodes', [FinanceController::class, 'getSubEconomicCodes']);
Route::get('/getCategoryCodes', [FinanceController::class, 'getCategoryCodes']); 
Route::post('/FinanceProject', [FinanceController::class, 'addFinance'])->name('addFinance');

Route::get('/AdpCostProject', [AdpCostController::class, 'showAdpForm']);
Route::get('/getSubEconomicCodes', [AdpCostController::class, 'getSubEconomicCodes']);
Route::get('/getCategoryCodes', [AdpCostController::class, 'getCategoryCodes']); 

Route::get('/RadpCostProject', [RadpCostController::class, 'showRadpForm']);
Route::get('/getSubEconomicCodes', [RadpCostController::class, 'getSubEconomicCodes']);
Route::get('/getCategoryCodes', [RadpCostController::class, 'getCategoryCodes']); 

Route::get('/AddExpenditure', [ExpenditureController::class, 'showExpenditureForm']);

Route::get('/SubExpenditure', [SubExpenditureController::class, 'showSubExpenditureForm']);

Route::get('/dbconnection', function () {
    return view('dbconnection');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/ProjectInformation', function () {
    return view('pages.ProjectInformation');
});

Route::get('/ExpenditureInformation', function () {
    return view('pages.ExpenditureInformation');
});

Route::get('/DatabaseInformation', function () {
    return view('pages.DatabaseInformation');
});

