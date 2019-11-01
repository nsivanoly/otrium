<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Gmv
 * @package App\Models
 */
class Gmv extends Model
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'gmv';

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
     * @return BelongsTo
     */
    function brands()
    {
        return $this->belongsTo('App\Models\Brands', 'brand_id');
    }
}
