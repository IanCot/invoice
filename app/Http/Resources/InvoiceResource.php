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
            'seller_nip'=>$this->seller_nip->getFormated(),
            'buyer_nip' => $this->buyer_nip->getFormated(),
            'product'=>$this->product,
            'amount'=>$this->amount->getFormated(),
            'date_of_issue'=>$this->date_of_issue->format('Y-m-d'),
            'updated_at'=>$this->updated_at->format('Y-m-d'),
        ];
    }
}
