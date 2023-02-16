<?php

namespace App\Http\Livewire;

use App\Models\ItemProfile;
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
        return ItemProfile::query()->latest();
    }


    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Inventroy Number", "inventory_number")
                ->sortable(),
            Column::make("Asset", "title")
                ->sortable(),
            Column::make("Model", "description")
                ->sortable(),
            Column::make("Classification", "classification")
                ->sortable(),
        ];
    }
}
