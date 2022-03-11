<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'log_sheet_id',
        'invoice_no',
        'date',
        'client_id',
        'gross_weight',
        'no_of_packs',
    ];

    public function logSheet()
    {
        return $this->belongsTo(LogSheet::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function clientUser(){
        return $this->hasOneThrough(User::class, Client::class, 'id', 'id', 'client_id', 'user_id');
    }
}
