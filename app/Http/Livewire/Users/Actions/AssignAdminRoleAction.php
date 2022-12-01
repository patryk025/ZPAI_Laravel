<?php

namespace App\Http\Livewire\Users\Actions;

use Illuminate\View\View;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Auth;

class AssignAdminRoleAction extends Action
{
    public $title = '';
    public $icon = 'shield';

    public function __construct()
    {
        $this->title = __('users.action.assign_admin_role');
    }

    public function handle($model, View $view) {
        $model->assignRole(config('auth.roles.admin'));
        $this->success(__('users.messages.successes.admin_role_assigned'));
    }

    public function renderIf($model, View $view) {
        return Auth::user()->isAdmin()
            && !$model->hasRole(config('auth.roles.admin'));
    }
}
