<?php

use App\Http\Controllers\InvoiceController;
use App\Models\SubjecInfo;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

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


/*
|--------------------------------------------------------------------------
| Common Resource Routes:
|--------------------------------------------------------------------------
|
| index - Show all invoices
| show - Show single invoice
| create - Show form to create new invoice
| store - Store new invoice
| edit - Show form to edit invoice
| update - Update invoice
| destroy - Delete invoice  
|
*/

Route::get('/', function(){
    return redirect()->route('invoice.index');
});


Route::get('subjectinfo', function(Request $request){
    
    $ico = $request->get('ico');

    return json_encode(SubjecInfo::getCompanyInfo($ico));
});

Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice.index');

Route::get('/invoices/create',  [InvoiceController::class,  'create'])->name('invoice.create');

Route::post('/invoices/store',  [InvoiceController::class,  'store'])->name('invoice.store');

Route::get('/invoices/{id}/show', [InvoiceController::class, 'show'] )->name('invoice.show');

Route::get('/invoices/{id}/edit', [InvoiceController::class, 'edit'] )->name('invoice.edit');

Route::put('/invoices/{id}/update', [InvoiceController::class, 'update'] )->name('invoice.update');

Route::delete('/invoices/{id}/destroy', [InvoiceController::class, 'destroy'] )->name('invoice.destroy');
