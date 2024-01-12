<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Model;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Usuarios';
    protected static ?string $title = 'Usuarios';
    protected static ?string $label = 'Usuario';
    protected static ?string $navigationGroup = 'Filament Shield';
    protected static ?int $navigationSort = 95;
    protected static ?string $slug = 'usuarios';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('Nombre completo')
                ->required(),

                TextInput::make('email')
                ->label('Correo electrónico')
                ->required()
                ->email(),

                TextInput::make('password')
                ->label('Contraseña')
                ->password()
                ->required()
                ->minLength(8)
                ->same('passwordConfirmation')
                ->dehydrateStateUsing(fn($state) => bcrypt($state))
                ->hidden(function (?Model $record) {
                    return $record;
                }),


                TextInput::make('passwordConfirmation')
                ->label('Confirmar contraseña')
                ->password()
                ->required()
                ->minLength(8)
                ->dehydrateStateUsing(fn($state) => bcrypt($state))
                ->hidden(function (?Model $record) {
                    return $record;
                }),

                MultiSelect::make('roles')
                            ->required()
                            ->label('Roles')
                            ->relationship('roles', 'name')
                            ->preload(),

                Select::make('id_agencia')
                ->required()
                ->label('Agencia')
                ->relationship('agencias', 'nombre_agencia')
                ->preload(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('Nombre')
                ->searchable()
                ->sortable(),

                TextColumn::make('nro_documento')
                ->label('Documento')
                ->searchable()
                ->sortable(),

                TextColumn::make('email')
                ->label('Correo electrónico'),

                TagsColumn::make('roles.name')->label('Roles')
                ->separator('-'),

                TextColumn::make('agencias.nombre_agencia')
                ->label('Agencia'),

                TextColumn::make('id_user_opa')
                ->label('User opa'),
        ])
            ->filters([
                // Filter::make('name')
                // ->label('Nombre')
                //     ->form([
                //         Forms\Components\TextInput::make('name'),
                //     ])
                //     ->query(function (Builder $query, array $data): Builder {
                //         return $query
                // ->when(
                // $data['name'],
                // fn (Builder $query, $data): Builder => $query->where('name', 'LIKE', $data.'%'),
                // );
                // })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
           // 'profile' => Pages\Profile::route('/edit-account-info')
            // 'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
