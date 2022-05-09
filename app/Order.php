<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function ingredientCategory()
    {
        return $this->belongsTo('App\Waiter', 'waiter_id');
    }

    public function Customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
    public function Table()
    {
        return $this->belongsTo('App\Table', 'table_id');
    }
}
