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
use Illuminate\Support\HtmlString;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AhorroscontractualesRelationManager extends RelationManager
{
    protected static string $relationship = 'ahorrosContractuales';
    protected static ?string $pluralLabel = 'Ahorros contractuales';
    protected static ?string $label = 'Ahorros contractuales';
    protected static ?string $title = 'Ahorros contractuales';

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
            Grid::make([
                'default' => 2,
                'sm' => 3,
                'md' => 5,
                'lg' => 6,
                'xl' => 8,
                '2xl' => 8,
            ])
                ->schema([
                    TextColumn::make('linea_ahorro')
                    ->formatStateUsing(fn($state) => new HtmlString('<b>Línea</b><br>' . $state)),
                    TextColumn::make('nro_cuenta')
                    ->formatStateUsing(fn($state) => new HtmlString('<b>Nro. Cuenta</b><br>' . $state)),
                    TextColumn::make('fecha_inicio')
                    ->formatStateUsing(function($state) {
                        $state = strtotime($state);
                        return new HtmlString('<b>Fecha Inicio</b><br> '. date('Y-m-d',$state));
                    }),
                    TextColumn::make('saldo')
                    ->formatStateUsing(fn($state) => new HtmlString('<b>Saldo</b><br> $' . number_format($state))),
                    TextColumn::make('cuota')
                    ->formatStateUsing(fn($state) => new HtmlString('<b>Cuota</b><br> $' . number_format($state))),
                    TextColumn::make('morosidad')
                    ->formatStateUsing(fn($state) => new HtmlString('<b>Morosidad</b><br> $' . number_format($state))),
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
                    }),
                ]),
                Panel::make([
                    Grid::make([
                'default' => 2,
                        'sm' => 3,
                        'md' => 5,
                        'lg' => 6,
                        'xl' => 8,
                        '2xl' => 8,
                    ])->schema([
                        TextColumn::make('plazo_dias')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Plazo</b><br>' . number_format($state))),
                        TextColumn::make('fecha_vence')
                        ->formatStateUsing(function($state) {
                            $state = strtotime($state);
                            return new HtmlString('<b>Fecha Vence</b><br> '. date('Y-m-d',$state));
                        }),
                        TextColumn::make('tasa_captacion')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Tasa</b><br>' . number_format($state, 2). '%')),
                        TextColumn::make('int_causado')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Int. Causado</b><br> $' . number_format($state))),
                        TextColumn::make('int_disponible')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Int. Disponible</b><br> $' . number_format($state))),
                        TextColumn::make('liq_autom')
                        ->formatStateUsing(function($state) {
                            if($state == 'S'){
                                return new HtmlString('<b>liquidación Automática</b><br> Si');
                            }else{
                                return new HtmlString('<b>liquidación Automática</b><br> No');
                            }
                        }),
                        TextColumn::make('cod_linea_liquida')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Línea Liquidación</b><br>' . $state)),
                        TextColumn::make('nro_cta_liquida')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Nro. Cta. Liquidación</b><br>' . $state)),
                    ]),
                ])->collapsible(),
        ])
            ->filters([
                //
            ])
            ->headerActions([
                //Tables\Actions\CreateAction::make(),
            ])
            ->actions([
               // Tables\Actions\EditAction::make(),
               // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
               // Tables\Actions\BulkActionGroup::make([
               //     Tables\Actions\DeleteBulkAction::make(),
               // ]),
            ])
            ->emptyStateActions([
             //   Tables\Actions\CreateAction::make(),
            ]);
    }
    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [10, 25, 50, 100];
    }

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        if($ownerRecord->ahorrosContractuales->count() == 0){
            return false;
        }
        return true;
    }
}
