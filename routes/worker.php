<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkerController;

/*
|--------------------------------------------------------------------------
| Worker Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => ['auth:worker', 'role:worker|super_worker']], function() { 

    Route::get('storage/{filename}', function ($filename)
    {
        return Image::make(storage_path('app/logo/' . $filename))->response();
    })->name('show.img');

    //profile routes
    Route::get('contractor/profile', 'App\Http\Controllers\WorkerController@profile')
        ->name('worker.myprofile');

    Route::get('contractor/profile/company', 'App\Http\Controllers\WorkerController@personalData')
        ->name('worker.personal.data');

    Route::post('contractor/profile/company/save', 'App\Http\Controllers\WorkerController@savePersonalData')
        ->name('worker.personal.data.save');

    Route::get('contractor/profile/contacts', 'App\Http\Controllers\WorkerController@myContacts')
        ->name('worker.personal.contacts');

    Route::post('contractor/profile/contacts/save', 'App\Http\Controllers\WorkerController@saveContact')
        ->name('worker.personal.contacts.save');

    Route::get('contractor/profile/contacts/update/{id}', 'App\Http\Controllers\WorkerController@updateContact')
        ->name('worker.personal.contacts.update');

    Route::get('contractor/profile/contacts/delete/{id}', 'App\Http\Controllers\WorkerController@deleteContact')
        ->name('worker.personal.contacts.delete');

    Route::get('contractor/profile/add/individual', 'App\Http\Controllers\WorkerController@addFizickoIndex')
        ->name('worker.personal.contacts.add.individual');

    Route::post('contractor/profile/add/individual/save', 'App\Http\Controllers\WorkerController@saveFizickoLice')
        ->name('worker.personal.contacts.add.individual.save');

    Route::get('contractor/profile/add/legal-entity', 'App\Http\Controllers\WorkerController@addPravnoIndex')
        ->name('worker.personal.contacts.add.legal-entity');

    Route::post('contractor/profile/add/legal-entity/save', 'App\Http\Controllers\WorkerController@savePravnoLice')
        ->name('worker.personal.contacts.add.legal-entity.save');

    Route::delete('contractor/profile/company/delete', 'App\Http\Controllers\WorkerController@companyDelete')
        ->name('worker.personal.company.delete');


    // nova ponuda
    Route::get('contractor/new', 'App\Http\Controllers\WorkerControllers\NewPonuda@create')
        ->name('worker.new.ponuda');

    Route::post('contractor/new/store', 'App\Http\Controllers\WorkerControllers\NewPonuda@storePonuda')
        ->name('worker.store.new.ponuda');

    Route::post('contractor/new/store/done', 'App\Http\Controllers\WorkerControllers\NewPonuda@ponudaDone')
        ->name('worker.store.new.ponuda.done');

    Route::get('contractor/new/store/delete/{ponuda}', 'App\Http\Controllers\WorkerControllers\NewPonuda@deletePonuda')
        ->name('worker.store.new.ponuda.delete');

    Route::post('contractor/new/store/updatedesc/', 'App\Http\Controllers\WorkerControllers\NewPonuda@updateDescription')
        ->name('worker.store.new.update.desc');


    //nove kategorije
    Route::get('contractor/new/options', 'App\Http\Controllers\WorkerControllers\NewOptions@create')
        ->name('worker.new.options');
    
    Route::get('contractor/new/category', 'App\Http\Controllers\WorkerControllers\NewOptions@CategoryCreate')
        ->name('worker.create.new.category');

    Route::post('contractor/new/category/store', 'App\Http\Controllers\WorkerControllers\NewOptions@store_category')
        ->name('worker.store.new.category');

    Route::get('contractor/new/subcategory', 'App\Http\Controllers\WorkerControllers\NewOptions@SubCategoryCreate')
        ->name('worker.create.new.subcategory');

    Route::post('contractor/new/subcategory/store', 'App\Http\Controllers\WorkerControllers\NewOptions@store_subcategory')
        ->name('worker.store.new.subcategory');

    Route::get('contractor/new/pozicija', 'App\Http\Controllers\WorkerControllers\NewOptions@pozicijaCreate')
        ->name('worker.create.new.pozicija');

    Route::post('contractor/new/pozicija/store', 'App\Http\Controllers\WorkerControllers\NewOptions@store_pozicija')
        ->name('worker.store.new.pozicija');


    //moje kategorije
    Route::get('contractor/myoptions/', 'App\Http\Controllers\WorkerControllers\OptionsController@create')
        ->name('worker.options.update');

    Route::get('contractor/myoptions/show/category/{category}', 'App\Http\Controllers\WorkerControllers\OptionsController@showCategory')
        ->name('worker.options.show.category');

    Route::get('contractor/myoptions/show/subcategory/{subcategory}', 'App\Http\Controllers\WorkerControllers\OptionsController@showSubcategory')
        ->name('worker.options.show.subcategory');

    Route::get('contractor/myoptions/show/pozicija/{pozicija}', 'App\Http\Controllers\WorkerControllers\OptionsController@showPozicija')
        ->name('worker.options.show.pozicija');

    Route::post('contractor/myoptions/show/category/update', 'App\Http\Controllers\WorkerControllers\OptionsController@updateCategory')
        ->name('worker.options.update.category');

    Route::post('contractor/myoptions/show/subcategory/update', 'App\Http\Controllers\WorkerControllers\OptionsController@updateSubcategory')
        ->name('worker.options.update.subcategory');

    Route::post('contractor/myoptions/show/pozicija/update', 'App\Http\Controllers\WorkerControllers\OptionsController@updatePozicija')
        ->name('worker.options.update.pozicija');
    
    Route::get('contractor/myoptions/delete/category/{category}', 'App\Http\Controllers\WorkerControllers\OptionsController@deleteCategory')
        ->name('worker.options.delete.category');

    Route::get('contractor/myoptions/delete/subcategory/{subcategory}', 'App\Http\Controllers\WorkerControllers\OptionsController@deleteSubcategory')
        ->name('worker.options.delete.subcategory');

    Route::get('contractor/myoptions/delete/pozicija/{pozicija}', 'App\Http\Controllers\WorkerControllers\OptionsController@deletePozicija')
        ->name('worker.options.delete.pozicija');


    //archive
    Route::get('contractor/archive', 'App\Http\Controllers\WorkerControllers\Archive@show')
        ->name('worker.archive');

    Route::get('contractor/archive/select/contact/{id}', 'App\Http\Controllers\WorkerControllers\Archive@selectContact')
        ->name('worker.archive.select.contact');

    Route::get('contractor/archive/success', 'App\Http\Controllers\WorkerControllers\Archive@generatePdfSuccess')
        ->name('worker.archive.success');

    Route::post('contractor/archive/submit/contact/fizicka', 'App\Http\Controllers\WorkerControllers\Archive@submitContact')
        ->name('worker.archive.submit.contact');

    Route::post('contractor/archive/submit/contact/pravna', 'App\Http\Controllers\WorkerControllers\Archive@submitContactPravna')
        ->name('worker.archive.submit.contact.pravna');

    Route::get('contractor/archive/{id}', 'App\Http\Controllers\WorkerControllers\Archive@selectedArchive')
        ->name('worker.archive.selected')->middleware('restrictUserAccess');
    
    Route::get('contractor/pdf/{id}', 'App\Http\Controllers\WorkerControllers\Archive@createPDF')
        ->name('worker.archive.pdf')->middleware('restrictUserAccess');

    Route::get('contractor/view/pdf/{id}', 'App\Http\Controllers\WorkerControllers\Archive@viewPDF')
        ->name('worker.archive.view.pdf')->middleware('restrictUserAccess');

    Route::get('contractor/createmail/{id}', 'App\Http\Controllers\WorkerControllers\Archive@createMAIL')
        ->name('worker.archive.create.mail')->middleware('restrictUserAccess');

    Route::post('contractor/mail/pdf/{id}', 'App\Http\Controllers\WorkerControllers\Archive@sendPDF')
        ->name('worker.archive.send.mail')->middleware('restrictUserAccess');

    Route::get('contractor/archive/search/filter', 'App\Http\Controllers\WorkerControllers\Archive@search')
        ->name('worker.archive.search');

    Route::get('contractor/archive/search/napomena', 'App\Http\Controllers\WorkerControllers\Archive@searchNapomena')
        ->name('worker.archive.search.napomena');

    Route::get('contractor/archive/delete/{ponuda}', 'App\Http\Controllers\WorkerControllers\Archive@delete')
        ->name('worker.archive.delete');

    Route::get('contractor/archive/element/delete/{ponuda}/{ponuda_id}', 'App\Http\Controllers\WorkerControllers\Archive@deleteElement')
        ->name('worker.archive.delete.element');

    Route::get('contractor/archive/edit/{ponuda_id}', 'App\Http\Controllers\WorkerControllers\Archive@editPonuda')
        ->name('worker.archive.edit');

    Route::get('contractor/archive/select/template', 'App\Http\Controllers\WorkerControllers\Archive@selectTamplate')
        ->name('worker.archive.template.select');
    
    Route::post('contractor/archive/generate/pdf', 'App\Http\Controllers\WorkerControllers\Archive@tamplateGeneratePdf')
        ->name('worker.archive.genarte.tamplate.pdf');

    Route::get('contractor/fizickalica/{ponuda_id}', 'App\Http\Controllers\WorkerControllers\Archive@showFizicka')
        ->name('worker.archive.fizicka_lica');

    Route::get('contractor/pravnalica/{ponuda_id}', 'App\Http\Controllers\WorkerControllers\Archive@showPravna')
        ->name('worker.archive.pravna_lica');
});



