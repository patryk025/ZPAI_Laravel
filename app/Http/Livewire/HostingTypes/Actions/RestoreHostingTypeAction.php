<?php

namespace App\Http\Livewire\HostingTypes\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;

class RestoreHostingTypeAction extends Action 
{
    public $title = '';
    public $icon = 'trash';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('Przywróć');
    }

    public function handle($model, View $view) 
    {
        $view->dialog()->confirm([
            'title' => __("Przywracanie typu hostingu"),
            'description' => __("Czy na pewno chcesz przywrócić typ hostingu :name", [
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