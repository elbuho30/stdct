<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AhorroterminoResource\Pages;
use App\Filament\Resources\AhorroterminoResource\RelationManagers;
use App\Models\Ahorrotermino;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AhorroterminoResource extends Resource
{
    protected static ?string $model = Ahorrotermino::class;

    protected static ?string $modelLabel ='Ahorro a término';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationGroup = 'Productos';
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Ahorros a término';
    protected static ?string $pluralModelLabel ='Ahorros a término';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nro_documento')
                    ->maxLength(24),
                Forms\Components\TextInput::make('nro_cuenta')
                    ->maxLength(20),
                Forms\Components\TextInput::make('linea_ahorro')
                    ->maxLength(4),
                Forms\Components\DatePicker::make('fecha_inicio'),
                Forms\Components\DatePicker::make('fecha_renovacion'),
                Forms\Components\DatePicker::make('fecha_vence_capital'),
                Forms\Components\DatePicker::make('fecha_ult_trans'),
                Forms\Components\TextInput::make('saldo')
                    ->numeric(),
                Forms\Components\TextInput::make('plazo_dias')
                    ->numeric(),
                Forms\Components\TextInput::make('periodo_liq_int_dias')
                    ->numeric(),
                Forms\Components\TextInput::make('tasa_captacion')
                    ->maxLength(8),
                Forms\Components\TextInput::make('pignorado')
                    ->maxLength(1),
                Forms\Components\TextInput::make('id_agencia')
                    ->numeric(),
                Forms\Components\TextInput::make('int_causado')
                    ->numeric(),
                Forms\Components\TextInput::make('int_disponible')
                    ->numeric(),
                Forms\Components\TextInput::make('cod_linea_liquida')
                    ->maxLength(4),
                Forms\Components\TextInput::make('nro_cta_liquida')
                    ->maxLength(20),
                Forms\Components\TextInput::make('id2_ahorro_termino')
                    ->maxLength(20),
                Forms\Components\TextInput::make('id_usuario')
                    ->maxLength(4),
                Forms\Components\TextInput::make('id_agencia_apertura')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nro_documento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nro_cuenta')
                    ->searchable(),
                Tables\Columns\TextColumn::make('linea_ahorro')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_inicio')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_renovacion')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_vence_capital')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_ult_trans')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('saldo')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('plazo_dias')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('periodo_liq_int_dias')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tasa_captacion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pignorado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_agencia')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('int_causado')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('int_disponible')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cod_linea_liquida')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nro_cta_liquida')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id2_ahorro_termino')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_usuario')
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
            'index' => Pages\ListAhorroterminos::route('/'),
            'create' => Pages\CreateAhorrotermino::route('/create'),
            'view' => Pages\ViewAhorrotermino::route('/{record}'),
            'edit' => Pages\EditAhorrotermino::route('/{record}/edit'),
        ];
    }
}
