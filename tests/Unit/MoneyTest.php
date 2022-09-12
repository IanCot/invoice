<?php

namespace Tests\Unit;

use App\Models\Money;
use PHPUnit\Framework\TestCase;
use App\Exceptions\InvalidMoneyAmountException;

class MoneyTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_money_can_be_created():void
    {
       $money = new Money(1200);
       $this->assertSame(1200,$money->getAmount());
    }
    public function test_money_cannot_be_created_with_invalid_amount():void
    {
        $this->expectException(InvalidMoneyAmountException::class);

        $money = new Money(-1);
    }
    public function test_same_values_are_equal():void
    {
        $money1 = new Money(4900);
        $money2 = new Money(4900);

        $result = $money1->equals($money2);

        $this->assertTrue($result);
    }
    public function test_diferent_values_are_not_equal():void
    {
        $money1 = new Money(4900);
        $money2 = new Money(490);

        $result = $money1->equals($money2);

        $this->assertFalse($result);
    }
    public function test_money_can_be_created_from_float():void
    {
        $money = Money::fromFloat(23.00);

        $this->assertSame(2300,$money->getAmount());
    }
    /**
     * @dataProvider validStringMoneyProvider
     */
    public function test_money_can_be_created_from_string(string $amount,int $expected):void
    {
        $money = Money::fromString($amount);
        $this->assertSame($expected,$money->getAmount());
    }
    public function test_money_can_return_formated_string():void
    {
        $money = Money::fromString("230,89 zł");
        $this->assertSame("230,89 zł",$money->getFormated());
    }
    public function validStringMoneyProvider():array
    {
        return [
            ['23.00',2300],
            ['23,00',2300],
            ['23,00 zł',2300],
            ['23.0',2300],
            ['23,0',2300],
            ['23,0 zł',2300],
            ['23.7',2370],
            ['23,7',2370],
            ['23,7 zł',2370],
            ['1100',110000],
            ['1100',110000],
            ['1 100',110000],
            ['1100,00',110000],
            ['1 100,00',110000],
            ['1100.00',110000],
            ['1 100.00',110000],
            ['1100zł',110000],
            ['1100 zł',110000],
            ['1 100 zł',110000],
            ['1 100,00 zł',110000],
            ['1 100.00 zł',110000]
        ];
    }
}
