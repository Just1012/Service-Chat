<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function fieldOptions()
    {
        return $this->hasMany(FieldOption::class);
    }
    public function field2()
    {
        return $this->belongsTo(ServiceField::class,'field_id');
    }

    public function fieldType(){
        return $this->hasMany(FieldType::class,'id');
    }
}
