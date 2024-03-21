<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CreditoResource\Pages;
use App\Filament\Resources\CreditoResource\RelationManagers;
use App\Models\Credito;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CreditoResource extends Resource
{
    protected static ?string $model = Credito::class;

    protected static ?string $modelLabel ='Crédito';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationGroup = 'Productos';
    protected static ?string $navigationIcon = 'heroicon-o-hand-thumb-up';
    protected static ?string $navigationLabel = 'Créditos';
    protected static ?string $pluralModelLabel ='Créditos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nro_documento')
                    ->maxLength(24),
                Forms\Components\TextInput::make('id_agencia')
                    ->numeric(),
                Forms\Components\TextInput::make('nro_pagare')
                    ->maxLength(24),
                Forms\Components\TextInput::make('monto_inicial')
                    ->numeric(),
                Forms\Components\TextInput::make('saldo_capital')
                    ->numeric(),
                Forms\Components\TextInput::make('linea_credito')
                    ->maxLength(4),
                Forms\Components\TextInput::make('nom_linea')
                    ->maxLength(100),
                Forms\Components\TextInput::make('destino_credito')
                    ->maxLength(4),
                Forms\Components\TextInput::make('nom_destino')
                    ->maxLength(50),
                Forms\Components\TextInput::make('id_subdestino')
                    ->maxLength(4),
                Forms\Components\TextInput::make('nom_subdestino')
                    ->maxLength(40),
                Forms\Components\TextInput::make('tipo_liquidacion')
                    ->maxLength(1),
                Forms\Components\TextInput::make('cuota')
                    ->numeric(),
                Forms\Components\TextInput::make('tasa_colocacion')
                    ->maxLength(6),
                Forms\Components\TextInput::make('tasa_efectiva')
                    ->maxLength(6),
                Forms\Components\DatePicker::make('fecha_vence'),
                Forms\Components\TextInput::make('forma_pago')
                    ->maxLength(1),
                Forms\Components\TextInput::make('tipocuota')
                    ->maxLength(1),
                Forms\Components\TextInput::make('modalidad_int')
                    ->maxLength(1),
                Forms\Components\TextInput::make('periodo_int')
                    ->maxLength(1),
                Forms\Components\TextInput::make('modalidad_capital')
                    ->maxLength(1),
                Forms\Components\TextInput::make('periodo_capital')
                    ->maxLength(1),
                Forms\Components\TextInput::make('plazo')
                    ->maxLength(6),
                Forms\Components\TextInput::make('dias_mora')
                    ->numeric(),
                Forms\Components\TextInput::make('morosidad')
                    ->numeric(),
                Forms\Components\DatePicker::make('fecha_morosidad'),
                Forms\Components\TextInput::make('juridico')
                    ->maxLength(1),
                Forms\Components\TextInput::make('pre_juridico')
                    ->maxLength(1),
                Forms\Components\TextInput::make('datacredito')
                    ->maxLength(1),
                Forms\Components\TextInput::make('id_garantia')
                    ->maxLength(10),
                Forms\Components\TextInput::make('nom_garantia')
                    ->maxLength(50),
                Forms\Components\TextInput::make('val_garantia')
                    ->numeric(),
                Forms\Components\DatePicker::make('fecha_ini_financia'),
                Forms\Components\DatePicker::make('fecha_desembolso'),
                Forms\Components\DatePicker::make('fecha_ult_pago'),
                Forms\Components\TextInput::make('int_corriente')
                    ->numeric(),
                Forms\Components\TextInput::make('int_corr_no_contab')
                    ->numeric(),
                Forms\Components\TextInput::make('int_mora')
                    ->numeric(),
                Forms\Components\TextInput::make('int_mora_no_contab')
                    ->numeric(),
                Forms\Components\TextInput::make('id2_credito')
                    ->numeric(),
                Forms\Components\TextInput::make('nro_solicitud')
                    ->numeric(),
                Forms\Components\TextInput::make('id_usuario')
                    ->numeric(),
                Forms\Components\TextInput::make('padre_rotativo')
                    ->maxLength(30),
                Forms\Components\TextInput::make('id_agencia_apertura')
                    ->numeric(),
                Forms\Components\TextInput::make('total_costos')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nro_documento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_agencia')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nro_pagare')
                    ->searchable(),
                Tables\Columns\TextColumn::make('monto_inicial')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('saldo_capital')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('linea_credito')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nom_linea')
                    ->searchable(),
                Tables\Columns\TextColumn::make('destino_credito')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nom_destino')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_subdestino')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nom_subdestino')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipo_liquidacion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cuota')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tasa_colocacion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tasa_efectiva')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_vence')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('forma_pago')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipocuota')
                    ->searchable(),
                Tables\Columns\TextColumn::make('modalidad_int')
                    ->searchable(),
                Tables\Columns\TextColumn::make('periodo_int')
                    ->searchable(),
                Tables\Columns\TextColumn::make('modalidad_capital')
                    ->searchable(),
                Tables\Columns\TextColumn::make('periodo_capital')
                    ->searchable(),
                Tables\Columns\TextColumn::make('plazo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dias_mora')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('morosidad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_morosidad')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('juridico')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pre_juridico')
                    ->searchable(),
                Tables\Columns\TextColumn::make('datacredito')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_garantia')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nom_garantia')
                    ->searchable(),
                Tables\Columns\TextColumn::make('val_garantia')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_ini_financia')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_desembolso')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_ult_pago')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('int_corriente')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('int_corr_no_contab')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('int_mora')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('int_mora_no_contab')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id2_credito')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nro_solicitud')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_usuario')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('padre_rotativo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('id_agencia_apertura')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_costos')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListCreditos::route('/'),
            'create' => Pages\CreateCredito::route('/create'),
            'view' => Pages\ViewCredito::route('/{record}'),
            'edit' => Pages\EditCredito::route('/{record}/edit'),
        ];
    }
}
