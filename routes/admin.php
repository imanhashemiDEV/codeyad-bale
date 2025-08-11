<?php

use App\Livewire\Admin\Panel\Index;
use App\Livewire\Admin\Users\UserList;
use Illuminate\Support\Facades\Route;


Route::get('/', Index::class)->name('panel.index');
Route::get('/users', UserList::class)->name('panel.users');



