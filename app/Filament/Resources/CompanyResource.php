<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $label = 'Company';
    protected static ?string $pluralLabel = 'Company';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                ->columns(1)
                ->schema([
                    Forms\Components\TextInput::make("nama")
                        ->required()
                        ->placeholder("Nama"),
                    Forms\Components\TextInput::make("ip_internal")
                        ->required()
                        ->placeholder("ex: 192.168.1.1"),
                    Forms\Components\Textarea::make("keterangan")
                        ->placeholder("Keterangan"),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("nama")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("ip_internal")
                    ->searchable()
                    ->label("IP Internal")
                    ->sortable(),
                Tables\Columns\TextColumn::make("keterangan")
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCompanies::route('/'),
        ];
    }
}
