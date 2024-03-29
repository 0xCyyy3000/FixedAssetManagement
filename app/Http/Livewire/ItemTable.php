<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\SerialNumber;
use App\Exports\ItemProfileExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ItemTable extends DataTableComponent
{
    protected $model = SerialNumber::class;

    private $classifications = [
        '' => 'All',
        'Land' => 'Land',
        'Buildings' => 'Buildings',
        'Office Equipment' => 'Office Equipment',
        'Appliances' => 'Appliances',
        'Vehicle' => 'Vehicle'
    ];

    public bool $dumpFilters = true;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setBulkActionsStatus(true);
        $this->setDefaultSort('id', 'desc');

        $this->setFiltersVisibilityEnabled();
        $this->setFilterPillsEnabled();
        $this->setFilterLayout('slide-down');
        $this->setFilterLayoutPopover();
        $this->setFilterSlideDownDefaultStatusEnabled();

        $this->setBulkActions([
            'print' => 'Print',
            'excel' => 'Export excel',
            'pdf' => 'Export PDF',
        ]);
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Classification')
                ->setFilterPillTitle('Classification')
                ->options($this->classifications)
                ->filter(function (Builder $builder, $classification) {
                    $builder->where('classification', $classification);
                }),
            DateFilter::make('From')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('serial_numbers.created_at', '>=', $value);
                }),
            DateFilter::make('To')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('serial_numbers.created_at', '<=', $value);
                }),
        ];
    }

    public function builder(): Builder
    {
        return SerialNumber::query();
    }

    public function print()
    {
    }

    public function excel()
    {
        $date = date('M. d, Y');
        $items = $this->getSelected();
        $this->clearSelected();
        return Excel::download(new ItemProfileExport($items), "Report {$date}.xlsx");
    }
    public function pdf()
    {
        $date = date('M. d, Y');
        $items = $this->getSelected();
        $this->clearSelected();
        return Excel::download(new ItemProfileExport($items), "Report {$date}.PDF");
    }

    public function columns(): array
    {
        return [
            Column::make("No.", "id")
                ->sortable()
                ->format(
                    fn ($value, $row, Column $column) =>
                    "<p class='fw-bold text-start'> {$value} </p>"
                )->html(),
            Column::make("Inventory Number", "profile.inventory_number")
                ->sortable()
                ->format(
                    fn ($value, $row, Column $column) =>
                    "<p class='fw-bold text-start'> {$value} </p>"
                )->html(),
            Column::make("Asset", "profile.title")
                ->sortable()
                ->searchable()
                ->format(
                    fn ($value, $row, Column $column) =>
                    "<h6 class='fw-bold text-start'> {$value} </h6>"
                )->html(),
            Column::make("Classification", "profile.classification")
                ->sortable()
                ->searchable()
                ->format(
                    fn ($value, $row, Column $column) =>
                    "<p class='fw-bold text-start'> {$value} </p>"
                )->html(),
            Column::make('Serial Number', 'serial_no')
                ->sortable()
                ->searchable()
                ->format(
                    fn ($value, $row, Column $column) =>
                    "<p class='fw-bold text-start'> {$value} </p>"
                )->html(),
            Column::make('Condition', 'condition')
                ->sortable()
                ->searchable()
                ->format(
                    fn ($value, $row, Column $column) =>
                    "<p class='fw-bold text-start'> {$value} </p>"
                )->html(),
            Column::make('Color', 'color')
                ->sortable()
                ->searchable()
                ->format(
                    fn ($value, $row, Column $column) =>
                    "<p class='fw-bold text-start'> {$value} </p>"
                )->html(),
            Column::make('Warranty', 'warranty')
                ->sortable()
                ->searchable()
                ->format(
                    fn ($value, $row, Column $column) =>
                    "<p class='fw-bold text-start'> {$value} </p>"
                )->html(),
            Column::make('Price', 'price')
                ->sortable()
                ->searchable()
                ->format(
                    fn ($value, $row, Column $column) =>
                    "<p class='fw-bold text-start'> {$value} </p>"
                )->html(),
            Column::make('Supplier', 'supplier')
                ->sortable()
                ->searchable()
                ->format(
                    fn ($value, $row, Column $column) =>
                    "<p class='fw-bold text-start'> {$value} </p>"
                )->html(),
            Column::make('Contact Number', 'contact_no')
                ->sortable()
                ->searchable()
                ->format(
                    fn ($value, $row, Column $column) =>
                    "<p class='fw-bold text-start'> {$value} </p>"
                )->html(),
            Column::make('Date', 'date')
                ->sortable()
                ->format(
                    fn ($value, $row, Column $column) =>
                    "<p class='text-start'> <i>" . Carbon::parse($value)->format('M. d, Y') . "</i> </p>"
                )->html()
        ];
    }
}
