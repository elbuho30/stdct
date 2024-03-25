<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\{Transaporsocext,Transahovist,
  //   CrmTransAhoVist, CrmTransAhoContr, CrmTransAhoTerm,CrmTransCuentasCorr, CrmTransCred
    };
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class ModalTransaccion extends Component implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $recordId;
    public $model;

    public function mount($id, $model) {
        $this->recordId = $id;
        $this->model = $model;
    }

    protected function getTableQuery()
    {

        switch ($this->model){
            case 'aportes_social':
                return Transaporsocext::where('crm_ahorro_id', $this->recordId)->orderBY('fecha_transaccion','desc');
                break;
            // case 'aportes_extra':
            //     return CrmTransAporExtr::where('crm_ahorro_id', $this->recordId);
            //     break;
            case 'ahorros_vista':
                return Transahovist::where('crm_ahorro_id', $this->recordId)->orderBY('fecha_transaccion','desc');
                break;
            // case 'ahorros_contractuales':
            //     return CrmTransAhoContr::where('crm_ahorro_id', $this->recordId);
            //     break;
            // case 'ahorros_termino':
            //     return CrmTransAhoTerm::where('crm_ahorro_id', $this->recordId);
            //     break;
            // case 'cuentas_corrientes':
            //     return CrmTransCuentasCorr::where('crm_ahorro_id', $this->recordId);
            //     break;
            // case 'creditos':
            //     return CrmTransCred::where('nro_cuenta', $this->recordId);
            //     break;

        }

    }



    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('agenciaTrans.nombre_agencia')
            ->label('Agencia'),
            TextColumn::make('fecha_transaccion')
            ->label('Fecha')
            ->formatStateUsing(function ($state){
                #dd($state);
                #$fecha = \DateTime::createFromFormat('M d Y h:i:s:A',$state);

                /* if($fecha){
                    $fechaSTR = $fecha->format('Y-m-d');
                    return $fechaSTR;
                } */
                #$fechaSTR = strtotime($state);
                #return date('Y-m-d',$fechaSTR);
                return $state;
            }),
            TextColumn::make('documento_contable')
            ->label('Documento'),
            TextColumn::make('tipo_transaccion')
            ->label('Tipo'),
            TextColumn::make('valor_efectivo')
            ->label('Val. efectivo')
            ->formatStateUsing(fn($state)=>number_format($state))
            ->prefix('$'),
            TextColumn::make('valor_cheque')
            ->label('Val. cheque')
            ->formatStateUsing(fn($state)=>number_format($state))
            ->prefix('$'),
            TextColumn::make('descripcion')
            //->limit(70)
            ->wrap()
            ->label('Descripción'),
        ];
    }

    public function render()
    {
        return view('livewire.modal-transaccion');
    }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [10, 25, 50, 100];
    }

}
