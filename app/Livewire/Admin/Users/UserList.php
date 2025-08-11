<?php

namespace App\Livewire\Admin\Users;

use App\Facades\BaleBot;
use App\Models\BaleUser;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class UserList extends Component
{

    public function sendMessage($bale_id): void
    {
        BaleBot::sendMessage($bale_id,'متن ارسالی از پنل');
    }

    #[Layout('admin.master')]
    public function render():View
    {
        $users = BaleUser::query()->paginate(10);
        return view('livewire.admin.users.user-list', compact('users'));
    }
}
