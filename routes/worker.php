<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkerController;

/*
|--------------------------------------------------------------------------
| Worker Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => ['auth:worker', 'role:worker']], function() { 

    Route::get('contractor/profile', 'App\Http\Controllers\WorkerController@profile')->name('worker.myprofile');
    // nova ponuda
    Route::get('contractor/new', 'App\Http\Controllers\WorkerControllers\NewPonuda@create')->name('worker.new.ponuda');
    Route::post('contractor/new/store', 'App\Http\Controllers\WorkerControllers\NewPonuda@storePonuda')->name('worker.store.new.ponuda');
    Route::post('contractor/new/store/done', 'App\Http\Controllers\WorkerControllers\NewPonuda@ponudaDone')->name('worker.store.new.ponuda.done');
    Route::get('contractor/new/store/delete/{ponuda}', 'App\Http\Controllers\WorkerControllers\NewPonuda@deletePonuda')->name('worker.store.new.ponuda.delete');
    Route::post('contractor/new/store/updatedesc/', 'App\Http\Controllers\WorkerControllers\NewPonuda@updateDescription')->name('worker.store.new.update.desc');
    //nove kategorije
    Route::get('contractor/new/options', 'App\Http\Controllers\WorkerControllers\NewOptions@create')->name('worker.new.options');
    Route::get('contractor/new/category', 'App\Http\Controllers\WorkerControllers\NewOptions@CategoryCreate')->name('worker.create.new.category');
    Route::post('contractor/new/category/store', 'App\Http\Controllers\WorkerControllers\NewOptions@store_category')->name('worker.store.new.category');
    Route::get('contractor/new/subcategory', 'App\Http\Controllers\WorkerControllers\NewOptions@SubCategoryCreate')->name('worker.create.new.subcategory');
    Route::post('contractor/new/subcategory/store', 'App\Http\Controllers\WorkerControllers\NewOptions@store_subcategory')->name('worker.store.new.subcategory');
    Route::get('contractor/new/pozicija', 'App\Http\Controllers\WorkerControllers\NewOptions@pozicijaCreate')->name('worker.create.new.pozicija');
    Route::post('contractor/new/pozicija/store', 'App\Http\Controllers\WorkerControllers\NewOptions@store_pozicija')->name('worker.store.new.pozicija');
    //moje kategorije
    Route::get('contractor/myoptions/', 'App\Http\Controllers\WorkerControllers\OptionsController@create')->name('worker.options.update');
    Route::get('contractor/myoptions/show/category/{category}', 'App\Http\Controllers\WorkerControllers\OptionsController@showCategory')->name('worker.options.show.category');
    Route::get('contractor/myoptions/show/subcategory/{subcategory}', 'App\Http\Controllers\WorkerControllers\OptionsController@showSubcategory')->name('worker.options.show.subcategory');
    Route::get('contractor/myoptions/show/pozicija/{pozicija}', 'App\Http\Controllers\WorkerControllers\OptionsController@showPozicija')->name('worker.options.show.pozicija');
    Route::post('contractor/myoptions/show/category/update', 'App\Http\Controllers\WorkerControllers\OptionsController@updateCategory')->name('worker.options.update.category');
    Route::post('contractor/myoptions/show/subcategory/update', 'App\Http\Controllers\WorkerControllers\OptionsController@updateSubcategory')->name('worker.options.update.subcategory');
    Route::post('contractor/myoptions/show/pozicija/update', 'App\Http\Controllers\WorkerControllers\OptionsController@updatePozicija')->name('worker.options.update.pozicija');
    Route::get('contractor/myoptions/delete/category/{category}', 'App\Http\Controllers\WorkerControllers\OptionsController@deleteCategory')->name('worker.options.delete.category');
    Route::get('contractor/myoptions/delete/subcategory/{subcategory}', 'App\Http\Controllers\WorkerControllers\OptionsController@deleteSubcategory')->name('worker.options.delete.subcategory');
    Route::get('contractor/myoptions/delete/pozicija/{pozicija}', 'App\Http\Controllers\WorkerControllers\OptionsController@deletePozicija')->name('worker.options.delete.pozicija');
    //archive
    Route::get('contractor/archive', 'App\Http\Controllers\WorkerControllers\Archive@show')->name('worker.archive');
    Route::get('contractor/archive/{id}', 'App\Http\Controllers\WorkerControllers\Archive@selectedArchive')->name('worker.archive.selected');
    Route::get('contractor/archive/pdf/{id}', 'App\Http\Controllers\WorkerControllers\Archive@createPDF')->name('worker.archive.pdf');
    Route::get('contractor/archive/search/filter', 'App\Http\Controllers\WorkerControllers\Archive@search')->name('worker.archive.search');
    Route::get('contractor/archive/delete/{ponuda}', 'App\Http\Controllers\WorkerControllers\Archive@delete')->name('worker.archive.delete');
    Route::get('contractor/archive/element/delete/{ponuda}{ponuda_id}', 'App\Http\Controllers\WorkerControllers\Archive@deleteElement')->name('worker.archive.delete.element');
});



