<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    public function inventories()
    {
        return $this->belongsToMany(Inventory::class, 'package_inventory')
            ->withPivot('quantity')
            ->withTimestamps();
    }
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
