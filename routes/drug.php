<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\drugDeptController\ExpenseController;
use App\Http\Controllers\drugDeptController\GenericController;
use App\Http\Controllers\drugDeptController\ExpenseRecordController;
use App\Http\Controllers\drugDeptController\MedicineController;



Route::get('/', function () {
    return "Soon Available";
});

Route::middleware('role:admin')->group(function () {
    Route::resource('medicines', MedicineController::class);
    Route::resource('generics', GenericController::class);
    Route::resource('expenseRecord', expenseRecordController::class);
    Route::resource('expense', ExpenseController::class);
    Route::get('expenseRecord/create/{expense_id}', [ExpenseRecordController::class, 'create'])->name('expenseRecord.create');
});