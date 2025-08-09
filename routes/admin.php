<?php

use App\Livewire\Admin\Panel\Index;
use Illuminate\Support\Facades\Route;


Route::get('/', Index::class)->name('panel.index');



