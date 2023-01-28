<?php

namespace App\Http\Livewire\Ticket\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class SoftDeleteTicketAction extends Action
{
    public $title = '';
    public $icon = 'lock';
    public function __construct()
    {
        parent::__construct();
        $this->title = 'Zamknij';
    }

    public function handle($model, View $view)
    {
        //dd($view);
        $view->dialog()->confirm([
            'title' => 'Zamykanie zgłoszenia',
            'description' => 'Czy na pewno zamknąć zgłoszenie: ' . $model->name,
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
