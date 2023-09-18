<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgenciaResource\Pages;
use App\Filament\Resources\AgenciaResource\RelationManagers;
use App\Models\Agencia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;


class AgenciaResource extends Resource
{
    protected static ?string $model = Agencia::class;

    protected static ?string $modelLabel ='Agencia';
    protected static ?string $navigationGroup = 'Maestros';
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';   
    protected static ?string $navigationLabel = 'Agencias';
    protected static ?int $navigationSort = 2;
    protected static ?string $pluralModelLabel ='Agencias';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_agencia')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('nombre_agencia')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('id_pais')
                    ->required()
                    ->maxLength(3),
                Forms\Components\TextInput::make('id_departamento')
                    ->maxLength(2),
                Forms\Components\TextInput::make('id_ciudad')
                    ->required()
                    ->maxLength(5),
                Forms\Components\TextInput::make('id_pdc')
                    ->maxLength(10),
                Forms\Components\TextInput::make('direccion')
                    ->maxLength(80),
                Forms\Components\TextInput::make('telefono')
                    ->tel()
                    ->maxLength(12),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_agencia')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nombre_agencia')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_pais')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_departamento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_ciudad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_pdc')
                    ->searchable(),
                Tables\Columns\TextColumn::make('direccion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
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
            'index' => Pages\ListAgencias::route('/'),
            'create' => Pages\CreateAgencia::route('/create'),
            'view' => Pages\ViewAgencia::route('/{record}'),
            'edit' => Pages\EditAgencia::route('/{record}/edit'),
        ];
    }    
}
