<?php

namespace App\Models;
use App\Exceptions\InvalidMoneyAmountException;

final class Money {

    private $amount;
   
    public function __construct(int $amount)
    {
        if($amount < 0){
            throw new InvalidMoneyAmountException("Amount should be a positive value: {$amount}.");
        }
        $this->amount = $amount;
    }
    public static function createFromFloat(float $amount):self
    {
        return new self(intval($amount*100));
    }
    public static function createFromInt(int $amount):self
    {
        return new self($amount);
    }
    public static function createFromString(string $amount):self
    {
        $amount = preg_replace(['/,/i','/[zł]/','/\s/' ],['.','',''],$amount);
        return new self(intval($amount * 100));
    }
    public function getAmount():int
    {
        return $this->amount;
    }
    public function __toString():string
    {
        return sprintf('%s zł',number_format($this->amount/100 , 2, ',', ' '));
    }
    public function equals(self $other):bool
    {
        return $this->amount === $other->amount;
    }
}