<?php



use Illuminate\Support\Facades\Route;

Route::get('/test1', function () {
    return view('test');
})->name('test1');

// Route::get('/test', function () {
//     return view('filament.pages.assign-page');
// });

    Route::get('/bulk-print', App\Livewire\Barcode\LabelPrintout::class)->name('bulk-print');
    Route::get('/test/{record}',App\Livewire\Barcode\RegisterAsset::class);
    // Route::get('/test',App\Livewire\AssignationForm::class);
    Route::get('/scan/{record}',App\Livewire\Barcode\BarcodeDetails::class);
