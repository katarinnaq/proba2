<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'korisnik',
        'status',
        'ukupna_cena',
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
            'korisnik' => 'integer',
            'ukupna_cena' => 'decimal:2',
        ];
    }

    public function korisnik(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
