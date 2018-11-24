<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email_address', 'name', 'state'];

     /**
     * Get the SubscriberField record associated with the Subscriber.
     */
    public function subscriberfield()
    {
        return $this->hasMany('App\SubscriberField', 'subscriber_id');
    }

    
}
