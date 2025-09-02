<?php

namespace App\Livewire\Admin\Panel;


use App\Facades\BaleBot;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{

    #[Layout('admin.master')]
    public function render():View
    {
        return view('livewire.admin.panel.index');
    }
}
