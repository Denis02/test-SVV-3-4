<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table='history';

    protected $fillable = [
        'currency', 'buy', 'sell',
    ];

    protected $visible = [
        'buy', 'sell', 'created_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function currency()
    {
        return $this->belongsTo('App\Post', 'currency', 'currency');
    }

}
