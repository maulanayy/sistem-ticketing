<?php

namespace App\Imports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\ToModel;

class TransactionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Transaction([
            'nama customer' => $row[0],
            'ticket code' => $row[1],
            'tipe' => $row[2],
            'jumlah' => $row[3],
            'harga ticket' => $row[6],
            'di input oleh' => $row[7]
        ]);
    }
}
