<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'duration','user_id'
    ];

    public function question(): HasMany {
        return $this->hasMany(Question::class);
    }
}
