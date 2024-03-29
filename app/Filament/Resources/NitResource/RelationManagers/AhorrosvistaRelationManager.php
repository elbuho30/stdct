<?php

namespace App\Filament\Resources\NitResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\HtmlString;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\{Transahovist};
use function Filament\authorize;
use Illuminate\Support\Facades\Gate;
use Filament\Facades\Filament;
class AhorrosvistaRelationManager extends RelationManager
{
    protected static string $relationship = 'ahorrosVista';
    protected static ?string $pluralLabel = 'Ahorros a la vista';
    protected static ?string $label = 'Ahorros a la vista';
    protected static ?string $title = 'Ahorros a la vista';

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
                    'lg' => 5,
                    'xl' => 5,
                    '2xl' => 5,
                ])->schema([
                    TextColumn::make('tasa_captacion')
                    ->formatStateUsing(function($state){
                        return new HtmlString('<b>Tasa</b><br>'.number_format($state, 2).'%');
                    }),
                    TextColumn::make('int_causado')
                    ->formatStateUsing(fn($state) => new HtmlString('<b>Int. Causado</b><br> $' . number_format($state))),
                    TextColumn::make('int_disponible')
                    ->formatStateUsing(fn($state) => new HtmlString('<b>Int. Disponible</b><br> $' . number_format($state))),
                    TextColumn::make('int_liquidado')
                    ->formatStateUsing(fn($state) => new HtmlString('<b>Int. Liquidado</b><br> $' . number_format($state))),
                    TextColumn::make('Nro_Tarjeta_Debito')
                    ->formatStateUsing(fn($state) => new HtmlString('<b>Nro. Tarjeta</b><br>' . $state)),
                ])
            ])->collapsible(),
        ])
            ->filters([
                //
            ])
            ->headerActions([
              //  Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Action::make('modal')
                ->label('')
                ->modalSubmitAction(false)
                ->modalCancelAction(false)
                ->action(function(){})
                ->modalWidth('7xl')
                ->icon('heroicon-o-arrows-right-left')
                ->tooltip('Ver transacciones')
                ->modalContent(function (Model $record) {
                   $id = $record->id;
                    return view('filament.pages.actions.modal', ['id' => $id, 'model' => 'ahorros_vista']);
                })
                ->modalHeading(function(Model $record){
                    return 'A la vista | Transacciones Cta.: ' . $record->nro_cuenta;
                })
                ->visible(function(Model $record) {
                    if (Transahovist::where('crm_ahorro_id', $record->id)->get()->isEmpty()) {
                        return false;
                    }
                    return true;
                }),
            ])
            ->bulkActions([
            //    Tables\Actions\BulkActionGroup::make([
            //        Tables\Actions\DeleteBulkAction::make(),
            //    ]),
            ])
            ->emptyStateActions([
            //    Tables\Actions\CreateAction::make(),
            ]);
    }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [10, 25, 50, 100];
    }

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        if($ownerRecord->ahorrosVista->count() == 0){
            return false;
        }
        return true;
    }
}
