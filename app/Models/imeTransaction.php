<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class imeTransaction extends Model
{
    protected $fillable = [
        'MerchantCode', 'TranAmount', 'RefId', 'TokenId', 'TransactionId', 'Msisdn', 'TranStatus',
        'StatusDetail', 'SpecialStatus', 'RequestDate', 'ResponseDate'
    ];
}
