<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipodocumento extends Model
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

    protected $table = 'tipo_documento';
    protected $guarded = ['id'];

}
