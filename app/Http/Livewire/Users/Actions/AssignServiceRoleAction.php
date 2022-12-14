<?php

namespace App\Http\Livewire\Users\Actions;

use Illuminate\Support\Facades\Auth;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class AssignServiceRoleAction extends Action
{
    public $title = '';
    public $icon = 'droplet';
    public function __construct()
    {
        $this->title = 'Assign service role';
        parent::__construct();
    }

    public function handle($model, View $view)
    {
        $model->assignRole(config('auth.roles.service'));
        //$this->success('Udało się ustawić rolę!');
        $view->notification()->success(
            $title = "Udało się",
            $description = "Udało się nadać uprawnienia serwisanta"
        );
    }

    public function renderIf($model, View $view): bool
    {
        return Auth::user()->isAdmin()
            && !$model->hasRole(config('auth.roles.service'));
    }

}
