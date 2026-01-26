<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = 'aa_registrations';
    protected $primaryKey = 'aa_id';

    protected $fillable = ['aa_user_id', 'aa_event_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'aa_user_id', 'aa_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'aa_event_id', 'aa_id');
    }
}
