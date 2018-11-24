<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'type'];

    /**
     * Get the SubscriberField record associated with the Field.
     */
    public function subscriberfield()
    {
        return $this->hasMany('App\SubscriberField', 'field_id');
    }
}
