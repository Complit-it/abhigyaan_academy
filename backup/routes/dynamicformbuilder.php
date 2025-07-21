
<?php

use App\Http\Controllers\DynamicFormBuilder;
use Illuminate\Support\Facades\Route;

Route::get('/dynamic-form-builder', [DynamicFormBuilder::class, 'index'])->name('dynamic-form-builder');
// store the form data in the database
Route::post('/dynamic-form-builder', [DynamicFormBuilder::class, 'store'])->name('dynamic-form-builder');

Route::get('/view-forms', [DynamicFormBuilder::class, 'viewforms'])->name('view-forms');

// view the form data
Route::get('/view-form/{id}', [DynamicFormBuilder::class, 'viewform'])->name('view-form');

// delete the form data from the database
Route::get('/delete-form/{id}', [DynamicFormBuilder::class, 'deleteform'])->name('delete-form');
// edit the form data
Route::get('/edit-form/{id}', [DynamicFormBuilder::class, 'editform'])->name('edit-form');

Route::get('/campaign/{slug}', [DynamicFormBuilder::class, 'getLandingage']);
Route::post('/update-sections', [DynamicFormBuilder::class, 'updateSections'])->name('update.sections');

Route::get('/landing-page', 'App\Http\Controllers\DynamicFormBuilder@landingPage')->name('landing-page');
Route::post('/landing-page', 'App\Http\Controllers\DynamicFormBuilder@landingPagePost')->name('landing-page');

// delete-landing-page-content/1
Route::get('/delete-landing-page-content/{id}', [DynamicFormBuilder::class, 'deleteLandingPageContent'])->name('delete-landing-page-content');

// edit-landing-page-content/1
Route::get('/edit-landing-page-content/{id}', [DynamicFormBuilder::class, 'editLandingPageContent'])->name('edit-landing-page-content');

// edit-landing-page-post
Route::post('/edit-landing-page-post', [DynamicFormBuilder::class, 'editLandingPagePost'])->name('edit-landing-page-post');