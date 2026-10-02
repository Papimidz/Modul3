<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'category_id',
        'code',
        'title',
        'description',
        'activity_date',
        'category',
        'start_at',
        'end_at',
        'location',
        'capacity',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'activity_date' => 'date',
            'start_at' => 'datetime',
            'end_at' => 'datetime',
            'capacity' => 'integer',
        ];
    }

    public const STATUSES = [
        'draft',
        'published',
        'completed',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
