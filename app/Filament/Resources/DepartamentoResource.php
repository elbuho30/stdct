<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartamentoResource\Pages;
use App\Filament\Resources\DepartamentoResource\RelationManagers;
use App\Models\Departamento;
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

class DepartamentoResource extends Resource
{
    protected static ?string $model = Departamento::class;

    protected static ?string $modelLabel ='Departamentos';
    protected static ?string $navigationGroup = 'Maestros';
    protected static ?string $navigationIcon = 'heroicon-o-map';  
    protected static ?string $navigationLabel = 'Departamentos';
    protected static ?int $navigationSort = 4;
    protected static ?string $pluralModelLabel ='Departamentos';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_pais')
                    ->required()
                    ->maxLength(3),
                Forms\Components\TextInput::make('id_pd')
                    ->maxLength(5),
                Forms\Components\TextInput::make('id_departamento')
                    ->required()
                    ->maxLength(2),
                Forms\Components\TextInput::make('nombre_departamento')
                    ->required()
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_pais')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_pd')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_departamento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre_departamento')
                    ->searchable(),
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
            'index' => Pages\ListDepartamentos::route('/'),
            'create' => Pages\CreateDepartamento::route('/create'),
            'view' => Pages\ViewDepartamento::route('/{record}'),
            'edit' => Pages\EditDepartamento::route('/{record}/edit'),
        ];
    }    
}
