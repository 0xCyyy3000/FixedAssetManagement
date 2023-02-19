<?php

namespace App\Http\Livewire;

use App\Models\ItemProfile;
use App\Models\SerialNumber;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class ItemTable extends DataTableComponent
{
    protected $model = ItemProfile::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return ItemProfile::with('serialNumbers')->latest();
    }

    public function getSerial($id): string
    {
        $serial = SerialNumber::where('reference_no', $id)->first()->serial_no;
        return $serial;
    }

    public function columns(): array
    {
        return [
            Column::make("No.", "id")
                ->sortable(),
            Column::make("Inventory Number", "inventory_number")
                ->sortable(),
            Column::make("Asset", "title")
                ->sortable()
                ->searchable(),
            Column::make("Model", "description")
                ->sortable(),
            Column::make("Classification", "classification")
                ->sortable(),
            Column::make('Serial Number')
                ->sortable()
                ->searchable()
                ->format(function ($row, Column $column) {
                    return $row->serial_no . ' <small class="fw-semibold"> ( ' . $this->getSerial($row->serial_no) . ')</small>';
                })
                ->html(),
        ];
    }
}
