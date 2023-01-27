<?php

namespace App\Http\Livewire\Hosting\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;

class HostingAVScanAction extends Action 
{
    public $title = '';
    public $icon = 'tool';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('Antywirus');
    }

    public function handle($model, View $view) 
    {
        $view->dialog()->confirm([
            'title' => __("Czy uruchomić skan antywirusowy?"),
            'description' => __("Czy na pewno chcesz uruchomić skan antywirusowy na hostingu :name", [
                'name' => $model->name
            ]),
            'icon' => 'question',
            'iconColor' => 'text-green-500',
            'accept' => [
                'label' => __("Tak"),
                'method' => 'avScan',
                'params' => $model->id
            ],
            'reject' => [
                'label' => __("Nie")
            ]
        ]);
    }

    public function renderIf($model, View $view)
    {
        return $model->deleted_at === null;
    }
}
