@extends('layout')

@section('content')
<div class="grid grid-cols-8 gap-2">
    <div class=" col-span-6 lg:col-span-4 ">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <form wire:submit="create">
                    {{ $this->form }}

                    <button type="submit">
                        Submit
                    </button>
                </form>

                <x-filament-actions::modals />
            </div>
    </div>
</div>
@endsection


