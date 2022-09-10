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
            'invoice_no' => $this->faker->numerify('F/####'),
            'seller_nip' =>$this->faker->taxpayerIdentificationNumber(),
            'buyer_nip' =>$this->faker->taxpayerIdentificationNumber(),
            'product' =>  $this->faker->word(3,true),
            'amount' => $this->faker->numberBetween(100,1000000),
        ];
    }
}
