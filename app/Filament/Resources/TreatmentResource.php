<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TreatmentResource\Pages;
use App\Filament\Resources\TreatmentResource\RelationManagers;
use App\Models\Treatment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TreatmentResource extends Resource
{
    protected static ?string $model = Treatment::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'My Treatments';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('medicine_id')
                    ->relationship('medicine', 'name')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('dosage')
                    ->required(),
                Forms\Components\TextInput::make('frequency')
                    ->required()
                    ->numeric(),
                Forms\Components\DateTimePicker::make('start_date')
                    ->required(),
                Forms\Components\DateTimePicker::make('end_date')
                    ->required(),
                Forms\Components\Select::make('vial_type')
                    ->options(array_combine(
                        \App\Models\Treatment::getEnumValues('vial_type'),
                        \App\Models\Treatment::getEnumValues('vial_type')
                    ))
                    ->live()
                    ->required(),
                Forms\Components\TextInput::make('custom_vial_type')
                    ->nullable()
                    ->visible(fn ($get) => $get('vial_type') === 'other') 
                    ->options(array_combine(
                        \App\Models\Treatment::getEnumValues('location'),
                        \App\Models\Treatment::getEnumValues('location')
                    ))
                    ->visible(fn ($get) => $get('vial_type') === 'injection')
                    ->live()
                    ->nullable(),
                Forms\Components\TextInput::make('custom_location')
                    ->nullable()
                    ->visible(fn ($get) => $get('location') === 'other'), 
                Forms\Components\Toggle::make('alternate_route')
                    ->required()
                    ->default(false)
                    ->live(),
                Forms\Components\Select::make('first_route')
                    ->options(array_combine(
                        \App\Models\Treatment::getEnumValues('first_route'),
                        \App\Models\Treatment::getEnumValues('first_route')
                    ))
                    ->visible(fn ($get) => $get('alternate_route') === true)
                    ->nullable(),
                Forms\Components\Toggle::make('notify_feedback')
                    ->required(),
                Forms\Components\Toggle::make('notify_pain')
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('medicine.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dosage')
                    ->searchable(),
                Tables\Columns\TextColumn::make('frequency')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vial_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('custom_vial_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('custom_location')
                    ->searchable(),
                Tables\Columns\IconColumn::make('alternate_route')
                    ->boolean(),
                Tables\Columns\TextColumn::make('first_route')
                    ->searchable(),
                Tables\Columns\IconColumn::make('notify_feedback')
                    ->boolean(),
                Tables\Columns\IconColumn::make('notify_pain')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListTreatments::route('/'),
            'create' => Pages\CreateTreatment::route('/create'),
            'edit' => Pages\EditTreatment::route('/{record}/edit'),
        ];
    }
}
