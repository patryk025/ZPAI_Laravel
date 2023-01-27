<?php

namespace App\Http\Livewire\Hosting\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;

class RestoreHostingAction extends Action 
{
    public $title = '';
    public $icon = 'toggle-left';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('Włącz');
    }

    public function handle($model, View $view) 
    {
        $view->dialog()->confirm([
            'title' => __("Włączanie hostingu"),
            'description' => __("Czy na pewno chcesz włączyć hosting :name", [
                'name' => $model->name
            ]),
            'icon' => 'question',
            'iconColor' => 'text-green-500',
            'accept' => [
                'label' => __("Tak"),
                'method' => 'restore',
                'params' => $model->id
            ],
            'reject' => [
                'label' => __("Nie")
            ]
        ]);
    }

    public function renderIf($model, View $view)
    {
        return $model->deleted_at !== null;
    }
}