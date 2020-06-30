<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'currency', 'buy', 'sell',
    ];

    protected $visible = [
        'currency', 'buy', 'sell', 'history'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function history()
    {
        return $this->hasMany('App\History', 'currency', 'currency');
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function($currency)
        {
            if($prevHistory = $currency->history()->orderBy('id', 'desc')->first()){
                if($prevHistory->buy == $currency->buy && $prevHistory->sell == $currency->sell){
                    return;
                }
            }
            $currency->history()->create($currency->toArray());
        });
    }
}
