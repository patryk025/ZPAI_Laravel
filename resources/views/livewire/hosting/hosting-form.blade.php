<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="text-xl form-semibold leading-tight text-gray-800">
            @if ($editmode)
                {{ __('hosting.labels.edit_form_title')}}
            @else
                {{ __('hosting.labels.create_form_title')}}
            @endif
        </h3>
        <hr class="my-2" >
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="name">{{ __('hosting.attributes.name')}}</label>
            </div>
            <div class="">
                <x-input placeholder="Wpisz tekst" wire:model="hosting.name" />
            </div>
        </div>
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="name">{{ __('Nazwa użytkownika')}}</label>
            </div>
            <div class="">
                <x-select :async-data="route('async.users')" option-label="name" option-value="id" wire:model.defer="hosting.user_id" />
            </div>
        </div>
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="name">{{ __('Typ hostingu')}}</label>
            </div>
            <div class="">
                <x-select :options="$hostingTypes" option-key-value="true" wire:model="hosting.hosting_type_id" />
            </div>
        </div>
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="name">{{ __('hosting.attributes.active_from')}}</label>
            </div>
            <div class="">
                <x-datetime-picker placeholder="Wybierz datę" parse-format="YYYY-MM-DD HH:mm:ss" wire:model.defer="hosting.active_from"/>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="name">{{ __('hosting.attributes.active_to')}}</label>
            </div>
            <div class="">
                <x-datetime-picker placeholder="Wybierz datę" parse-format="YYYY-MM-DD HH:mm:ss" wire:model.defer="hosting.active_to"/>
            </div>
        </div>
        <div class="flex justify-end pt-2" style="padding-bottom: 100px;">
            <x-button href="{{ route('hosting.index') }}" secondary class="mr-2" label="Powrót"></x-button>
            <x-button type="submit" primary label="Zapisz" spinner></x-button>
        </div>
    </form>
</div>