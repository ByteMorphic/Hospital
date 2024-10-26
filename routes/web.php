<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\drugDeptController\WardController;
use App\Http\Controllers\drugDeptController\MedicineController;
use App\Http\Controllers\drugDeptController\ExpenseController;
use App\Http\Controllers\drugDeptController\GenericController;
use App\Http\Controllers\drugDeptController\ExpenseRecordController;
use App\Http\Controllers\ExecuteCommandController;

Route::get('/', function () {
    return view('landing');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



// Route::get('wards/create', [WardController::class, 'create'])->name('wards.create');
// Route::post('wards/create', [WardController::class, 'store'])->name('wards.store');
// Route::get('wards', [WardController::class, 'index'])->name('wards.index');
// Route::get('wards/{wId}/edit', [WardController::class, 'edit'])->name('wards.edit');
// Route::put('wards/{wId}', [WardController::class, 'update'])->name('wards.update');
// Route::delete('wards/{wId}', [WardController::class, 'destroy'])->name('wards.destroy');
// Route::get('wards/{wId}', [WardController::class, 'show'])->name('wards.show');
//
// should login as admin to access the following routes redirectwith message
Route::middleware('role:admin')->group(function () {
    Route::resource('wards', WardController::class);
    Route::get('medicines/total', [MedicineController::class, 'total'])->name('medicines.total');
    Route::post('/medicines/{medicine}/add-stock', [MedicineController::class, 'AddStock'])->name('medicines.addStock');
    // these route will remove in future (Because it not ralevent in future) - start
    Route::get('medicines/hmis', [MedicineController::class, 'totalAdd'])->name('medicines.totalAdd');
    Route::post('medicines/hmis', [MedicineController::class, 'totalAddStore'])->name('medicines.totalAddStore');
    // these route will remove in future (Because it not ralevent in future) - end
    Route::get('medicines/export-to-excel', [MedicineController::class, 'exportToExcel'])->name('medicines.export-to-excel');
    Route::resource('medicines', MedicineController::class);
    Route::resource('generics', GenericController::class);
    Route::resource('expenseRecord', ExpenseRecordController::class);
    Route::post('expense/export-to-excel', [ExpenseController::class, 'exportToExcel'])->name('expense.export-to-excel');
    Route::resource('expense', ExpenseController::class);
    Route::get('expenseRecord/create/{expense_id}', [ExpenseRecordController::class, 'create'])->name('expenseRecord.create');
    Route::put('expenseRecord/{id}', [ExpenseRecordController::class, 'update'])->name('expenseRecord.update');
    Route::delete('expenseRecord/{id}', [ExpenseRecordController::class, 'destroy'])->name('expenseRecord.destroy');
});

Route::middleware('role:user')->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
});


Route::get('/execute-command', [ExecuteCommandController::class, 'executeCommand']);

Route::get('/test', function () {
    return view('test');
});
