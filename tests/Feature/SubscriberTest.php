<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Subscriber;

class SubscriberTest extends TestCase
{

	/**
     * Test Case for create new Subscriber Api.
     *
     * @return void
     */
    public function testsSubscribersAreCreatedCorrectly()
    {
    	//create a test user
        $user = factory(User::class)->create();
        //get the access token
        $token = $user->generateToken();
        //Bearer access token header
        $headers = ['Authorization' => "Bearer $token"];
        //test data
        $tData = [
            'name' => 'Test Subscriber',
	        'email_address' => 'subscriber@test.com',
	        'state' => 'unconfirmed',
        ];

        //test subscribers api
        $this->json('POST', '/api/subscribers', $tData, $headers)
            ->assertStatus(201)
            ->assertJson(['id' => 1, 'name' => 'Test Subscriber', 'email_address' => 'subscriber@test.com', 'state'=>'unconfirmed']);
    }

    /**
     * Test Case for update Subscriber Api.
     *
     * @return void
     */
    public function testSubscribersAreUpdatedCorrectly()
    {
    	//create test User by user factory call
        $user = factory(User::class)->create();
        //get user token
        $token = $user->generateToken();
        //composer the bearer access token
        $headers = ['Authorization' => "Bearer $token"];
        //create the test subscriber data
        $subscriber = factory(Subscriber::class)->create([
            'name' => 'Test Subscriber',
	        'email_address' => 'subscriber@test.com',
	        'state' => 'unconfirmed',
        ]);

        //expected
        $payload = [
            'name' => 'Test Subscriber',
	        'email_address' => 'subscriber@test.com',
	        'state' => 'unconfirmed',
        ];

        //Test case assert
        $response = $this->json('PUT', '/api/subscribers/' . $subscriber->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([
                'id' => 1, 
                'name' => 'Test Subscriber',
		        'email_address' => 'subscriber@test.com',
		        'state' => 'unconfirmed',
            ]);
    }


    /**
     * Test Case for delete Subscriber Api.
     *
     * @return void
     */
    public function testSubscribersAreDeletedCorrectly()
    {
        //create test User by user factory call
        $user = factory(User::class)->create();
        //get user token
        $token = $user->generateToken();
        //composer the bearer access token
        $headers = ['Authorization' => "Bearer $token"];
        //create the test subscriber data
        $subscriber = factory(Subscriber::class)->create([
            'name' => 'Test Subscriber',
	        'email_address' => 'subscriber@test.com',
	        'state' => 'unconfirmed',
        ]);

        $this->json('DELETE', '/api/subscribers/' . $subscriber->id, [], $headers)
            ->assertStatus(204);
    }

    /**
     * Test Case for listing Subscriber Api.
     *
     * @return void
     */
    public function testSubscribersAreListedCorrectly()
    {
        factory(Subscriber::class)->create([
            'name' => 'Test Subscriber1',
	        'email_address' => 'subscriber1@test.com',
	        'state' => 'unconfirmed',
        ]);

        factory(Subscriber::class)->create([
            'name' => 'Test Subscriber2',
	        'email_address' => 'subscriber2@test.com',
	        'state' => 'active',
        ]);

        //create test User by user factory call
        $user = factory(User::class)->create();
        //get user token
        $token = $user->generateToken();
        //composer the bearer access token
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/subscribers', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                [ 'name' => 'Test Subscriber1', 'email_address' => 'subscriber1@test.com', 'state' => 'unconfirmed', ],
                [ 'name' => 'Test Subscriber2', 'email_address' => 'subscriber2@test.com', 'state' => 'active', ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'name', 'email_address', 'state', 'created_at', 'updated_at'],
            ]);
    }
}
