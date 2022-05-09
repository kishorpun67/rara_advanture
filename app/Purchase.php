<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function ingredientCategory()
    {
        return $this->belongsTo('App\IngredientCategory', 'ingredient_id');
    }

    public function ingredientUnit()
    {
        return $this->belongsTo('App\IngredientUnit', 'unit_id');
    }

    public function supplierName()
    {
        return $this->belongsTo('App\Supplier', 'supplier_id');
    }
}
