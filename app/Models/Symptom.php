<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    /** @use HasFactory<\Database\Factories\SymptomFactory> */
    use HasFactory;

    protected $fillable = [
        'name' ,
        'severity',
        'description' ,
        'date_recorded' ,
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
