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
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\View;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\HtmlString;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class NovedadesnocausadasRelationManager extends RelationManager
{
    protected static string $relationship = 'novedadesNoCausadas';
    protected static ?string $pluralLabel = 'Novedades varias no causadas';
    protected static ?string $label = 'Novedades varias no causadas';
    protected static ?string $title = 'Novedades varias no causadas';

    protected static ?string $recordTitleAttribute = 'nro_documento';

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
            TextColumn::make('id_novedad')->label('Id Novedad'),
            TextColumn::make('nombre_novedad')->label('Descripción'),
            TextColumn::make('cta_contable')->label('Cta. Contable'),
            TextColumn::make('fecha_inicio')
            ->formatStateUsing(function($state) {
                $fecha = \DateTime::createFromFormat('M d Y h:i:s:A',$state);
                if($fecha){
                    $fechaSTR = $fecha->format('Y-m-d');
                    return $fechaSTR;
                }

                $fechaSTR = strtotime($state);
                return date('Y-m-d',$fechaSTR);
            }),
            TextColumn::make('saldo')
            ->formatStateUsing(fn($state) => number_format($state))
            ->prefix('$'),
            TextColumn::make('cuota')
            ->formatStateUsing(fn($state) => number_format($state))
            ->prefix('$'),
            TextColumn::make('estado')
            ->formatStateUsing(function($state) {
                if($state == 'A'){
                    return 'Activo';
                }
                return "Inactivo";
            }),
        ]),
        ])
            ->filters([
                //
            ])
            ->headerActions([
              //  Tables\Actions\CreateAction::make(),
            ])
            ->actions([
            //    Tables\Actions\EditAction::make(),
            //    Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
              //  Tables\Actions\BulkActionGroup::make([
              //      Tables\Actions\DeleteBulkAction::make(),
              //  ]),
            ])
            ->emptyStateActions([
             //   Tables\Actions\CreateAction::make(),
            ]);
    }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [10, 25, 50, 100];
    }

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        if($ownerRecord->novedadesNoCausadas->count() == 0){
            return false;
        }
        return true;
    }
}
