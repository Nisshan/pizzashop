<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'created_by' => isset($this->user_id) ? \App\Models\User::find($this->user_id)->name : 'Guest User',
            'status' => $this->status,
            'priority' => config('deliverystatus.priority.' . $this->priority),
            'billing_email' => $this->email,
            'billing_name' => $this->name,
            'billing_address' => $this->address,
            'billing_city' => $this->city,
            'charge_id' => $this->charge_id,
            'billing_province' => $this->province,
            'billing_postalcode' => $this->postalcode,
            'billing_phone' => $this->phone,
            'billing_name_on_card' => $this->name_on_card,
            'billing_discount' => $this->billing_discount,
            'billing_discount_code' => $this->billing_discount_code,
            'billing_total' => $this->billing_total,
            'error' => $this->error,
            'delivery_type' => $this->delivery_type,
            'delivery_charge' => $this->delivery_charge,
            'deliveryTime' => $this->deliveryTime,
            'delivery_date' => $this->delivery_date,

        ];
    }
}
