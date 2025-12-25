<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin',
        'naziv',
        'period_od',
        'period_do',
        'datum_kreiranja',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'admin' => 'integer',
            'period_od' => 'date',
            'period_do' => 'date',
            'datum_kreiranja' => 'date',
        ];
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
