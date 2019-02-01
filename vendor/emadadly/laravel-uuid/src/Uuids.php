<?php
namespace Emadadly\LaravelUuid;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait Uuids
{

    /**
     * Boot function from laravel.
     */
    protected static function bootUuids()
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = Uuid::uuid4()->toString();
            }
        });
        static::saving(function ($model) {
            $original_uuid = $model->getOriginal('id');
            if ($original_uuid !== $model->id) {
                $model->id = $original_uuid;
            }
        });
    }

    /**
     * Scope  by uuid 
     * @param  string  uuid of the model.
     * 
    */
    public function scopeUuid($query, $uuid, $first = true)
    {
        $match = preg_match('/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}$/', $uuid);

        if (!is_string($uuid) || $match !== 1)
        {
            throw (new ModelNotFoundException)->setModel(get_class($this));
        }
    
        $results = $query->where(config('uuid.default_uuid_column'), $uuid);
    
        return $first ? $results->firstOrFail() : $results;
    }

}
