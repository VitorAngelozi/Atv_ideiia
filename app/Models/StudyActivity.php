<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StudyActivity extends Model
{
    protected $fillable = [
        'title',
        'description',
        'discipline',
        'due_date',
        'priority',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'due_date' => 'date',
        ];
    }

    public function scopeWithStatus(Builder $query, ?string $status): Builder
    {
        return $query->when($status, fn (Builder $query) => $query->where('status', $status));
    }

    public function scopeWithDiscipline(Builder $query, ?string $discipline): Builder
    {
        return $query->when($discipline, fn (Builder $query) => $query->where('discipline', $discipline));
    }
}
