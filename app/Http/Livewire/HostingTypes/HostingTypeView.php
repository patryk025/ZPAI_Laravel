<?php

namespace App\Http\Livewire\HostingTypes;

use WireUi\Traits\Actions;
use App\Models\HostingType;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Http\Livewire\HostingTypes\Filters\SoftDeleteFilter;
use App\Http\Livewire\HostingTypes\Actions\EditHostingTypeAction;
use App\Http\Livewire\HostingTypes\Actions\RestoreHostingTypeAction;
use App\Http\Livewire\HostingTypes\Actions\SoftDeleteStatusAction;

class HostingTypeView extends TableView
{
    use Actions;
    /**
     * Sets a model class to get the initial data
     */
    protected $model = HostingType::class;

    public $searchBy = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function repository(): Builder
    {
        return HostingType::query()->withTrashed();
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title(__('hosting-types.attributes.name'))->sortBy('name'),
            Header::title(__('hosting-types.attributes.created_at'))->sortBy('created_at'),
            Header::title(__('hosting-types.attributes.updated_at'))->sortBy('updated_at'),
            Header::title(__('hosting-types.attributes.deleted_at'))->sortBy('deleted_at'),
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
            $model->created_at,
            $model->updated_at,
            $model->deleted_at
        ];
    }

    protected function filters() {
        return [
            new SoftDeleteFilter
        ];
    }

    protected function actionsByRow() {
        return [
            new EditHostingTypeAction('hosting-types.edit', 'Edytuj'),
            new SoftDeleteStatusAction(),
            new RestoreHostingTypeAction()
        ];
    }

    public function softDelete(int $id) {
        $hostingType = HostingType::find($id);
        $hostingType->delete();
        $this->notification()->success(
            $title = "Usunięto",
            $description = __("Udało się skasować typ hostingu :name", [
                'name' => $hostingType->name,
            ])
        );
    }

    public function restore(int $id)
    {
        $hostingType = HostingType::withTrashed()->find($id);
        $hostingType->restore();
        $this->notification()->success(
            $title = __("Powodzenie"),
            $description = __("Przywrócono typ hostingu :name", [
                'name' => $hostingType->name
            ])
        );
    }
}
