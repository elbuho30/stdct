<?php

namespace App\Filament\Resources\NitResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Split;
use Illuminate\Support\HtmlString;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use App\Models\Credito;
use Filament\Tables\Actions\Action;
//use App\Models\{Transcred,Codeudor};

class CreditosRelationManager extends RelationManager
{
    protected static string $relationship = 'creditos';
    protected static ?string $pluralLabel = 'Créditos';
    protected static ?string $label = 'Créditos';
    protected static ?string $title = 'Créditos';
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
                TextColumn::make('linea_credito')
                    ->formatStateUsing(fn($state) => new HtmlString('<b>Línea</b><br>' . $state)),
                    TextColumn::make('nom_destino')
                    ->formatStateUsing(fn($state) => new HtmlString('<b>Destino</b><br>' . $state)),
                    TextColumn::make('nro_pagare')
                    ->formatStateUsing(fn($state) => new HtmlString('<b>Pagaré</b><br>' . $state)),
                    TextColumn::make('monto_inicial')
                    ->formatStateUsing(fn($state) => new HtmlString('<b>Monto inicial</b><br> $' . number_format($state))),
                    TextColumn::make('id')
                    ->formatStateUsing(function($state) {
                        $creditos = Credito::where('id', $state)->get();
                        $cuota;
                        foreach($creditos as $credito){

                            $cuota = $credito['cuota'] + $credito['total_costos'];
                        }
                        return new HtmlString('<b>Cuota</b><br> $' . number_format($cuota));
                    }),
                    TextColumn::make('saldo_capital')
                    ->formatStateUsing(fn($state) => new HtmlString('<b>Saldo capital</b><br> $' . number_format($state))),
                    TextColumn::make('id')
                    ->formatStateUsing(function($state) {
                        $creditos = Credito::where('id', $state)->get();
                        $pago_total;
                        foreach($creditos as $credito){

                            $pago_total = $credito['saldo_capital'] + $credito['int_corriente'] + $credito['int_corr_no_contab'] + $credito['int_mora'] + $credito['int_mora_no_contab'] + $credito['total_costos'];
                        }
                        return new HtmlString('<b>Pago Total</b><br> $' . number_format($pago_total));
                    }),
                    TextColumn::make('id')
                    ->formatStateUsing(function($state) {
                        $creditos = Credito::where('id', $state)->get();
                        $valor_pagar;

                        foreach($creditos as $credito){
                            if($credito['morosidad']>0){
                                $valor_pagar = $credito['morosidad'] + $credito['total_costos'];
                                return new HtmlString('<b>Valor Pagar</b><br> $' . number_format($valor_pagar));
                            }else{
                                $valor_pagar = $credito['cuota'] +  $credito['total_costos'] + $credito['int_corriente'] + $credito['int_corr_no_contab'] + $credito['int_mora'] + $credito['int_mora_no_contab'];
                                return new HtmlString('<b>Valor Pagar</b><br> $' . number_format($valor_pagar));
                            }
                        }
                    }),
                    TextColumn::make('fecha_ult_pago')
                    ->formatStateUsing(function($state) {
                        $state = strtotime($state);
                        return new HtmlString('<b>Últ. Transacción</b><br> '. date('Y-m-d',$state));
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
                        TextColumn::make('fecha_ini_financia')
                        ->formatStateUsing(function($state) {
                            $state = strtotime($state);
                            return new HtmlString('<b>Fecha inicio</b><br> '. date('Y-m-d',$state));
                        }),
                        TextColumn::make('plazo')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Plazo</b><br>' . $state)),
                        TextColumn::make('tasa_colocacion')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Tasa Nominal</b><br> ' . number_format($state,2) . '%')),
                        TextColumn::make('tasa_efectiva')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Tasa Efectiva</b><br> ' . number_format($state,2) . '%')),
                        TextColumn::make('periodo_capital')
                        ->formatStateUsing(function($state) {
                            $peridos = [
                                'Q'=>  'Quincenal',
                                'M' => 'Mensual',
                                'C' => 'Cuatrimestral',
                                'A' => 'Anual',
                                'S'=> 'Semestral',
                                'B' => 'Bimestral',
                                'V' => 'Vencimiento'
                            ];
                            foreach($peridos as $key => $perido){
                                if($key == $state){
                                    return new HtmlString('<b>Periodo Capital</b><br>'. $perido);
                                }
                            }
                        }),
                        Textcolumn::make('periodo_int')
                        ->formatStateUsing(function($state) {
                            $peridos = [
                                'Q'=>  'Quincenal',
                                'M' => 'Mensual',
                                'C' => 'Cuatrimestral',
                                'A' => 'Anual',
                                'S'=> 'Semestral',
                                'B' => 'Bimestral',
                                'V' => 'Vencimiento'
                            ];
                            foreach($peridos as $key => $perido){
                                if($key == $state){
                                    return new HtmlString('<b>Periodo Interés</b><br>'. $perido);
                                }
                            }
                        }),
                        TextColumn::make('forma_pago')
                        ->formatStateUsing(function($state)  {
                            if($state == 'T'){
                                return new HtmlString('<b>Forma pago</b><br> Taquilla');
                            }else{
                                return new HtmlString('<b>Forma pago</b><br> Nómina');
                            }
                        }),
                        TextColumn::make('tipo_liquidacion')
                        ->formatStateUsing(function($state)  {
                            if($state == 'L'){
                                return new HtmlString('<b>Tipo Liquidación</b><br> Normal');
                            }else{
                                return new HtmlString('<b>Tipo Liquidación</b><br> Reestructurado');
                            }
                        }),
                        TextColumn::make('int_corriente')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Int. Corriente</b><br> $' . number_format($state))),
                        TextColumn::make('int_mora')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Int. Mora</b><br> $' . number_format($state))),
                        TextColumn::make('dias_mora')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Días Mora</b><br> $' . number_format($state))),
                        TextColumn::make('fecha_morosidad')
                        ->formatStateUsing(function($state) {
                            $state = strtotime($state);
                            return new HtmlString('<b>Fecha Morosidad</b><br> '. date('Y-m-d',$state));
                        }),
                        TextColumn::make('juridico')
                        ->formatStateUsing(function($state) {
                            if($state == 'N'){
                                return new HtmlString('<b>Jurídico</b><br> No');
                            }else{
                                return new HtmlString('<b>Jurídico</b><br> Si');;
                            }
                        }),
                        TextColumn::make('pre_juridico')
                        ->formatStateUsing(function($state) {
                            if($state == 'N'){
                                return new HtmlString('<b>Prejurídico</b><br> No');
                            }else{
                                return new HtmlString('<b>Prejurídico</b><br> Si');;
                            }
                        }),
                        TextColumn::make('nom_garantia')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Garantía</b><br> ' . $state)),
                        TextColumn::make('val_garantia')
                        ->formatStateUsing(fn($state) => new HtmlString('<b>Valor Garantía</b><br> $' . number_format($state))),
                    ]),
            ])->collapsible(),
        ])
            ->filters([
                //
            ])
            ->headerActions([
            //    Tables\Actions\CreateAction::make(),
            ])
            ->actions([
            //    Tables\Actions\EditAction::make(),
            //    Tables\Actions\DeleteAction::make(),
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
}
