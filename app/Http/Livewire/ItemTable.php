<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\ItemProfile;
use App\Models\SerialNumber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ItemTable extends DataTableComponent
{
    protected $model = SerialNumber::class;

    private $classifications = [
        0 => 'All',
        1 => 'Land',
        2 => 'Buildings',
        3 => 'Office Equipment',
        4 => 'Appliances',
        5 => 'Vehicle'
    ];

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
            'exportSelected' => 'Export',
        ]);
    }

    public function getItemProfile($reference_no): Model
    {
        $item = ItemProfile::where('id', $reference_no)->first();
        return $item;
    }

    // public function filters(): array
    // {
    //     return [
    //         SelectFilter::make('Classification')
    //             ->setFilterPillTitle('Classification')
    //             ->options($this->classifications)->filter(function (Builder $builder, $value) {
    //                 $value == 0 ? '' : ItemProfile::where('classification', $this->classifications[$value]);
    //             })
    //     ];
    // }

    // public function mount()
    // {
    //     $this->setFilter('classification', 3);
    // }

    public function builder(): Builder
    {
        return SerialNumber::query();
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
            Column::make("Inventory Number", "reference_no")
                ->sortable()
                ->format(
                    fn ($value, $row, Column $column) =>
                    "<p class='fw-bold text-start'> {$this->getItemProfile($value)->id} </p>"
                )->html(),
            Column::make("Asset", "reference_no")
                ->sortable()
                ->searchable()
                ->format(
                    fn ($value, $row, Column $column) =>
                    "<h6 class='fw-bold text-start'> {$this->getItemProfile($value)->title} </h6>"
                )->html(),
            Column::make("Classification", "reference_no")
                ->sortable()
                ->searchable()
                ->format(
                    fn ($value, $row, Column $column) =>
                    "<p class='fw-bold text-start'> {$this->getItemProfile($value)->classification} </p>"
                )->html(),
            Column::make('Serial Number', 'serial_no')
                ->sortable()
                ->searchable()
                ->format(
                    fn ($value, $row, Column $column) =>
                    "<p class='fw-bold text-start'> {$value} </p>"
                )->html(),
            Column::make('Created at', 'created_at')
                ->sortable()
                ->format(
                    fn ($value, $row, Column $column) =>
                    "<p class='text-start'> <i>" . Carbon::parse($value)->format('M. d, Y') . "</i> </p>"
                )->html()
        ];
    }
}
