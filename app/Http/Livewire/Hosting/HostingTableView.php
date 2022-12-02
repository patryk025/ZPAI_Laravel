<?php

namespace App\Http\Livewire\Hosting;

use App\Models\Hosting;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class HostingTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected $model = Hosting::class;

    public $searchBy = [
        'name',
        'active_from',
        'active_to'
    ];

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title(__('hosting.attributes.name'))->sortBy('name'),
            Header::title(__('hosting.attributes.active_from'))->sortBy('active_from'),
            Header::title(__('hosting.attributes.active_to'))->sortBy('active_to'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->name,
            $model->active_from,
            $model->active_to
        ];
    }
}
