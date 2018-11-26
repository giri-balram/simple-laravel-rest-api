<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriberField extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['subscriber_id', 'field_id'];

    /**
     * Get the SubscriberField record associated with the Subscriber.
     */
    public function subscriber()
    {
        return $this->belongsTo('App\Subscriber', 'subscriber_id');
    }

    /**
     * Get the SubscriberField record associated with the Field.
     */
    public function field()
    {
        return $this->belongsTo('App\Field', 'field_id');
    }
}
