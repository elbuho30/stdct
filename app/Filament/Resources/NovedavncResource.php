<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NovedavncResource\Pages;
use App\Filament\Resources\NovedavncResource\RelationManagers;
use App\Models\Novedavnc;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NovedavncResource extends Resource
{
    protected static ?string $model = Novedavnc::class;

    protected static ?string $modelLabel ='Novedad V.N.C.';
    protected static ?int $navigationSort = 6;
    protected static ?string $navigationGroup = 'Productos';
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Novedades V.N.C.';
    protected static ?string $pluralModelLabel ='Novedades V.N.C.';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nro_documento')
                    ->maxLength(24),
                Forms\Components\TextInput::make('consecutivo')
                    ->numeric(),
                Forms\Components\TextInput::make('id_novedad')
                    ->maxLength(4),
                Forms\Components\TextInput::make('nombre_novedad')
                    ->maxLength(100),
                Forms\Components\TextInput::make('cta_contable')
                    ->maxLength(12),
                Forms\Components\DatePicker::make('fecha_inicio'),
                Forms\Components\TextInput::make('cuota')
                    ->numeric(),
                Forms\Components\TextInput::make('saldo')
                    ->numeric(),
                Forms\Components\TextInput::make('id_agencia')
                    ->numeric(),
                Forms\Components\TextInput::make('estado')
                    ->maxLength(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nro_documento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('consecutivo')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_novedad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre_novedad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cta_contable')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_inicio')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cuota')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('saldo')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_agencia')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListNovedavncs::route('/'),
            'create' => Pages\CreateNovedavnc::route('/create'),
            'view' => Pages\ViewNovedavnc::route('/{record}'),
            'edit' => Pages\EditNovedavnc::route('/{record}/edit'),
        ];
    }
}
