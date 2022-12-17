<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="text-xl form-semibold leading-tight text-gray-800">
            @if ($editmode)
                {{ __('Edytuj ticket')}}
            @else
                {{ __('Utwórz nowy ticket')}}
            @endif
        </h3>
        <hr class="my-2" >
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="name">{{ __('Tytuł zgłoszenia')}}</label>
            </div>
            <div class="">
                <x-input placeholder="Tytuł zgłoszenia" wire:model="ticket.title" />
            </div>
        </div>
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="name">{{ __('Opis zgłoszenia')}}</label>
            </div>
            <div class="">
                <x-input placeholder="Opis zgłoszenia" wire:model="ticket.description" />
            </div>
            <div class="flex justify-end pt-2">
                <x-button href="{{ route('ticket.index') }}" secondary class="mr-2" label="Powrót"></x-button>
                <x-button type="submit" primary label="Zapisz" spinner></x-button>
            </div>
        </div>
    </form>
</div>