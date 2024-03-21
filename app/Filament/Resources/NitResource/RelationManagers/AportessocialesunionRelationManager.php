<?php

namespace App\Filament\Resources\NitResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables\Columns\Layout\Split;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Illuminate\Database\Eloquent\Model;
use App\Models\Aportesocext;

class AportessocialesunionRelationManager extends RelationManager
{
    protected static string $relationship = 'aportesSocialesUnion';
    protected static ?string $pluralLabel = 'Aportes';
    protected static ?string $label = 'Aportes';
    protected static ?string $title = 'Aportes';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nro_documento')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nro_documento')
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
                    })
                ]),
                Panel::make([
                    Split::make([
                        TextColumn::make('forma_pago')
                        ->formatStateUsing(function($state)  {
                            if($state == 'T'){
                                return new HtmlString('<b>Forma pago</b><br> Taquilla');
                            }else{
                                return new HtmlString('<b>Forma pago</b><br> Nómina');
                            }
                        }),
                        TextColumn::make('tipo_cuota')
                        ->formatStateUsing(function($state)  {
                            if($state == 'F'){
                                return new HtmlString('<b>Tipo Cuota</b><br> Fija');
                            }
                            return new HtmlString('<b>Tipo Cuota</b><br> Porcentaje');
                        }),
                    ])
                ])
                ->collapsible(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
               /*  Tables\Actions\CreateAction::make(), */
            ])
            ->actions([
               /*  Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),*/
            ])
            ->bulkActions([
                /* Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),*/
            ])
            ->emptyStateActions([
                /* Tables\Actions\CreateAction::make(),*/
            ]);
    }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [10, 25, 50, 100];
    }

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        if($ownerRecord->aportesSocialesUnion->count() == 0){
            return false;
        }
        return true;
    }
}
