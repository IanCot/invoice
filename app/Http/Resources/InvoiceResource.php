<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'invoice_no'=>$this->invoice_no,
            'seller_nip'=>$this->seller_nip,
            'buyer_nip' => $this->buyer_nip,
            'product'=>$this->product,
            'amount'=>$this->amount,
        ];
    }
}
