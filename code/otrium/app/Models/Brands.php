<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Brands
 * @package App\Models
 */
class Brands extends Model
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'brands';

    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     * @var array
     */
    protected $guarded = [];

    /**
     * Define relationship
     * @return HasMany
     */
    public function gmv()
    {
        return $this->hasMany('App\Models\Gmv', 'brand_id', 'id');
    }
}
