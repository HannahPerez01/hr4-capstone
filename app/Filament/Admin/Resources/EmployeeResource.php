<?php
namespace App\Filament\Admin\Resources;

use App\Enum\CivilStatusEnum;
use App\Enum\DepartmentEnum;
use App\Enum\EmployeeGenderEnum;
use App\Enum\EmployeeStatusEnum;
use App\Enum\EmploymentTypeEnum;
use App\Filament\Admin\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('employee_code')
                    ->required(),

                TextInput::make('name')
                    ->required(),

                Select::make('gender')
                    ->options(EmployeeGenderEnum::toOptions())
                    ->required(),

                Select::make('civil_status')
                    ->options(CivilStatusEnum::toOptions())
                    ->required(),

                TextInput::make('age')
                    ->numeric()
                    ->required(),

                TextInput::make('email')
                    ->email()
                    ->unique('employees', 'email', ignoreRecord: true)
                    ->required(),

                TextInput::make('present_address')
                    ->required(),

                Select::make('job_position_id')
                    ->relationship('jobPosition', 'title')
                    ->required(),

                Select::make('department')
                    ->options(DepartmentEnum::toOptions())
                    ->required(),

                Select::make('employment_type')
                    ->options(EmploymentTypeEnum::toOptions())
                    ->required(),

                DatePicker::make('date_hired')
                    ->required(),

                Select::make('status')
                    ->options(EmployeeStatusEnum::toOptions())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee_code')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('age')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('gender')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('civil_status')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('present_address')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('jobPosition.title')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('department')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('employment_type')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('date_hired')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('status')
                    ->sortable()
                    ->searchable(),
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
            'index'  => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit'   => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
