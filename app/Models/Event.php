<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'aa_events';
    protected $primaryKey = 'aa_id';

    protected $fillable = [
        'aa_title',
        'aa_description',
        'aa_start_date',
        'aa_end_date',
        'aa_place',
        'aa_price',
        'aa_capacity',
        'aa_image',
        'aa_is_free',
        'aa_category_id',
        'aa_created_by'
    ];

    protected $casts = [ //Convertir les types de données
        'aa_start_date' => 'datetime',
        'aa_end_date' => 'datetime',
        'aa_is_free' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'aa_category_id', 'aa_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'aa_created_by', 'aa_id');
    }


    public function registrations()
    {
        return $this->hasMany(Registration::class, 'aa_event_id', 'aa_id');
    }
}
