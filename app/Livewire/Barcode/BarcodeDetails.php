<?php

namespace App\Livewire\Barcode;

use Filament\Tables;
use App\Models\Barcode;
use App\Models\Employee;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;

class BarcodeDetails extends Component implements HasForms
{
    use InteractsWithForms;

    public $recordData;
    public $data;

    // public function table(Table $table): Table
    // {
    //     return $table
    //         ->query(Barcode::query())
    //         ->columns([
    //             Tables\Columns\TextColumn::make('barcode_number')
    //             ->label('Barcode')
    //             ->formatStateUsing(function ($state) {
    //                 $barcode = new \Milon\Barcode\DNS2D;
    //                 $show = $barcode->getBarcodeHTML($state, 'QRCODE');
    //                 return "<div style='background-color:white width: 100px; height: 250px; overflow: hidden;'>$show</div>";
    //             })
    //             ->html()
    //             ->columnSpanFull(),
    //             Tables\Columns\TextColumn::make('assets.asset_number'),
    //             Tables\Columns\TextColumn::make('status'),
    //             Tables\Columns\TextColumn::make('asset_id')
    //                 ->numeric()
    //                 ->sortable(),
    //         ])
    //         ->filters([
    //             //
    //         ])
    //         ->actions([
    //             //
    //         ])
    //         ->bulkActions([
    //             Tables\Actions\BulkActionGroup::make([
    //                 //
    //             ]),
    //         ]);
    // }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public function mount($record)
    {
        $this->recordData = Barcode::where('barcode_number',$record)->firstOrFail();
        if ($this->recordData->assets->employee_id) {
         return $this->data = [
                'barcode_number'    => $this->recordData->barcode_number,
                'asset_number'      => $this->recordData->assets->asset_number,
                'brand_name'        => $this->recordData->assets->brand_name,
                'model_number'      => $this->recordData->assets->model_number,
                'asset_type'        => $this->recordData->assets->asset_type,
                'pic'               => Employee::find($this->recordData->assets->employee_id)->name

            ];

        }
    }
    public function render(): View
    {
        dd($this->data['pic']);
        return view('livewire.barcode.barcode-details',$this->data);
    }
}
