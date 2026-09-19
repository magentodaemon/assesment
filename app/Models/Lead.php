<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    /** @use HasFactory<\Database\Factories\LeadFactory> */
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'email_status',
        'company_name',
        'position_title',
        'position_location',
        'industry_name',
        'location',
        'country_code',
        'persona',
        'gender',
    ];

    /**
     * Fields that support exact-match filtering via query params.
     */
    protected const FILTERABLE = [
        'first_name',
        'last_name',
        'company_name',
        'position_title',
        'location',
        'email_status',
        'country_code',
        'industry_name',
        'position_location',
        'persona',
        'gender',
    ];

    /**
     * Apply the /leads query filters (q + individual field filters) to the query.
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        // Free-text search across the main identifying fields
        if (! empty($filters['q'])) {
            $term = $filters['q'];
            $query->where(function (Builder $q) use ($term) {
                $q->where('first_name', 'like', "%{$term}%")
                    ->orWhere('last_name', 'like', "%{$term}%")
                    ->orWhere('company_name', 'like', "%{$term}%")
                    ->orWhere('position_title', 'like', "%{$term}%");
            });
        }

        foreach (self::FILTERABLE as $field) {
            if (filled($filters[$field] ?? null)) {
                $query->where($field, $filters[$field]);
            }
        }

        return $query;
    }
}