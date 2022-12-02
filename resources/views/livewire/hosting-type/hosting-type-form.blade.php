<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="text-xl form-semibold leading-tight text-gray-800">
            @if ($editmode)
                {{ __('hosting-type.labels.edit_form_title')}}
            @else
                {{ __('hosting-type.labels.create_form_title')}}
            @endif
        </h3>
        <hr class="my-2" >
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="name">{{ __('hosting-type.attributes.name')}}</label>
            </div>
            <div class="">
                <x-input placeholder="Wpisz tekst" wire:model="hosting-type.name" />
            </div>
            <div class="flex justify-end pt-2">
                <x-button href="{{ route('hosting-types.index') }}" secondary class="mr-2" label="Powrót"></x-button>
                <x-button type="submit" primary label="Zapisz" spinner></x-button>
            </div>
        </div>
    </form>
</div>