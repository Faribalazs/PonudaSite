<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\WorkerControllers\NewPonuda;
use App\Http\Controllers\WorkerControllers\NewOptions;
use App\Http\Controllers\WorkerControllers\OptionsController;
use App\Http\Controllers\WorkerControllers\Archive;

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
    Route::get('contractor/profile', [WorkerController::class, 'profile'])
        ->name('worker.myprofile');

    Route::get('contractor/profile/company', [WorkerController::class, 'personalData'])
        ->name('worker.personal.data');

    Route::post('contractor/profile/company/save', [WorkerController::class, 'savePersonalData'])
        ->name('worker.personal.data.save');

    Route::get('contractor/profile/contacts', [WorkerController::class, 'myContacts'])
        ->name('worker.personal.contacts');

    Route::post('contractor/profile/contacts/save', [WorkerController::class, 'saveContact'])
        ->name('worker.personal.contacts.save');

    Route::get('contractor/profile/contacts/update/{id}', [WorkerController::class, 'updateContact'])
        ->name('worker.personal.contacts.update');

    Route::delete('contractor/profile/contacts/delete/{id}', [WorkerController::class, 'deleteContact'])
        ->name('worker.personal.contacts.delete');

    Route::get('contractor/profile/add/individual', [WorkerController::class, 'addFizickoIndex'])
        ->name('worker.personal.contacts.add.individual');

    Route::post('contractor/profile/add/individual/save', [WorkerController::class, 'saveFizickoLice'])
        ->name('worker.personal.contacts.add.individual.save');

    Route::get('contractor/profile/add/legal-entity', [WorkerController::class, 'addPravnoIndex'])
        ->name('worker.personal.contacts.add.legal-entity');

    Route::post('contractor/profile/add/legal-entity/save', [WorkerController::class, 'savePravnoLice'])
        ->name('worker.personal.contacts.add.legal-entity.save');

    Route::delete('contractor/profile/company/delete', [WorkerController::class, 'companyDelete'])
        ->name('worker.personal.company.delete');


    // nova ponuda
    Route::get('contractor/new', [NewPonuda::class, 'create'])
        ->name('worker.new.ponuda');

    Route::post('contractor/new/store', [NewPonuda::class, 'storePonuda'])
        ->name('worker.store.new.ponuda');

    Route::post('contractor/new/store/done', [NewPonuda::class, 'ponudaDone'])
        ->name('worker.store.new.ponuda.done');

    Route::delete('contractor/new/store/delete', [NewPonuda::class, 'deletePonuda'])
        ->name('worker.store.new.ponuda.delete');

    Route::put('contractor/new/store/updatedesc/', [NewPonuda::class, 'updateDescription'])
        ->name('worker.store.new.update.desc');


    //nove kategorije
    Route::get('contractor/new/options', [NewOptions::class, 'create'])
        ->name('worker.new.options');
    
    Route::get('contractor/new/category', [NewOptions::class, 'CategoryCreate'])
        ->name('worker.create.new.category');

    Route::post('contractor/new/category/store', [NewOptions::class, 'store_category'])
        ->name('worker.store.new.category');

    Route::get('contractor/new/subcategory', [NewOptions::class, 'SubCategoryCreate'])
        ->name('worker.create.new.subcategory');

    Route::post('contractor/new/subcategory/store', [NewOptions::class, 'store_subcategory'])
        ->name('worker.store.new.subcategory');

    Route::get('contractor/new/pozicija', [NewOptions::class, 'pozicijaCreate'])
        ->name('worker.create.new.pozicija');

    Route::post('contractor/new/pozicija/store', [NewOptions::class, 'store_pozicija'])
        ->name('worker.store.new.pozicija');


    //moje kategorije
    Route::get('contractor/myoptions/', [OptionsController::class, 'create'])
        ->name('worker.options.update');

    Route::get('contractor/myoptions/show/category/{category}', [OptionsController::class, 'showCategory'])
        ->name('worker.options.show.category');

    Route::get('contractor/myoptions/show/subcategory/{subcategory}', [OptionsController::class, 'showSubcategory'])
        ->name('worker.options.show.subcategory');

    Route::get('contractor/myoptions/show/pozicija/{pozicija}', [OptionsController::class, 'showPozicija'])
        ->name('worker.options.show.pozicija');

    Route::put('contractor/myoptions/show/category/update', [OptionsController::class, 'updateCategory'])
        ->name('worker.options.update.category');

    Route::put('contractor/myoptions/show/subcategory/update', [OptionsController::class, 'updateSubcategory'])
        ->name('worker.options.update.subcategory');

    Route::put('contractor/myoptions/show/pozicija/update', [OptionsController::class, 'updatePozicija'])
        ->name('worker.options.update.pozicija');
    
    Route::put('contractor/myoptions/delete/category', [OptionsController::class, 'deleteCategory'])
        ->name('worker.options.delete.category');

    Route::put('contractor/myoptions/delete/subcategory', [OptionsController::class, 'deleteSubcategory'])
        ->name('worker.options.delete.subcategory');

    Route::put('contractor/myoptions/delete/pozicija', [OptionsController::class, 'deletePozicija'])
        ->name('worker.options.delete.pozicija');


    //archive
    Route::middleware(['checkSwapRecord'])->group(function () {
        Route::get('contractor/archive', [Archive::class, 'show'])
            ->name('worker.archive');

        Route::get('contractor/archive/success', [Archive::class, 'generatePdfSuccess'])
            ->name('worker.archive.success');

        Route::post('contractor/archive/submit/contact/fizicka', [Archive::class, 'submitContact'])
            ->name('worker.archive.submit.contact');

        Route::post('contractor/archive/submit/contact/pravna', [Archive::class, 'submitContactPravna'])
            ->name('worker.archive.submit.contact.pravna');

        Route::middleware(['restrictUserAccess'])->group(function () {
            Route::get('contractor/archive/{id}', [Archive::class, 'selectedArchive'])
                ->name('worker.archive.selected');
            
            Route::get('contractor/pdf/{id}', [Archive::class, 'createPDF'])
                ->name('worker.archive.pdf');

            Route::get('contractor/view/pdf/{id}', [Archive::class, 'viewPDF'])
                ->name('worker.archive.view.pdf');

            Route::get('contractor/createmail/{id}', [Archive::class, 'createMAIL'])
                ->name('worker.archive.create.mail');

            Route::post('contractor/mail/pdf/{id}', [Archive::class, 'sendPDF'])
                ->name('worker.archive.send.mail');

            Route::get('contractor/archive/select/contact/{id}', [Archive::class, 'selectContact'])
                ->name('worker.archive.select.contact');

            Route::get('contractor/fizickalica/{id}', [Archive::class, 'showFizicka'])
                ->name('worker.archive.fizicka_lica');

            Route::get('contractor/pravnalica/{id}', [Archive::class, 'showPravna'])
                ->name('worker.archive.pravna_lica');
        });

        Route::get('contractor/archive/search/filter', [Archive::class, 'search'])
            ->name('worker.archive.search');

        Route::get('contractor/archive/search/napomena', [Archive::class, 'searchNapomena'])
            ->name('worker.archive.search.napomena');

        Route::delete('contractor/archive/delete', [Archive::class, 'delete'])
            ->name('worker.archive.delete');

        Route::delete('contractor/archive/element/delete', [Archive::class, 'deleteElement'])
            ->name('worker.archive.delete.element');

        Route::get('contractor/archive/edit/{ponuda_id}', [Archive::class, 'editPonuda'])
            ->name('worker.archive.edit');

        Route::get('contractor/archive/select/template', [Archive::class, 'selectTamplate'])
            ->name('worker.archive.template.select');
        
        Route::post('contractor/archive/generate/pdf', [Archive::class, 'tamplateGeneratePdf'])
            ->name('worker.archive.genarte.tamplate.pdf');
    });
});



