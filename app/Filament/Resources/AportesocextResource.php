<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AportesocextResource\Pages;
use App\Filament\Resources\AportesocextResource\RelationManagers;
use App\Models\Aportesocext;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AportesocextResource extends Resource
{
    protected static ?string $model = Aportesocext::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                Forms\Components\DatePicker::make('fecha_ult_trans'),
                Forms\Components\TextInput::make('saldo')
                    ->numeric(),
                Forms\Components\TextInput::make('morosidad')
                    ->numeric(),
                Forms\Components\TextInput::make('forma_pago')
                    ->maxLength(1),
                Forms\Components\TextInput::make('id_agencia')
                    ->numeric(),
                Forms\Components\TextInput::make('cuota')
                    ->numeric(),
                Forms\Components\TextInput::make('tipo_cuota')
                    ->maxLength(1),
                Forms\Components\TextInput::make('porcentaje_salario')
                    ->numeric(),
                Forms\Components\TextInput::make('porcentaje_cuota')
                    ->numeric(),
                Forms\Components\TextInput::make('estado')
                    ->maxLength(1),
                Forms\Components\TextInput::make('id_nits')
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
                Tables\Columns\TextColumn::make('tipo_cuota')
                    ->searchable(),
                Tables\Columns\TextColumn::make('porcentaje_salario')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('porcentaje_cuota')
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
                Tables\Columns\TextColumn::make('id_nits')
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
            'index' => Pages\ListAportesocexts::route('/'),
            'create' => Pages\CreateAportesocext::route('/create'),
            'view' => Pages\ViewAportesocext::route('/{record}'),
            'edit' => Pages\EditAportesocext::route('/{record}/edit'),
        ];
    }    
}
