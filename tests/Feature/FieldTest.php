<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Field;

class FieldTest extends TestCase
{
    /**
     * Test Case for create new Field Api.
     *
     * @return void
     */
    public function testFieldsAreCreatedCorrectly()
    {
    	//create a test user
        $user = factory(User::class)->create();
        //get the access token
        $token = $user->generateToken();
        //Bearer access token header
        $headers = ['Authorization' => "Bearer $token"];
        //test data
        $tData = [
            'title' => 'company',
	        'type' => 'string',
        ];

        //test Fields api
        $this->json('POST', '/api/fields', $tData, $headers)
            ->assertStatus(201)
            ->assertJson(['title' => 'company', 'type' => 'string']);
    }

    /**
     * Test Case for update Field Api.
     *
     * @return void
     */
    public function testFieldsAreUpdatedCorrectly()
    {
    	//create test User by user factory call
        $user = factory(User::class)->create();
        //get user token
        $token = $user->generateToken();
        //composer the bearer access token
        $headers = ['Authorization' => "Bearer $token"];
        //create the test Field data
        $field = factory(Field::class)->create([
            'title' => 'company',
	        'type' => 'string',
        ]);

        //expected
        $payload = [
            'title' => 'company',
	        'type' => 'string',
        ];

        //Test case assert
        $response = $this->json('PUT', '/api/fields/' . $field->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([ 'title' => 'company', 'type' => 'string']);
    }


    /**
     * Test Case for delete Field Api.
     *
     * @return void
     */
    public function testFieldsAreDeletedCorrectly()
    {
        //create test User by user factory call
        $user = factory(User::class)->create();
        //get user token
        $token = $user->generateToken();
        //composer the bearer access token
        $headers = ['Authorization' => "Bearer $token"];
        //create the test Field data
        $field = factory(Field::class)->create([
            'title' => 'company',
	        'type' => 'string',
        ]);

        $this->json('DELETE', '/api/fields/' . $field->id, [], $headers)
            ->assertStatus(204);
    }

    /**
     * Test Case for listing Field Api.
     *
     * @return void
     */
    public function testFieldsAreListedCorrectly()
    {
        factory(Field::class)->create([
            'title' => 'company',
	        'type' => 'string',
        ]);

        factory(Field::class)->create([
            'title' => 'country',
	        'type' => 'string',
        ]);

        //create test User by user factory call
        $user = factory(User::class)->create();
        //get user token
        $token = $user->generateToken();
        //composer the bearer access token
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/fields', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                [ 'title' => 'company', 'type' => 'string', ],
                [ 'title' => 'country', 'type' => 'string', ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'title', 'type', 'created_at', 'updated_at'],
            ]);
    }
}
