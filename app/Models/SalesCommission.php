<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\BelongsToCompany;
class SalesCommission extends Model
{
    use BelongsToCompany;
    protected $table = "sales_commission_view";
    public $incrementing = false;
    public $timestamps = false;

    public function scopeGetColumns()
    {
        return [
            'company',
            'seller',
            'client',
            'city',
            'state',
            'sold_at',
            'status',
            'total_amount',
            'commission'
        ];
    }
}
