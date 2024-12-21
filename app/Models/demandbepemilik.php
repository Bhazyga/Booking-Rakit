<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class demandbepemilik extends Model
{
    use HasFactory;

    protected $fillable = [

        "jenis",
        "name",
        "email",
        "description",
        "image",
        "location",
        "price",
        "yearsofexperience",
        "pemilik_id",
        "status",


    ];

    public function user(){
        return $this->belongsTo(User::class, 'pemilik_id');
    }


}
