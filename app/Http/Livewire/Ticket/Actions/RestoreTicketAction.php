<?php

namespace App\Http\Livewire\Ticket\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;

class RestoreTicketAction extends Action 
{
    public $title = '';
    public $icon = 'unlock';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('Otwórz');
    }

    public function handle($model, View $view) 
    {
        $view->dialog()->confirm([
            'title' => __("Ponowne otwarcie zgłoszenia"),
            'description' => __("Czy na pewno chcesz ponownie otworzyć zgłoszenie :name", [
                'name' => $model->title
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