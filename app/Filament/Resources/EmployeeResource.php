<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Add Employee')
                ->schema([

                    Forms\Components\TextInput::make('nik')
                        ->unique()
                        ->tel()
                        ->required()
                        ->maxLength(64),
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('departement')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Select::make('branch_id')
                        ->relationship(name: 'branch', titleAttribute: 'name')
                        ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\Select::make('base_office')
                            ->options([
                                'Consumer Goods' => 'Consumer Goods',
                                'Building Material' => 'Building Material',
                                'Other' => 'Other',
                            ])->required(),
                        Forms\Components\Textarea::make('address')
                        ->label('Alamat Lengkap'),
                    ])
                    ->required(),
                ])->columns(1),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('departement')
                    ->searchable(),
                Tables\Columns\TextColumn::make('branch.name')
                    ->label('Cabang')
                    ->sortable(),
                Tables\Columns\TextColumn::make('branch.base_office')
                    ->label('Base')
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
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
