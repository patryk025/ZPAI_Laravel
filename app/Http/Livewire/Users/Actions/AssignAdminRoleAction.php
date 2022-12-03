<?php

namespace App\Http\Livewire\Users\Actions;

use Illuminate\Support\Facades\Auth;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class AssignAdminRoleAction extends Action
{
    public $title = '';
    public $icon = 'shield';
    public function __construct()
    {
        $this->title = 'Assign admin role';
        parent::__construct();
    }

    public function handle($model, View $view)
    {
        $model->assignRole(config('auth.roles.admin'));
        //$this->success('Udało się ustawić rolę!');
        $view->notification()->success(
            $title = "Udało się",
            $description = "Udało się nadać uprawnienia admina"
        );
    }

    public function renderIf($model, View $view): bool
    {
        return Auth::user()->isAdmin()
            && !$model->hasRole(config('auth.roles.admin'));
    }
}
