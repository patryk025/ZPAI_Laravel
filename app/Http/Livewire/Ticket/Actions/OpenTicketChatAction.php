<?php

namespace App\Http\Livewire\Ticket\Actions;

use LaravelViews\Actions\RedirectAction;
use LaravelViews\Views\View;

class OpenTicketChatAction extends RedirectAction
{
    public function __construct(string $to, string $title, string $icon = 'message-circle')
    {
        parent::__construct($to, $title, $icon);
    }

    public function renderIf($model, View $view)
    {
        return true;
    }
}