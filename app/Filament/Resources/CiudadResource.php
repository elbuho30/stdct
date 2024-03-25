<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CiudadResource\Pages;
use App\Filament\Resources\CiudadResource\RelationManagers;
use App\Models\Ciudad;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;

class CiudadResource extends Resource
{
    protected static ?string $model = Ciudad::class;

    protected static ?string $modelLabel ='Ciudades';
    protected static ?string $navigationGroup = 'Maestros';
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationLabel = 'Ciudades';
    protected static ?int $navigationSort = 12;
    protected static ?string $pluralModelLabel ='Ciudades';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_pais')
                    ->required()
                    ->maxLength(3),
                Forms\Components\TextInput::make('id_departamento')
                    ->required()
                    ->maxLength(2),
                Forms\Components\TextInput::make('id_ciudad')
                    ->required()
                    ->maxLength(5),
                Forms\Components\TextInput::make('id_pdc')
                    ->maxLength(10),
                Forms\Components\TextInput::make('nombre_ciudad')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('id2_ciudad')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_pais')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_departamento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_ciudad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_pdc')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre_ciudad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id2_ciudad')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                Tables\Actions\ViewAction::make(),
               // Tables\Actions\EditAction::make(),
               // Tables\Actions\DeleteAction::make(),
               // Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                ])->color('info')
                  ->icon('heroicon-s-cog-6-tooth')
                  ->tooltip('Acciones')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make()->label('Exportar a Excel'),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListCiudads::route('/'),
            'create' => Pages\CreateCiudad::route('/create'),
            'view' => Pages\ViewCiudad::route('/{record}'),
            'edit' => Pages\EditCiudad::route('/{record}/edit'),
        ];
    }
}
