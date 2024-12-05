<?php

namespace App\Filament\App\Resources;

use App\Condition;
use Filament\Forms;
use Filament\Tables;
use App\Models\Listing;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\SpatieTagsInput;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\App\Resources\ListingResource\Pages;
use App\Filament\App\Resources\ListingResource\RelationManagers;

class ListingResource extends Resource
{
    protected static ?string $model = Listing::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')
                    ->default(auth()->user()->id),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->hint('Describe the product in brief.')
                    ->required()
                    ->columnSpanFull()
                    ->autosize(),
                SpatieTagsInput::make('tags')
                    // ->type('listings')
                    ->separator(',')
                    ->splitKeys(['Tab', ','])
                    ->rules(['max:5'])
                    ->hint('Press "Tab" or "," to separate'),
                Forms\Components\TextInput::make('stock')
                    ->required()
                    ->default(1)
                    ->numeric(),
                Forms\Components\TextInput::make('purchased_price')
                    ->hint('Should be the same as presented in receipt.')
                    ->required()
                    ->numeric()
                    ->default(0.00)
                    ->prefix('Rs.'),
                Forms\Components\TextInput::make('offer_price')
                    ->hint('Should be less than or equal to Purchased Date')
                    ->required()
                    ->live()
                    ->lte('purchased_price')
                    ->numeric()
                    ->default(0.00)
                    ->prefix('Rs.'),
                Forms\Components\DatePicker::make('purchased_date')
                    ->required()
                    ->native(false)
                    ->firstDayOfWeek(7)
                    ->closeOnDateSelection()
                    ->maxDate(now()),
                Forms\Components\Select::make('condition')
                    ->required()
                    ->options(Condition::class),
                Forms\Components\FileUpload::make('invoice_receipt')
                    ->directory('listings/invoice-receipts')
                    ->image(),
                Forms\Components\FileUpload::make('main_photo')
                    ->directory('listings/photos')
                    ->image()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('purchased_price')
                    ->sortable()
                    ->prefix('Rs. '),
                Tables\Columns\TextColumn::make('offer_price')
                    ->sortable()
                    ->prefix('Rs. '),
                Tables\Columns\TextColumn::make('purchased_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('condition'),
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
            'index' => Pages\ListListings::route('/'),
            'create' => Pages\CreateListing::route('/create'),
            'edit' => Pages\EditListing::route('/{record}/edit'),
        ];
    }
}
