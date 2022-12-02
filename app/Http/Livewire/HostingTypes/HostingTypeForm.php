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
            'hosting-type.name' => [
                'required',
                'string',
                'min:2',
                'unique:hosting-type,name' .
                    ($this->editmode ? (',' . $this->category->id) : '')
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
        return view("livewire.hosting-types.hosting-type-form");
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function save() {
        
    }
}
