<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'value',
        'description'
    ];

    public function attributes(){
        $attributes = [];
        $attributesQuery = Attribute::where('product_id',$this->id)->get();

        foreach($attributesQuery as $a){
            
            if(!isset($attributes[$a->type])){
                $attributes[$a->type] = [];    
            }

            $attributes[$a->type][] = $a->name;
        }

        return $attributes;
    }
}
