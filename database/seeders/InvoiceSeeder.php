<?php

namespace Database\Seeders;

use Database\Factories\InvoiceFactory;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InvoiceFactory::factory()->count(100)->create();
    }
}
