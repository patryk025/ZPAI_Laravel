<?php

namespace App\Http\Livewire\Hosting;

use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\Hosting;
use Illuminate\Support\Str;

class HostingForm extends Component
{
    use Actions;
    public Hosting $hosting;
    public Bool $editmode;

    public function rules() {
        return [
            'hosting.name' => [
                'required',
                'string',
                'min:2',
                'unique:hosting,name' .
                    ($this->editmode ? (',' . $this->hosting->id) : '')
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
                ? "Zaktualizowano typ hostingu"
                : "Dodano nowy typ hostingu",
            $description = $this->editmode
                ? "Udało się zaktualizować typ hostingu"
                : "Udało się stworzyć nowy typ hostingu"
        );
        $this->editmode = true;
    }
}

