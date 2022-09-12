<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Nip implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $nip = preg_replace(["/-/",'/\s/'],["",""],$value);
        if(preg_match('/^[0-9]{10}$/',$nip) == false){
            return false;
        }
        $digits = str_split($nip);
        $checksum = (
            6*intval($digits[0]) + 
            5*intval($digits[1]) + 
            7*intval($digits[2]) + 
            2*intval($digits[3]) + 
            3*intval($digits[4]) + 
            4*intval($digits[5]) + 
            5*intval($digits[6]) + 
            6*intval($digits[7]) + 
            7*intval($digits[8]))%11;
            return (intval($digits[9]) == $checksum);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Nie Poprawny numer NIP';
    }
}
