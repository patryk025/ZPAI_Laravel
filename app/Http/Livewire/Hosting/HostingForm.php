<?php

namespace App\Http\Livewire\Hosting;

use App\Models\Hosting;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\HostingType;
use Illuminate\Support\Str;

class HostingForm extends Component
{
    use Actions;
    public Hosting $hosting;
    public Bool $editmode;
    public array $hostingTypes;

    public function rules() {
        return [
            'hosting.name' => [
                'required',
                'string',
                'min:2',
                'unique:hostings,name' .
                    ($this->editmode ? (',' . $this->hosting->id) : '')
            ],
            'hosting.user_id' => [
                'required',
                'integer'
            ],
            'hosting.hosting_type_id' => [
                'required',
                'integer'
            ],
            'hosting.active_from' => [
                'required',
                'string'
            ],
            'hosting.active_to' => [
                'required',
                'string'
            ]
        ];
    }

    public function validationAttributes() {
        return [
            'name' => Str::lower(__('hosting.attributes.name'))
        ];
    }

    public function mount(Hosting $hosting, Bool $editmode) {
        $this->hosting = $hosting;
        $this->editmode = $editmode;
        $this->hostingTypes = $this->getTypes();
    }

    public function render() {
        return view("livewire.hosting.hosting-form");
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function save() {
        sleep(1);
        $this->validate();
        $this->hosting->save();
        $this->notification()->success(
            $title = $this->editmode
                ? "Zaktualizowano hostingu"
                : "Dodano nowy hostingu",
            $description = $this->editmode
                ? "Udało się zaktualizować hostingu"
                : "Udało się stworzyć nowy hostingu"
        );
        $this->editmode = true;
    }

    private function getTypes(): array
    {
        $types = HostingType::select('id', 'name')->get();

        $typesOptions = [];

        foreach($types as ['id' => $id, 'name' => $name]) {
            $typesOptions[$id] = $name;
        }

        return $typesOptions;
    }
}

