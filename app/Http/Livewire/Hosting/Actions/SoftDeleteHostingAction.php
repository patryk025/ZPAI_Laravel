<?php

namespace App\Http\Livewire\Hosting\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class SoftDeleteHostingAction extends Action
{
    public $title = '';
    public $icon = 'toggle-right';
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Wyłącz';
    }

    public function handle($model, View $view)
    {
        $view->dialog()->confirm([
            'title' => 'Wyłączanie hostingu',
            'description' => 'Czy na pewno wyłączyć hosting: ' . $model->name,
            'icon' => 'question',
            'iconColor' => 'text-red-500',
            'accept' => [
                'label' => 'Tak',
                'method' => 'softDelete',
                'params' => $model->id
            ],
            'reject' => [
                'label' => 'Nie'
            ]
        ]);
    }

    public function  renderIf($model, View $view)
    {
        return $model->deleted_at === null;
    }
}
