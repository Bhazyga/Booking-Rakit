<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemilik extends Model
{
    use HasFactory;


    protected $fillable = [
        "jenis",
        "description",
        "email",
        "user_id",
        "name",
        "yearsofexperience",
        "image",
        "location",
        "price",
        "rating"


    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }


}
