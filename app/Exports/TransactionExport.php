<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransactionExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $date_start,$date_end;

    function __construct($date_start,$date_end) {
            $this->date_start = $date_start;
            $this->date_end = $date_end;
    }
    public function collection()
    {
        $data = Transaction::whereBetween('created_at',[$this->date_start,$this->date_end])
        ->select(['nama_customer', 'ticket_code','tipe','amount','status','harga_ticket','created_by'])->get();

        return $data;
    }
}
