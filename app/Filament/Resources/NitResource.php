<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NitResource\Pages;
use App\Filament\Resources\NitResource\RelationManagers;
use App\Models\Nit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\MoneyField;
use Filament\Support\RawJs;
use Filament\Actions;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;

#relation manager
use Filament\Resources\RelationManagers\RelationGroup;

#Form
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\{ViewField, TextInput, Select, DatePicker, DateTimePicker};

class NitResource extends Resource
{
    protected static ?string $model = Nit::class;

    protected static ?string $modelLabel = 'Asociado';
    protected static ?string $navigationGroup = 'Datos';
    protected static ?string $navigationIcon = 'feathericon-users';
    protected static ?string $navigationLabel = 'Asociados';
    protected static ?int $navigationSort = 1;
    protected static ?string $pluralModelLabel = 'Asociado';
    protected static ?string $slug = 'datos';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                    ->schema([
                        ViewField::make('id')
                            ->view('livewire.nits.associate-head')
                            ->columnSpanFull(),
                    ]),
                Tabs::make('more_info')
                    ->columnSpanFull()
                    ->tabs([
                        Tabs\Tab::make('Datos Personales')
                            ->schema([
                                Grid::make()
                                    ->schema([
                                        Select::make('tipo_identificacion')
                                            ->relationship('tipoDocumento', 'nombre_tipo_doc')
                                            ->label('Tipo documento')
                                            ->disabled(),
                                        TextInput::make('nro_documento')
                                            ->label('Nro. Documento')
                                            ->disabled(),
                                        DatePicker::make('fecha_exp_documento')
                                            ->label('Fecha expedición documento')
                                            ->disabled()
                                            ->native(false)
                                            ->displayFormat('d/m/Y'),
                                        select::make('id_pais_documento')
                                            ->label('País expedición documento')
                                            ->relationship('paisExpedicion', 'nombre_pais')
                                            ->disabled(),
                                        Select::make('id_pd_documento')
                                            ->label('Departamento expedición documento')
                                            ->relationship('departamentoExpedicion', 'nombre_departamento')
                                            ->disabled('disabled'),
                                        Select::make('id_pdc_documento')
                                            ->label('Ciudad expedición documento')
                                            ->relationship('ciudadExpedicion', 'nombre_ciudad')
                                            ->disabled(),
                                        DatePicker::make('fecha_nace')
                                            ->label('Fecha nacimiento')
                                            ->disabled()
                                            ->displayFormat('d/m/Y'),
                                        select::make('id_pais_nace')
                                            ->label('País nacimiento')
                                            ->relationship('paisNacimiento', 'nombre_pais')
                                            ->disabled(),
                                        Select::make('id_pd_nace')
                                            ->label('Departamento nacimiento')
                                            ->relationship('departamentoNacimiento', 'nombre_departamento')
                                            ->disabled('disabled'),
                                        Select::make('id_pdc_nace')
                                            ->label('Ciudad nacimiento')
                                            ->relationship('ciudadNacimiento', 'nombre_ciudad')
                                            ->disabled('disabled'),
                                    ])->columns([
                                        // 'default' =>3,
                                        'sm' => 1,
                                        'md' => 3,
                                        'lg' => 4,
                                        'xl' => 4,
                                    ]),

                            ]),
                        Tabs\Tab::make('Contacto')
                            ->schema([
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('telefono1')
                                            ->label('Teléfono')
                                            ->disabled(),
                                        TextInput::make('celular')
                                            ->label('Celular')
                                            ->disabled(),
                                        TextInput::make('email')
                                            ->label('Email')
                                            ->disabled()
                                            ->email(),
                                        TextInput::make('direccion1')
                                            ->label('Dirección')
                                            ->disabled(),
                                        Select::make('id_pais_reside')
                                            ->label('País residencia')
                                            ->relationship('paisResidencia', 'nombre_pais')
                                            ->disabled(),
                                        Select::make('id_dep_reside')
                                            ->label('Departamento residencia')
                                            ->relationship('departamentoResidencia', 'nombre_departamento')
                                            ->disabled(),
                                        Select::make('id_ciudad_reside')
                                            ->label('Ciudad residencia')
                                            ->relationship('ciudadResidencia', 'nombre_ciudad')
                                            ->disabled(),
                                        Select::make('zona_ubicacion')
                                            ->options([
                                                'U' => 'Urbano',
                                                'R' => 'Rural'
                                            ])
                                            ->label('Zona ubicación')
                                            ->disabled(),
                                        TextInput::make('tiempo_en_ciudad')
                                            ->label('Tiempo en ciudad')
                                            ->disabled(),
                                    ]),
                            ]),
                        Tabs\Tab::make('Afiliación')
                            ->schema([
                                Grid::make()
                                    ->schema([
                                        Select::make('id_tipo_vinculo')
                                            ->options([
                                                1 => 'ASOCIADO',
                                                2 => 'EXASOCIADO',
                                                3 => 'PROVEEDOR',
                                                4 => 'ENTIDAD FINANCIERA',
                                                5 => 'TERCERO - CODEUDOR - BENEFICIARIO',
                                            ])
                                            ->label('Vínculo')
                                            ->disabled(),
                                            TextInput::make('saldo_aportes')
                                            ->label('Saldo aportes')
                                            ->currencyMask(thousandSeparator: ',',decimalSeparator: '.',precision: 2)
                                            ->prefix('$'),
                                            Select::make('id_agencia')
                                            ->label('Agencia')
                                            ->relationship('agencia','nombre_agencia')
                                            ->disabled(),
                                        DatePicker::make('fecha_ingreso')
                                            ->label('Fecha ingreso')
                                            ->disabled()
                                            ->displayFormat('d/m/Y'),
                                        DateTimePicker::make('fecha_ult_actualizacion_datos')
                                            ->label('Fecha últ. Actualización')
                                            ->disabled()
                                            ->columnSpan(2 )
                                            ->displayFormat('d/m/Y h:i:s a'),
                                        DatePicker::make('fecha_retiro')
                                            ->label('Fecha retiro')
                                            ->disabled()
                                            ->displayFormat('d/m/Y'),
                                    ])->columns([
                                        // 'default' =>3,
                                        'sm' => 1,
                                        'md' => 3,
                                        'lg' => 4,
                                        'xl' => 4,
                                    ]),
                            ]),
                    ])->columns(2),
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
                Tables\Actions\ViewAction::make(),
                //Tables\Actions\ActionGroup::make([
                    // Tables\Actions\EditAction::make(),
                    // Tables\Actions\DeleteAction::make(),
                    // Tables\Actions\ForceDeleteAction::make(),
                   // Tables\Actions\RestoreAction::make(),
                //])->color('info')
               //     ->icon('heroicon-s-cog-6-tooth')
               //     ->tooltip('Acciones')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                   // Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()->label('Exportar a Excel'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
                                RelationGroup::make('Aportes',[
                                    RelationManagers\AportessocialesunionRelationManager::class,
                                //     /* RelationManagers\AportesExtraordinariosRelationManager::class, */
                                //     RelationManagers\AhorrosVistaRelationManager::class,


                                //     RelationManagers\CuentasCorrientesRelationManager::class,

                                //     RelationManagers\CreditosCastigadosRelationManager::class,
                                //     RelationManagers\RotativosRelationManager::class,
                                //     RelationManagers\AvancesRotativoRelationManager::class,
                                //     RelationManagers\NovedadesCausadasRelationManager::class,
                                //     RelationManagers\NovedadesNoCausadasRelationManager::class,
                                ])->icon('heroicon-o-currency-dollar'),
                                RelationGroup::make('Ahorros',[
                                    RelationManagers\AhorrosVistaRelationManager::class,
                                    RelationManagers\AhorrosContractualesRelationManager::class,
                                    RelationManagers\AhorrosTerminoRelationManager::class,
                                ])->icon('heroicon-o-currency-dollar'),
                                RelationGroup::make('Créditos',[
                                    RelationManagers\CreditosRelationManager::class,
                                ])->icon('heroicon-o-hand-thumb-up'),
                                RelationGroup::make('Novedades',[
                                    RelationManagers\NovedadesnocausadasRelationManager::class,
                                ])->icon('heroicon-o-star'),

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
            // 'edit' => Pages\EditNit::route('/{record}/edit'),
        ];
    }
}
