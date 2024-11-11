<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
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
    public function tambahStok($tambah)
    {
        $this->increment('stok', $tambah);
    }
    public function kurangStok($kurang)
    {
        $this->decrement('stok', $kurang);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_inventory')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
