<?php

namespace App\Livewire\Barcode;

use Filament\Forms;
use App\Models\Asset;
use Livewire\Component;
use App\Models\Employee;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class BarcodeForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
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
            ->model(Asset::class);
    }

    public function create(): void
    {
        dd($this->form->getState());
    }

    public function render()
    {
        return view('livewire.barcode.barcode-form');
    }
}
