<?php
namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TimesheetResource\Pages;
use App\Models\Timesheet;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TimesheetResource extends Resource
{
    protected static ?string $model = Timesheet::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->required()
                    ->rules('required'),

                DatePicker::make('date')
                    ->required()
                    ->rules('required'),

                TimePicker::make('time_in')
                    ->required()
                    ->rules('required'),

                TimePicker::make('time_out')
                    ->required()
                    ->rules('required'),

                TextInput::make('total_hours_work')
                    ->label('Total Hours of Work')
                    ->numeric()
                    ->required()
                    ->rules('required'),

                TextInput::make('number_of_absent')
                    ->label('Number of Absent')
                    ->numeric()
                    ->required()
                    ->rules('required'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee.name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('date')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('time_in')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('time_out')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('total_hours_work')
                    ->label('Total Hours of Work')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('number_of_absent')
                    ->label('Number of Absent')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ReplicateAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index'  => Pages\ListTimesheets::route('/'),
            'create' => Pages\CreateTimesheet::route('/create'),
            'edit'   => Pages\EditTimesheet::route('/{record}/edit'),
        ];
    }
}
