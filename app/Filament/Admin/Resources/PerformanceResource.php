<?php
namespace App\Filament\Admin\Resources;

use App\Enum\DepartmentEnum;
use App\Enum\PerformanceReviewStatus;
use App\Filament\Admin\Resources\PerformanceResource\Pages;
use App\Models\Performance;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PerformanceResource extends Resource
{
    protected static ?string $model = Performance::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->required(),

                Select::make('department')
                    ->options(DepartmentEnum::toOptions())
                    ->required(),

                TextInput::make('total_hours_work')
                    ->numeric()
                    ->required(),

                Select::make('performance_review')
                    ->options(PerformanceReviewStatus::toOptions())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee.name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('jobPosition.title')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('department')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('total_hours_work')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('performance_review')
                    ->label('Performance Review')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->colors([
                        'success' => 'Outstanding',
                        'primary' => 'Exceeds Expectations',
                        'info'    => 'Meets Expectations',
                        'warning' => 'Needs Improvement',
                        'danger'  => 'Unsatisfactory',
                        'gray'    => null, // fallback
                    ]),
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
            'index'  => Pages\ListPerformances::route('/'),
            'create' => Pages\CreatePerformance::route('/create'),
            'edit'   => Pages\EditPerformance::route('/{record}/edit'),
        ];
    }
}
