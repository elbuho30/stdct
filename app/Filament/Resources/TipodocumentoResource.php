<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipodocumentoResource\Pages;
use App\Filament\Resources\TipodocumentoResource\RelationManagers;
use App\Models\Tipodocumento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class TipodocumentoResource extends Resource
{
    protected static ?string $model = Tipodocumento::class;

    protected static ?string $modelLabel ='Tipo Documento';
    protected static ?string $navigationGroup = 'Maestros';
    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationLabel = 'Tipos Documento';
    protected static ?int $navigationSort = 9;
    protected static ?string $pluralModelLabel ='Tipos Documento';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_tipo_doc')
                    ->maxLength(1),
                Forms\Components\TextInput::make('nombre_tipo_doc')
                    ->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_tipo_doc')->label('Identificador')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre_tipo_doc')->label('Nombre')
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
            'index' => Pages\ListTipodocumentos::route('/'),
            'create' => Pages\CreateTipodocumento::route('/create'),
            'view' => Pages\ViewTipodocumento::route('/{record}'),
            'edit' => Pages\EditTipodocumento::route('/{record}/edit'),
        ];
    }
}
