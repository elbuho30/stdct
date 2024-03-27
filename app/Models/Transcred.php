<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transcred extends Model
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

    protected $table = 'trans_cred';
    protected $guarded = ['id'];

    public function agencia(){
        return $this->belongsTo(Agencia::class, 'id_agencia','id');
    }
    public function agenciaTrans(){
        return $this->belongsTo(Agencia::class, 'id_agencia_transaccion','id');
    }
}
