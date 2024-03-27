<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codeudor extends Model
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

    protected $table = 'codeudores';
    protected $guarded = ['id'];

    public function creditosCode(){
        return $this->belongsTo(Credito::class, 'nro_documento', 'nro_documento');
    } 
    public function asociadocod(){
        return $this->belongsTo(Nit::class, 'nro_documento_cod','nro_documento');
    }
    public function asociado(){
        return $this->belongsTo(Nit::class, 'nro_documento','nro_documento');
    }
}


