<?php

namespace App\Filament\Resources\NitResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\Action;
use Illuminate\Support\HtmlString;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AhorrosterminoRelationManager extends RelationManager
{
    protected static string $relationship = 'ahorrosTermino';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
        ->columns([
            Split::make([
                TextColumn::make('linea_ahorro')
                ->formatStateUsing(fn($state) => new HtmlString('<b>Línea</b><br>' . $state)),
                TextColumn::make('nro_cuenta')
                ->formatStateUsing(fn($state) => new HtmlString('<b>Nro. Cuenta</b><br>' . $state)),
                TextColumn::make('fecha_inicio')
                ->formatStateUsing(function($state) {
                    $state = strtotime($state);
                    return new HtmlString('<b>Fecha Inicio</b><br> '. date('Y-m-d',$state));
                }),
                TextColumn::make('fecha_renovacion')
                ->formatStateUsing(function($state) {
                    $state = strtotime($state);
                    return new HtmlString('<b>Fecha Renovación</b><br> '. date('Y-m-d',$state));
                }),
                TextColumn::make('saldo')
                ->formatStateUsing(fn($state) => new HtmlString('<b>Saldo</b><br> $' . number_format($state))),
                TextColumn::make('fecha_ult_trans')
                ->formatStateUsing(function($state) {
                    $state = strtotime($state);
                    return new HtmlString('<b>Últ. Transacción</b><br> '. date('Y-m-d',$state));
                }),
                TextColumn::make('estado')
                ->formatStateUsing(function($state){
                    if ($state == 'A') {
                        return new HtmlString('<b>Estado</b><br> Activo');
                    }else{
                        return new HtmlString('<b>Estado</b><br> Inactivo');
                    }
                })
                ]),
                Panel::make([
                    Grid::make(4)
                    ->schema([
                        TextColumn::make('plazo_dias')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Plazo</b><br>' . $state)),
                        TextColumn::make('fecha_vence_capital')
                        ->formatStateUsing(function($state) {
                            $state = strtotime($state);
                            return new HtmlString('<b>Fecha Vence</b><br> '. date('Y-m-d',$state));
                        }),
                        TextColumn::make('periodo_liq_int_dias')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Periodo Liquidación</b><br>' . $state)),
                        TextColumn::make('tasa_captacion')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Tasa</b><br>' . number_format($state,2) . '%')),
                        TextColumn::make('int_causado')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Int. Causado</b><br> $' . number_format($state))),
                        TextColumn::make('int_disponible')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Int. Disponible</b><br> $' . number_format($state))),
                        TextColumn::make('cod_linea_liquida')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Línea Liquidación</b><br>' . $state)),
                        TextColumn::make('nro_cta_liquida')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Nro. Cta. Liquidación</b><br>' . $state)),
                    ])
                ])
                ->collapsible()
        ])
            ->filters([
                //
            ])
            ->headerActions([
              //  Tables\Actions\CreateAction::make(),
            ])
            ->actions([
              //  Tables\Actions\EditAction::make(),
              //  Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
              //  Tables\Actions\BulkActionGroup::make([
              //      Tables\Actions\DeleteBulkAction::make(),
              //  ]),
            ])
            ->emptyStateActions([
              // Tables\Actions\CreateAction::make(),
            ]);
    }
    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [10, 25, 50, 100];
    }

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        if($ownerRecord->ahorrosTermino->count() == 0){
            return false;
        }
        return true;
    }
}
