<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetResource\Pages;
use App\Filament\Resources\AssetResource\RelationManagers;
use App\Models\Asset;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    public static function form(Form $form): Form
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
                Forms\Components\Select::make('asset_type')
                    ->options([
                        'Laptop' => 'Laptop',
                        'PC(Komputer)' => 'PC(Komputer)',
                        'Printer' => 'Printer',
                        'CCTV' => 'CCTV',
                        'Server' => 'Server',
                        'Other' => 'Other',
                    ])
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function($state,callable $set){
                       $generatedNumber = Asset::generateAssetNumber($state);
                       $set('asset_number',$generatedNumber);
                    }),
                Forms\Components\Select::make('employee_id')
                    ->label('PIC Assets')
                    ->options(Employee::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\Select::make('vendor_id')
                    ->relationship(name: 'vendor', titleAttribute: 'vendor_name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('vendor_name')
                            ->required(),
                        Forms\Components\TextInput::make('address')
                            ->required()
                    ]),
                Forms\Components\TextInput::make('discription')
                    ->maxLength(64),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('asset_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('brand_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('model_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('asset_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('employee.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_manufacture')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssets::route('/'),
            'create' => Pages\CreateAsset::route('/create'),
            'edit' => Pages\EditAsset::route('/{record}/edit'),
        ];
    }
}
