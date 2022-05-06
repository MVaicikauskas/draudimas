<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'topic',
        'type',
        'additional_info',
        'consultation_date',
    ];

    public function user(){
        return $this->belongsTo(Consultation::class);
    }
}
