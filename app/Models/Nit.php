<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nit extends Model
{
    public function getDateFormat()
    {
        $database = env('DB_CONNECTION');

        $date_format = parent::getDateFormat();
        if ($database == 'sqlsrv') 
            $date_format = 'Ymd H:i:s';

        return $date_format;
    }
    
    use HasFactory;

    protected $table = 'nits';
    protected $guarded = ['id'];

    // RELATIONS
    public function agencia(){
        return $this->belongsTo(Agencia::class, 'id_agencia','id');
    }

    public function banco(){
        return $this->belongsTo(CrmBanco::class, 'id_banco', 'id');
    } 

    public function aportesSociales(){
        return $this->hasMany(CrmAportesSociales::class, 'nro_documento', 'nro_documento' );
    }

    public function ahorrosVista(){
        return $this->hasMany(CrmAhorrosVista::class, 'nro_documento', 'nro_documento');
    }

    public function ahorrosContractuales(){
        return $this->hasMany(CrmAhorrosContractual::class, 'nro_documento', 'nro_documento');
    }

    public function ahorrosTermino(){
        return $this->hasMany(CrmAhorrosTermino::class, 'nro_documento', 'nro_documento');
    }

    public function aportesExtraordinarios(){
        return $this->hasMany(CrmAportesExtraordinarios::class, 'nro_documento', 'nro_documento');
    }

    public function cuentasCorrientes(){
        return $this->hasMany(CrmCuentasCorrientes::class, 'nro_documento', 'nro_documento');
    }  

    public function creditos(){
        return $this->hasMany(CrmCreditos::class, 'nro_documento', 'nro_documento');
    } 

    public function creditosCastigados(){
        return $this->hasMany(CrmCreditosCastigados::class, 'nro_documento', 'nro_documento');
    } 

    public function rotativos(){
        return $this->hasMany(CrmCuposRotativos::class, 'nro_documento', 'nro_documento');
    }

    public function avancesRotativo(){
        return $this->hasMany(CrmAvancesRotativo::class, 'nro_documento','nro_documento');
    }

    public function novedadesCausadas(){
        return $this->hasMany(CrmNovedadesCausadas::class, 'nro_documento', 'nro_documento');
    }

    public function novedadesNoCausadas(){
        return $this->hasMany(CrmNovedadesVariasNoCausadas::class, 'nro_documento', 'nro_documento');
    }

    public function estudiosAsociado(){
        return $this->hasMany(CrmEstudios::class, 'nro_documento','nro_documento');
    }

    public function beneficiarios(){
        return $this->hasMany(CrmBeneficiarios::class, 'nro_documento_asociado', 'nro_documento');
    }

    public function referidos(){
        return $this->hasMany(CrmReferidos::class, 'nro_documento','nro_documento');
    }

    public function vehiculosAso(){
        return $this->hasMany(CrmVehiculos::class, 'nro_documento','nro_documento');
    }

    public function bienesRaiz(){
        return $this->hasMany(CrmBienesRaiz::class, 'nro_documento', 'nro_documento');
    }

    public function auxilios(){
        return $this->hasMany(CrmAuxiliosAsociados::class, 'nro_documento', 'nro_documento');
    }

    public function consignaciones(){
        return $this->hasMany(CrmConsignacionesReportadas::class,'nro_documento', 'nro_documento');
    }

    public function codeudores(){
        return $this->hasMany(CrmCodeudores::class, 'nro_documento','nro_documento');
    }

    public function codeudoresInv(){
        return $this->hasMany(CrmCodeudores::class, 'nro_documento_cod','nro_documento');
    }

    public function referencias(){
        return $this->belongsTo(CrmReferencias::class, 'nro_documento','nro_documento');
    }

    public function autorizado(){
        return $this->hasMany(CrmAutorizadosAhorros::class, 'nro_documento', 'nro_documento');
    }

    public function atencion(){
        return $this->hasMany(RegistroAtenciones::class, 'id_asociado','id');
    }

    public function ingresoAsoc(){
        return $this->belongsTo(CrmIngresosAsociados::class, 'nro_documento','nro_documento');
    }
    
    public function egresos(){
        return $this->hasMany(CrmEgresosAsociados::class, 'nro_documento', 'nro_documento');
    }


    public function tipoDocumento(){
        return $this->belongsTo(Tipodocumento::class, 'tipo_identificacion','id');
    }
    public function ciudadExpedicion(){
        return $this->belongsTo(Ciudad::class, 'id_pdc_documento', 'id_pdc');
    }

    public function paisExpedicion(){
        return $this->belongsTo(Pais::class, 'id_pais_documento', 'id_pais');
    }

    public function departamentoExpedicion()
    {
        return $this->belongsTo(Departamento::class, 'id_pd_documento', 'id_pd');
    }

    public function paisNacimiento()
    {
       return $this->belongsTo(Pais::class, 'id_pais_nace', 'id_pais');
    }

    public function paisResidencia()
    {
        return $this->belongsTo(Pais::class, 'id_pais_reside', 'id_pais');
    }

    public function ciudadNacimiento(){
        return $this->belongsTo(Ciudad::class, 'id_pdc_nace', 'id_pdc');
    }

    public function ciudadResidencia()
    {
        return $this->belongsTo(Ciudad::class, 'id_ciudad_reside', 'id_ciudad');
    }

    public function departamentoNacimiento()
    {
        return $this->belongsTo(Departamento::class, 'id_pd_nace', 'id_pd');
    }

    public function departamentoResidencia()
    {
        return $this->belongsTo(Departamento::class, 'id_dep_reside', 'id_departamento');
    }

    public function conyugues(){
        return $this->belongsTo(CrmConyugues::class, 'nro_documento', 'nro_documento');
    }

    public function estadoCivil()
    {
        return $this->belongsTo(CrmEstadoCivil::class, 'id_estado_civil', 'id');
    }

    public function profesion()
    {
        return $this->belongsTo(CrmProfesion::class, 'id_profesion', 'id');
    }

    public function nivelEducativo()
    {
        return $this->belongsTo(CrmNivelEducativo::class, 'id_nivel_educativo', 'id');
    }

    public function empresaPagadora()
    {
        return $this->belongsTo(CrmEmpresasPagadoras::class, 'id_empresa_pagadora', 'id');
    }

    public function empresaLabora()
    {
        return $this->belongsTo(CrmEmpresasLabora::class, 'id_empresa_labora', 'id');
    }

    public function segmentoMercado(Type $var = null)
    {
        return $this->belongsTo(CrmSegmentosMercado::class, 'id_segmento_mercado', 'id');
    }

    public function ciiu(Type $var = null)
    {
        return $this->belongsTo(CrmCiiu::class , 'id_ciiu' ,'id');
    }

    public function divisionCiiu(Type $var = null)
    {
        return $this->belongsTo(CrmDivisionCiiu::class, 'id_division_ciiu', 'id');
    }
    
    public function tipoContrato(Type $var = null)
    {
        return $this->belongsTo(CrmTipoContrato::class, 'id_tipo_contrato', 'id');
    }

    public function cuposCredito(){
        return $this->hasMany(CupoCreditos::class, 'nro_documento', 'nro_documento');
    }

    public function zonaUbicacion(){
        return $this->belongsTo(CrmZonasUbicacion::class, 'id_pdcz_reside', 'id_pdcz');
    }  

    public function barrioUbicacion(){
        return $this->belongsTo(CrmBarriosUbicacion::class, 'id_pdczcb_reside', 'id_pdczcb');
    }

    public function cargoAsociado(){
        return $this->belongsTo(CrmProfesion::class, 'id_cargo','id');
    }

    public function egresoAsociado(){
        return $this->belongsTo(CrmEgresosAsociado::class, 'nro_documento','nro_documento');
    }

    public function datosAsesor(){
        return $this->belongsTo(CrmUsuarios::class, 'id_usuario_actualiza_datos', 'user_id');
    }
}
