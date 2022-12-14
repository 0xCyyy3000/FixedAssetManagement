<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{
    use HasFactory;
    protected $fillable=[
         'transaction_number','purchase_date', 'purchase_price', 'inventory_number', 'serial_number', 'type','classification','lifespan', 'department', 'quantity','annual_operating_cost', 'year', 'replacement_value', 'title','trade_in_value','body','present_value', 'comments', 'notes' 
    ];
}

