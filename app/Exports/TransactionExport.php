<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransactionExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Transaction::select(['nama_customer', 'ticket_code','tipe','amount','status','harga_ticket','created_by'])->get();

        return $data;
    }
}
