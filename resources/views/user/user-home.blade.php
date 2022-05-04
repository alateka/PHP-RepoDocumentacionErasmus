

    @livewire('navigation-menu')
    
    <x-app-layout>
        
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Panel de control') }}
            </h2>
        </x-slot>

        <x-slot name="slot">
            @livewire('user-panel')
        </x-slot>



    </x-app-layout>
