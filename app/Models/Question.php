<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id', 'section', 'category', 'content', 'type', 'answeroptions', 'answer'
    ];

    public function assessment(): BelongsTo{
        return $this->belongsTo(Assessment::class);
    }
}
