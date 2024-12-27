<?php

namespace App\Filament\Pages;

use Filament\Tables;
use App\Models\Asset;
use Filament\Forms\Set;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use App\Models\Barcode as ModelsBarcode;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\Collection;

class Barcode extends Page implements HasTable , HasForms
{

    use InteractsWithTable;
    use InteractsWithForms;

    protected static ?string $model = ModelsBarcode::class;

    protected static ?string $navigationIcon = 'heroicon-o-finger-print';

    protected static string $view = 'filament.pages.barcode';

    public static function table(Table $table): Table
    {
        return $table
            ->query(ModelsBarcode::query())
            ->columns([
                Tables\Columns\TextColumn::make('barcode_number'),
                Tables\Columns\TextColumn::make('assets.asset_number'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'unused' => 'gray',
                        'printed' => 'warning',
                        'used' => 'success',
                        'error' => 'danger'
                    })
            ])
            ->filters([

            ])
            ->headerActions([
                // ...
                Tables\Actions\Action::make('Generate Barcode')
                ->button()
                ->color('success')
                ->icon('heroicon-o-document-plus')
                ->form([
                    TextInput::make('barcode_number')
                    ->suffixAction(
                        Action::make('copyCostToPrice')
                            ->icon('heroicon-o-arrow-path-rounded-square')
                            ->action(function (Set $set, $state) {
                                do {
                                    $state = fake()->regexify('[A-Z]{8}[0-9]{5}');
                                } while (!ModelsBarcode::where('barcode_number',$state));
                                $set('barcode_number', $state);
                            }))
                    ->required()
                    ->readOnly(),
                    Select::make('asset_id')
                    ->label('Asset Code')
                    ->options(Asset::all()->pluck('asset_number', 'id'))
                    ->searchable(),
                    Select::make('status')
                        ->label('Status Barcode')
                        ->options([
                            'unused'  => 'unused',
                            'printed' => 'printed',
                            'used'    => 'used',
                            'rejected'=>'rejected',
                        ])
                    //     ->required(),
                ])
                ->action(function (array $data) {
                    ModelsBarcode::create($data);
                })
            ])
            ->actions([
                Tables\Actions\EditAction::make('edit')
                ->form([
                    TextInput::make('barcode_number')
                    ->suffixAction(
                        Action::make('copyCostToPrice')
                            ->icon('heroicon-o-arrow-path-rounded-square')
                            ->action(function (Set $set, $state) {
                                $state = fake()->regexify('[A-Z]{8}[0-9]{5}');
                                $set('barcode_number', $state);
                            })),
                    Select::make('asset_id')
                    ->label('Asset Code')
                    ->options(Asset::all()->pluck('asset_number', 'id'))
                    ->searchable(),
                    Select::make('status')
                        ->label('Status Barcode')
                        ->options([
                            'unused'  => 'unused',
                            'printed' => 'printed',
                            'used'    => 'used',
                            'rejected'=> 'rejected',
                        ])
                        ->required(),
                ])
                ->action(function (array $data,ModelsBarcode $record ) {
                    $record->update($data);
                }),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('Print')
                    ->icon('heroicon-m-printer')
                    ->action(function (Collection $records){

                        foreach ($records as $record) {
                            $record->status = 'printed';
                            $record->save();
                        }
                        session()->put('bulk-print', $records);

                        return redirect()->route('bulk-print');
                    })
                    ->openUrlInNewTab(),

                ]),
            ]);
    }

}
