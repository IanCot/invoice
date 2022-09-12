<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'invoice_no' => $this->faker->unique()->numerify('F/####'),
            'date_of_issue'=>$this->faker->dateTimeBetween('- 1 years','now'),
            'seller_nip' =>$this->faker->taxpayerIdentificationNumber(),
            'buyer_nip' =>$this->faker->taxpayerIdentificationNumber(),
            'product' =>  $this->faker->words(3,true),
            'amount' => $this->faker->numberBetween(100,1000000),
        ];
    }
}
