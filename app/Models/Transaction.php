<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'nama_customer', 'ticket_code','tipe','amount','amount_scanned','status','harga_ticket','created_by'
    ];
}
