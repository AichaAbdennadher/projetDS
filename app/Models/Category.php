<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'aa_categories';
    protected $primaryKey = 'aa_id';
    
    protected $fillable = ['aa_name'];

    public function events()
    {
        return $this->hasMany(Event::class, 'aa_category_id', 'aa_id');
    }
}
