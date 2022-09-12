<?php

namespace Tests\Feature\Models;

use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Invoice;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_main_rout_exist()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_api_get_ivoice():void
    {   
         Invoice::factory()->create([
            'invoice_no'=>'F/0001',
            'date_of_issue' => '2022-09-12',
            'seller_nip'=>'8487197003',
            'buyer_nip'=>'2953644914',
            'product'=>'testowy',
            'amount'=>4286
        ]);
      
        $response = $this->getJson('/api/invoices/1');
        $response->assertStatus(200);
        $response->assertJsonPath('data.invoice_no','F/0001');
        $response->assertJsonPath('data.date_of_issue','2022-09-12');
        $response->assertJsonPath('data.seller_nip','848-719-70-03');
        $response->assertJsonPath('data.buyer_nip','295-364-49-14');
        $response->assertJsonPath('data.product','testowy');
        $response->assertJsonPath('data.amount','42,86 zł');
    }
    public function test_api_get_invoices():void
    {
        Invoice::factory()->count(10)->create();
        $response = $this->getJson('/api/invoices');
        $response->assertStatus(200);
        $response->assertJsonPath('meta.total',10);
    }
    public function test_api_get_invoices_page():void
    {
        Invoice::factory()->count(30)->create();
        $response = $this->getJson('/api/invoices?page=2');
        $response->assertStatus(200);
        $response->assertJsonPath('meta.current_page',2);
    }
    public function test_api_post_invoice():void
    {
        $response = $this->postJson('/api/invoices',
            [
                'invoice_no'=>'F/0001',
                'date_of_issue' => '2022-09-12',
                'seller_nip'=>'8487197003',
                'buyer_nip'=>'2953644914',
                'product'=>'testowy',
                'amount'=>4286
            ]
        );
        $response->assertStatus(201);
        $response->assertJsonPath('data.invoice_no','F/0001');
        $response->assertJsonPath('data.date_of_issue','2022-09-12');
        $response->assertJsonPath('data.seller_nip','848-719-70-03');
        $response->assertJsonPath('data.buyer_nip','295-364-49-14');
        $response->assertJsonPath('data.product','testowy');
        $response->assertJsonPath('data.amount','42,86 zł');
    }
    public function test_api_put_invoice():void
    {
        Invoice::factory()->create([
            'invoice_no'=>'F/0001',
            'date_of_issue' => '2022-09-12',
            'seller_nip'=>'8487197003',
            'buyer_nip'=>'2953644914',
            'product'=>'testowy',
            'amount'=>4286
        ]);
        $response = $this->putJson('/api/invoices/1',
            [
                'invoice_no'=>'F/0001',
                'date_of_issue' => '2022-08-12',
                'seller_nip'=>'8487197003',
                'buyer_nip'=>'2953644914',
                'product'=>'testowy1',
                'amount'=>4287
            ]
        );
        $response->assertStatus(200);
        $response->assertJsonPath('data.date_of_issue','2022-08-12');
        $response->assertJsonPath('data.product','testowy1');
        $response->assertJsonPath('data.amount','42,87 zł');
    }
}
