<?php

namespace App\Http\Livewire\HostingTypes;

use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\HostingType;
use Illuminate\Support\Str;

class HostingTypeForm extends Component
{
    use Actions;
    public HostingType $hostingType;
    public Bool $editmode;

    public function rules() {
        return [
            'hostingType.name' => [
                'required',
                'string',
                'min:2',
                'unique:hosting_types,name' .
                    ($this->editmode ? (',' . $this->hostingType->id) : '')
            ]
        ];
    }

    public function validationAttributes() {
        return [
            'name' => Str::lower(__('hosting-types.attributes.name'))
        ];
    }

    public function mount(HostingType $hostingType, Bool $editmode) {
        $this->hostingType = $hostingType;
        $this->editmode = $editmode;
    }

    public function render() {
        return view("livewire.hosting-type.hosting-type-form");
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function save() {
        sleep(1);
        $this->validate();
        $this->hostingType->save();
        $this->notification()->success(
            $title = $this->editmode
                ? "Zaktualizowano typ hostingu"
                : "Dodano nowy typ hostingu",
            $description = $this->editmode
                ? "Udało się zaktualizować typ hostingu"
                : "Udało się stworzyć nowy typ hostingu"
        );
        $this->editMode = true;
    }
}
