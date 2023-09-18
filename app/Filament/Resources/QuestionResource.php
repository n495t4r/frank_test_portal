<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Filament\Resources\QuestionResource\RelationManagers;
use App\Models\Category;
use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('content')
                    ->required()
                    ->maxLength(600),
                Forms\Components\TextInput::make('answeroptions')
                    ->helperText('Seperate options with a comma (,). e.g. Paris, France, Nigeria, England')
                    ->required()
                    ->maxLength(600),
                Forms\Components\TextInput::make('answer')
                    ->helperText('Answer must be the exact text found among answer options above e.g. France')
                    ->required()
                    ->maxLength(600),
                Forms\Components\Select::make('section')
                ->options([
                    'a' => 'Section A',
                    'b' => 'Section B',
                    'c' => 'Section C',
                ]),
                Forms\Components\Select::make('category')
                ->options([
                    'math' => 'Mathematics',
                    'english' => 'English',
                    'history' => 'History',
                    'politics' => 'Politics',
                    'science' => 'Science',
                    'geography' => 'Geography',
                ]),
                Forms\Components\Select::make('type')
                ->options([
                    'multiple_choice' => 'Multi-Choice',
                    'true_false' => 'True or False',
                ]),
                Forms\Components\Select::make('assessment_id')
                    ->relationship('assessment', 'title')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->label('Assessment Title')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('description')
                            ->label('Description')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('duration')
                            ->label('assessment duration ')
                            ->required(),
                        Forms\Components\TextInput::make('user_id') //change to Hidden::make('user_id')
                            ->default(Auth::user()->id)
                    ])
                    ->required(),
                    
            ])
            // ->successRedirectUrl(route('posts'))
            ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('content'),
                Tables\Columns\TextColumn::make('assessment.description')
                ->toggleable()
                ->wrap(),
                Tables\Columns\TextColumn::make('type')
                ->toggleable(),
                Tables\Columns\TextColumn::make('category')
                ->toggleable(isToggledHiddenByDefault: false),
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
                
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            // 'posts' => Pages\CreateQuestion::route('/upload'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }    
}
