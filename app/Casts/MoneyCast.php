<?php

namespace App\Casts;

use App\Models\Money;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class MoneyCast implements CastsAttributes
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
            return Money::createFromString($value);
        }
        if($value instanceof Money){
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
            $value = Money::createFromString($value);
        }
        if(is_float($value)){
            $value = Money::createFromFloat($value);
        }
        if(is_int($value)){
            $value = Money::createFromInt($value);
        }
        if (! $value instanceof Money) {
            throw new \InvalidArgumentException(
                "The given value is not an Money instance",
            );
        }
        return $value;
    }
}
