<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiAdvice extends Model
{
    use HasFactory;

    protected $fillable=['user_id','symtoms_used','advice'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
