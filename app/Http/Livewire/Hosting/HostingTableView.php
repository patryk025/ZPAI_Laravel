<?php

namespace App\Http\Livewire\Hosting;

use App\Models\Hosting;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Hosting\Actions\EditHostingAction;
use App\Http\Livewire\Hosting\Actions\HostingAVScanAction;
use App\Http\Livewire\Hosting\Actions\RestoreHostingAction;
use App\Http\Livewire\Hosting\Actions\SoftDeleteHostingAction;

class HostingTableView extends TableView
{
    use Actions;
    /**
     * Sets a model class to get the initial data
     */
    protected $model = Hosting::class;

    public $searchBy = [
        'name',
        'user.name',
        'hosting_type.name',
        'active_from',
        'active_to'
    ];

    public function repository(): Builder
    {
        return Hosting::query()->withTrashed();
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title(__('hosting.attributes.name'))->sortBy('name'),
            Header::title(__('Nazwa użytkownika')),
            Header::title(__('Typ hostingu')),
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
            $model->user->name,
            $model->hosting_type->name,
            $model->active_from,
            $model->active_to
        ];
    }

    protected function filters() {
        return [
            
        ];
    }

    protected function actionsByRow() {
        return [
            new EditHostingAction('hosting.edit', 'Edytuj'),
            new HostingAVScanAction(),
            new SoftDeleteHostingAction(),
            new RestoreHostingAction()
        ];
    }

    public function softDelete(int $id) {
        $hosting = Hosting::find($id);
        $hosting->delete();
        $this->notification()->success(
            $title = "Wyłączono",
            $description = __("Udało się wyłączyć hosting :name", [
                'name' => $hosting->name,
            ])
        );
    }

    public function restore(int $id)
    {
        $hosting = Hosting::withTrashed()->find($id);
        $hosting->restore();
        $this->notification()->success(
            $title = __("Włączono"),
            $description = __("Włączono hosting :name", [
                'name' => $hosting->name
            ])
        );
    }

    public function avScan(int $id)
    {
        $hosting = Hosting::withTrashed()->find($id);
        $this->notification()->info(
            $title = __("Rozpoczęto skanowanie antywirusowe"),
            $description = __("Uruchomiono skan na hostingu :name...", [
                'name' => $hosting->name
            ])
        );
        $this->notification()->success(
            $title = __("Ukończono"),
            $description = __("Nie znaleziono wirusów na hostingu :name", [
                'name' => $hosting->name
            ])
        );
    }
}
