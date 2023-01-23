<?php

namespace App\Http\Livewire\Ticket\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;

class RestoreTicketAction extends Action 
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
            'title' => __("Przywracanie zgłoszenia"),
            'description' => __("Czy na pewno chcesz przywrócić zgłoszenie :name", [
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