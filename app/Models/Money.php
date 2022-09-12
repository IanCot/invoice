<?php

namespace App\Models;
use App\Exceptions\InvalidMoneyAmountException;

final class Money {

    private $amount;
   
    public function __construct(int $amount)
    {
        if($amount < 0){
            throw new InvalidMoneyAmountException("Kwota faktury nie moze być  ujemna {$amount}.");
        }
        $this->amount = $amount;
    }
    public static function fromFloat(float $amount):self
    {
        return new self(intval($amount*100));
    }
    public static function fromInt(int $amount):self
    {
        return new self($amount);
    }
    public static function fromString(string $amount):self
    {
        $amount = preg_replace(['/,/i','/[^\d.]/'],['.',''],$amount);
        return new self(intval($amount * 100));
    }
    public function getAmount():int
    {
        return $this->amount;
    }
    public function getFormated():string
    {
        return $this->format();
    }
    public function __toString():string
    {
        return $this->format();
    }
    public function equals(self $other):bool
    {
        return $this->amount === $other->amount;
    }
    private function format():string
    {
        return sprintf('%s zł',number_format($this->amount/100 , 2, ',', ' '));
    }
}