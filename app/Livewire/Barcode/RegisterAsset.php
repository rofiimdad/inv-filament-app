<?php

namespace App\Livewire\Barcode;

use App\Models\Asset;
use Filament\Forms;
use Livewire\Component;
use App\Models\Employee;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class RegisterAsset extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Asset $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('asset_number')
                    ->required()
                    ->maxLength(255)
                    ->extraInputAttributes(['readonly' => true]),
                Forms\Components\TextInput::make('brand_name')
                    ->required()
                    ->maxLength(12),
                Forms\Components\TextInput::make('model_number')
                    ->required()
                    ->maxLength(64),
                Forms\Components\TextInput::make('date_manufacture')
                    ->required()
                    ->numeric()
                    ->minValue(2000)
                    ->maxValue(3000)
                    ->maxLength(4),
                Forms\Components\TextInput::make('asset_type')
                    ->required()
                    ->extraInputAttributes(['readonly' => true]),
                Forms\Components\Select::make('employee_id')
                    ->label('PIC Assets')
                    ->options(Employee::all()->pluck('name', 'id'))
                    ->searchable()
                    ->relationship(name: 'employee', titleAttribute: 'employee_id')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('vendor_name')
                            ->required(),
                        Forms\Components\TextInput::make('address')
                            ->required()
                    ]),
                Forms\Components\TextInput::make('discription')
                    ->maxLength(64),
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);
    }

    public function render(): View
    {
        return view('livewire.barcode.register-asset');
    }
}
