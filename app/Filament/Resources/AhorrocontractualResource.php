<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AhorrocontractualResource\Pages;
use App\Filament\Resources\AhorrocontractualResource\RelationManagers;
use App\Models\Ahorrocontractual;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AhorrocontractualResource extends Resource
{
    protected static ?string $model = Ahorrocontractual::class;

    protected static ?string $modelLabel ='Ahorro contractual';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Productos';
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Ahorros contractuales';
    protected static ?string $pluralModelLabel ='Ahorros contractuales';

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
                Forms\Components\DatePicker::make('fecha_vence'),
                Forms\Components\DatePicker::make('fecha_ult_trans'),
                Forms\Components\TextInput::make('saldo')
                    ->numeric(),
                Forms\Components\TextInput::make('plazo_dias')
                    ->numeric(),
                Forms\Components\TextInput::make('tasa_captacion')
                    ->maxLength(6),
                Forms\Components\TextInput::make('morosidad')
                    ->numeric(),
                Forms\Components\TextInput::make('forma_pago')
                    ->maxLength(1),
                Forms\Components\TextInput::make('id_agencia')
                    ->numeric(),
                Forms\Components\TextInput::make('tipo_cuota')
                    ->maxLength(1),
                Forms\Components\TextInput::make('cuota')
                    ->numeric(),
                Forms\Components\TextInput::make('int_liquidado')
                    ->numeric(),
                Forms\Components\TextInput::make('int_disponible')
                    ->numeric(),
                Forms\Components\TextInput::make('liq_autom')
                    ->maxLength(1),
                Forms\Components\TextInput::make('cod_linea_liquida')
                    ->maxLength(4),
                Forms\Components\TextInput::make('nro_cta_liquida')
                    ->maxLength(20),
                Forms\Components\TextInput::make('int_causado')
                    ->numeric(),
                Forms\Components\TextInput::make('estado')
                    ->maxLength(1),
                Forms\Components\TextInput::make('liquidado')
                    ->maxLength(1),
                Forms\Components\DatePicker::make('fecha_liquida'),
                Forms\Components\TextInput::make('id2_ahorros_contractual')
                    ->maxLength(20),
                Forms\Components\TextInput::make('id2_usuario')
                    ->numeric(),
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
                Tables\Columns\TextColumn::make('fecha_vence')
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
                Tables\Columns\TextColumn::make('tasa_captacion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('morosidad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('forma_pago')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_agencia')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipo_cuota')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cuota')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('int_liquidado')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('int_disponible')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('liq_autom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cod_linea_liquida')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nro_cta_liquida')
                    ->searchable(),
                Tables\Columns\TextColumn::make('int_causado')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('liquidado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_liquida')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id2_ahorros_contractual')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id2_usuario')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListAhorrocontractuals::route('/'),
            'create' => Pages\CreateAhorrocontractual::route('/create'),
            'view' => Pages\ViewAhorrocontractual::route('/{record}'),
            'edit' => Pages\EditAhorrocontractual::route('/{record}/edit'),
        ];
    }
}
