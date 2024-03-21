<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AhorrovistaResource\Pages;
use App\Filament\Resources\AhorrovistaResource\RelationManagers;
use App\Models\Ahorrovista;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AhorrovistaResource extends Resource
{
    protected static ?string $model = Ahorrovista::class;

    protected static ?string $modelLabel ='Ahorro a la vista';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Productos';
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Ahorros a la vista';
    protected static ?string $pluralModelLabel ='Aportes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nro_documento')
                    ->required()
                    ->maxLength(24),
                Forms\Components\TextInput::make('nro_cuenta')
                    ->maxLength(20),
                Forms\Components\TextInput::make('linea_ahorro')
                    ->maxLength(4),
                Forms\Components\DatePicker::make('fecha_inicio'),
                Forms\Components\DatePicker::make('fecha_ult_trans'),
                Forms\Components\TextInput::make('saldo')
                    ->numeric(),
                Forms\Components\TextInput::make('tasa_captacion')
                    ->numeric(),
                Forms\Components\TextInput::make('morosidad')
                    ->numeric(),
                Forms\Components\TextInput::make('forma_pago')
                    ->maxLength(1),
                Forms\Components\TextInput::make('id_agencia')
                    ->numeric(),
                Forms\Components\TextInput::make('cuota')
                    ->numeric(),
                Forms\Components\TextInput::make('int_liquidado')
                    ->numeric(),
                Forms\Components\TextInput::make('int_disponible')
                    ->numeric(),
                Forms\Components\TextInput::make('int_causado')
                    ->numeric(),
                Forms\Components\TextInput::make('estado')
                    ->maxLength(1),
                Forms\Components\TextInput::make('id2_ahorros_vista')
                    ->maxLength(20),
                Forms\Components\TextInput::make('Nro_Tarjeta_Debito')
                    ->maxLength(24),
                Forms\Components\TextInput::make('id_usuario')
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
                Tables\Columns\TextColumn::make('fecha_ult_trans')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('saldo')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tasa_captacion')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('morosidad')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('forma_pago')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_agencia')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cuota')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('int_liquidado')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('int_disponible')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('int_causado')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estado')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id2_ahorros_vista')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Nro_Tarjeta_Debito')
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('id_usuario')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListAhorrovistas::route('/'),
            'create' => Pages\CreateAhorrovista::route('/create'),
            'view' => Pages\ViewAhorrovista::route('/{record}'),
            'edit' => Pages\EditAhorrovista::route('/{record}/edit'),
        ];
    }
}
