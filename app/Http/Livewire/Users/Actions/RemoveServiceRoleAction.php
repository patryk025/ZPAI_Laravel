<?php

namespace App\Http\Livewire\Users\Actions;

use Illuminate\Support\Facades\Auth;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class RemoveServiceRoleAction extends Action
{
    public $title = '';
    public $icon = 'droplet';
    public function __construct()
    {
        $this->title = 'Remove service role';
        parent::__construct();
    }

    public function handle($model, View $view)
    {
        $model->removeRole(config('auth.roles.service'));
        $this->success('Udało się usunac rolę!');
    }

    public function renderIf($model, View $view): bool
    {
        return Auth::user()->isAdmin()
            && $model->hasRole(config('auth.roles.service'));
    }

}
