<?php

namespace App;

use App\Domain\SortableTrait;
use App\Domain\FilterableTrait;
use Spatie\Geocoder\Facades\Geocoder;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use FilterableTrait, SortableTrait;

    protected $sortable = ['price', 'created_at'];

    protected $filterable = ['type', 'status', 'price', 'area', 'address', ];

    protected $guarded = [];

    protected $casts = [
        'images' => 'Array',
        'detailed_info' => 'Array',
        'area' => 'Int'
    ];

    public function getDisplayPriceAttribute()
    {
        if ($this->status == 'rent') {
            return moneyFormatIndia($this->price) . '/month';
        } elseif (in_array($this->type, ['house', 'apartment'])) {
            return moneyFormatIndia($this->price);
        } else {
            return moneyFormatIndia($this->price * $this->area);
        }
    }

    public function getGeocodeAttribute()
    {
        $geocode = Geocoder::getCoordinatesForAddress($this->address . ' ' . $this->city . ' ' . $this->state);

        if ($geocode['lat'] == 0 && $geocode['lng'] == 0) {
            $geocode['lat'] = 24.585445;
            $geocode['lng'] = 73.712479;
        }

        return $geocode;
    }

    public function getSubPriceAttribute()
    {
        return ($this->status != 'rent' and !in_array($this->type, ['house', 'apartment'])) ?
            moneyFormatIndia($this->price) . '/' . $this->price_type :
            null;
    }

    public function getPriceTypeAttribute()
    {
        return $this->status == 'rent' ? 'mo' : $this->area_type;
    }

    public function features()
    {
        return $this->belongsToMany('App\Feature', 'property_feature')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
