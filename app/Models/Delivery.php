<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'no_resi',
        'partner_id',
        'courier_id',
        'note',
        'photo_received',
        'date_delivery',
        'date_received',
        'status',
        'status_received',
    ];

    protected $appends = ['courier','products','partner'];

    public function getCourierAttribute()
    {
        $result = User::find($this->courier_id);

        return  $result;
    }

    public function getPartnerAttribute()
    {
        $result = Partner::find($this->partner_id);

        return  $result;
    }

    public function getProductsAttribute()
    {
        $result = ProductDelivery::where('delivery_id', $this->id)->get();

        return  $result;
    }
    

    public function getPhotoReceivedAttribute()
    {
        if ($this->attributes['photo_received']) {
            return url('') . Storage::url($this->attributes['photo_received']);
        } else {
            return null;
        }
    }

}
