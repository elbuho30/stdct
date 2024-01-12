<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaisResource\Pages;
use App\Filament\Resources\PaisResource\RelationManagers;
use App\Models\Pais;
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

class PaisResource extends Resource
{
    protected static ?string $model = Pais::class;
    protected static ?string $modelLabel ='Países';
    protected static ?string $navigationGroup = 'Maestros';
    protected static ?string $navigationIcon =  'heroicon-o-globe-americas';  
    protected static ?string $navigationLabel = 'Países';
    protected static ?int $navigationSort = 3;
    protected static ?string $pluralModelLabel ='Países';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_pais')
                    ->required()
                    ->maxLength(3),
                Forms\Components\TextInput::make('nombre_pais')
                    ->required()
                    ->maxLength(200),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_pais')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre_pais')
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
            'index' => Pages\ListPais::route('/'),
            'create' => Pages\CreatePais::route('/create'),
            'view' => Pages\ViewPais::route('/{record}'),
            'edit' => Pages\EditPais::route('/{record}/edit'),
        ];
    }    
}
