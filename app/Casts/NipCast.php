<?php

namespace App\Casts;

use App\Models\Nip;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

class NipCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return null;
        }
        if(is_string($value)){
            return Nip::fromString($value);
        }
        if($value instanceof Nip){
            return $value;
        }
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if(is_string($value)){
            $value =  Nip::fromString($value);
        }
        if(! $value instanceof Nip){
             throw new InvalidArgumentException();
        }
        return $value->getNip();
    }
}
