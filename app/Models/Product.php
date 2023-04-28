<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image',
        'user_id'
    ];

    /* Relationship to table Users โดยอ้างอิง MOdel User */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
