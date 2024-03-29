<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'name', 'description', 'blocks', 'image'];

    public function topics() : BelongsToMany
    {
        return $this->belongsToMany(Topic::class);
    }
}
