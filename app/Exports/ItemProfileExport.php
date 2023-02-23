<?php

namespace App\Exports;

use App\Models\ItemProfile;
use App\Models\SerialNumber;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ItemProfileExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    private $ids;

    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    public function view(): View
    {
        $to_export = array();

        foreach ($this->ids as $id) {
            $serial = SerialNumber::join('item_profiles', 'item_profiles.id', '=', 'serial_numbers.reference_no')
                ->where('serial_numbers.id', $id)->first([
                    'serial_numbers.*', 'serial_numbers.id as serial_id', 'serial_numbers.created_at as serial_date',
                    'item_profiles.*', 'item_profiles.id as profile_id'
                ]);
            $serial->serial_date = Carbon::parse($serial->serial_date)->format('M. d, Y');
            array_push($to_export, $serial);
        }

        // dd($to_export);

        return view('exports.excel-item-table', ['items' => $to_export]);
    }
}
