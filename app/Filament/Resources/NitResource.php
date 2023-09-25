<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NitResource\Pages;
use App\Filament\Resources\NitResource\RelationManagers;
use App\Models\Nit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Resources\RelationManagers\RelationGroup;

class NitResource extends Resource
{
    protected static ?string $model = Nit::class;

    protected static ?string $modelLabel ='Asociado';
    protected static ?string $navigationGroup = 'Datos';
    protected static ?string $navigationIcon = 'feathericon-users';   
    protected static ?string $navigationLabel = 'Asociados';
    protected static ?int $navigationSort = 1;
    protected static ?string $pluralModelLabel ='Asociados';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('agencia.nombre_agencia')->label('Agencia')->sortable(),
                TextColumn::make('tipoDocumento.nombre_tipo_doc')->label('Tipo documento')->sortable(),
                TextColumn::make('nro_documento')->label('Nro. Documento')->searchable()->sortable(),
                TextColumn::make('nombre_integrado')->label('Asociado')->searchable(),
                TextColumn::make('celular')->label('Celular'),
                TextColumn::make('email')->label('Correo electrónico')->searchable(),
                // TextColumn::make('aportesSocialess.morosidad')->label('Morosidad')->money('cop')->sortable(),
                TextColumn::make('saldo_aportes')->label('Saldo aportes')->money('cop')->sortable(),
                //TextColumn::make('relacion')->enum([ 'A' => 'Asociado', 'T' => 'Tercero', 'C' => 'Codeudor',])->label('Relación')->sortable(),
                TextColumn::make('relacion')
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'A' => 'Asociado',
                    'T' => 'Tercero',
                    'C' => 'Codeudor',
                })->label('Relación'),

                TextColumn::make('edad')->label('Edad')->sortable(),
                TextColumn::make('fecha_ult_actualizacion_datos')->label('Fecha últ. actualización')->date('d/m/Y')->sortable(),
                TextColumn::make('fecha_ingreso')->label('Fecha ingreso')->date('d/m/Y')->sortable(),                
                TextColumn::make('fecha_exp_documento')->label('Fecha expedición documento')->date('d/m/Y')->sortable(),
                //TextColumn::make('ciudadExp.nombre_ciudad')->label('Ciudad expedición documento'),
                //TextColumn::make('paisExp.nombre_pais')->label('País expedición documento'),
            ])
            ->filters([
                SelectFilter::make('id_agencia')->relationship('agencia', 'nombre_agencia')->label('Agencia'),
                Filter::make('fecha_ingreso')
                ->form([
                    Forms\Components\DatePicker::make('fecha_ingreso_inicial'),
                    Forms\Components\DatePicker::make('fecha_ingreso_final'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['fecha_ingreso_inicial'],
                            fn (Builder $query, $date): Builder => $query->whereDate('fecha_ingreso', '>=', $date),
                        )
                        ->when(
                            $data['fecha_ingreso_final'],
                            fn (Builder $query, $date): Builder => $query->whereDate('fecha_ingreso', '<=', $date),
                        );
                }),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                ])->color('info')
                  ->icon('heroicon-s-cog-6-tooth')
                  ->tooltip('Acciones')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make()->label('Exportar a Excel'),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            // RelationGroup::make('Estado de cuenta',[
            //     RelationManagers\AportesSocialesRelationManager::class,
            //     /* RelationManagers\AportesExtraordinariosRelationManager::class, */
            //     RelationManagers\AhorrosVistaRelationManager::class,
            //     RelationManagers\AhorrosContractualesRelationManager::class,
            //     RelationManagers\AhorrosTerminoRelationManager::class,
            //     RelationManagers\CuentasCorrientesRelationManager::class,
            //     RelationManagers\CreditosRelationManager::class,
            //     RelationManagers\CreditosCastigadosRelationManager::class,
            //     RelationManagers\RotativosRelationManager::class,
            //     RelationManagers\AvancesRotativoRelationManager::class,
            //     RelationManagers\NovedadesCausadasRelationManager::class,
            //     RelationManagers\NovedadesNoCausadasRelationManager::class,
            // ]),
            // RelationManagers\EstudiosAsociadoRelationManager::class,
            // RelationGroup::make('Información financiera',[
            //     RelationManagers\IngresoAsocRelationManager::class,
            //     RelationManagers\EgresosRelationManager::class
            // ]),
            // RelationGroup::make('Grupo Familiar',[
            //     RelationManagers\BeneficiariosRelationManager::class,
            // ]),
            // RelationManagers\ReferenciasRelationManager::class,
            // RelationGroup::make('Activos fijos',[
            //     RelationManagers\VehiculosAsoRelationManager::class,
            //     RelationManagers\BienesRaizRelationManager::class
            // ]),
            // RelationGroup::make('Servicios sociales',[
            //     RelationManagers\AuxiliosRelationManager::class,
            // ]),
            // RelationManagers\ConsignacionesRelationManager::class,
            // RelationGroup::make('Codeudores',[
            //     RelationManagers\CodeudoresRelationManager::class,
            //     RelationManagers\CodeudoresInvRelationManager::class
            // ]),
            // RelationGroup::make('Atenciones', [
            //     RelationManagers\AtencionRelationManager::class,
            // ]),
            // RelationGroup::make('Registro referidos', [
            //     RelationManagers\ReferidosRelationManager::class,
            // ]),
            // RelationManagers\AutorizadoRelationManager::class,

            
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNits::route('/'),
            'create' => Pages\CreateNit::route('/create'),
            'view' => Pages\ViewNit::route('/{record}'),
            'edit' => Pages\EditNit::route('/{record}/edit'),
        ];
    }    
}
