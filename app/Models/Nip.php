<?php

namespace App\Models;

use App\Exceptions\InvalidNipException;

final class Nip {

    private $nip;

    public function __construct(string $nip)
    {
        $nip = preg_replace(["/-/",'/\s/'],["",""],$nip);
        self::ensureIsValidNip($nip);
        $this->nip = $nip;
    }
    public static function fromString(string $nip):self
    {
        return new self($nip);
    }
    public function getNip():string
    {
        return $this->nip;
    }
    public function getFormated():string
    {
        return $this->format();
    }
    public function equals(self $other):bool
    {
        return $this->nip == $other->nip;
    }
    public function __toString():string
    {
      return $this->format();
    }
    private function format():string
    {
        return sprintf('%s-%s-%s-%s',substr($this->nip,0,3),substr($this->nip,3,3),substr($this->nip,6,2),substr($this->nip,8,2));
    }
    private static function ensureIsValidNip(string $nip)
    {
        if(preg_match('/^[0-9]{10}$/',$nip) == false){
            throw new InvalidNipException("");
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
            if(intval($digits[9]) != $checksum){
                throw new InvalidNipException("");
            }
    }

}