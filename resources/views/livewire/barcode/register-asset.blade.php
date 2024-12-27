

</div>


        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        @filamentStyles
        @vite('resources/css/app.css')

    <div class="antialiased">
        <div>
            <form wire:submit="save">
                {{ $this->form }}

                <button type="submit">
                    Submit
                </button>
            </form>

            <x-filament-actions::modals />
        </div>

        @filamentScripts
        @vite('resources/js/app.js')
    <div>
<div>

