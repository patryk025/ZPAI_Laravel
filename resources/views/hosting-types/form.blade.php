<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translations.menu.hosting-types') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if (isset($hostingType))
                    <livewire:hosting-types.hosting-type-form :hostingType="$hostingType" :editmode="true" />
                @else
                    <livewire:hosting-types.hosting-type-form :editmode="false" />
                @endif
            </div>
        </div>
    </div>
</x-app-layout>