<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class Products extends Model
{
    use Uuids;
    
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    //protected $guarded = ['id'];
    
    protected $fillable = array(
        'title',
        'price',
        'stock',
        'abstract',
        'description',
        'image_url',
        'created_at',
        'updated_at'
    );
}
