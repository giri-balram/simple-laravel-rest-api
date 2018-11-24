<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LogoutTest extends TestCase
{

    /**
     * Test case for proper user log out 
     *
     * @return void
     */
    public function testUserIsLoggedOutProperly()
    {
    	//create a usre instance by user factory
        $user = factory(User::class)->create(['email' => 'user@userlogout.com']);

        //get the user token
        $token = $user->generateToken();
        //request header with access token
        $headers = ['Authorization' => "Bearer $token"];
        //check for api data access
        $this->json('get', '/api/subscribers', [], $headers)->assertStatus(200);
        $this->json('get', '/api/fields', [], $headers)->assertStatus(200);
        //call the log out api
        $this->json('post', '/api/logout', [], $headers)->assertStatus(200);
        //get the user instance
        $user = User::find($user->id);
        //make the API token null
        $this->assertEquals(null, $user->api_token);
    }

    /**
     * Test case for request for resource with null access token
     *
     * @return void
     */
    public function testUserWithNullToken()
    {
        // Simulating login
        $user = factory(User::class)->create(['email' => 'user@userlogout.com']);
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        // Simulating logout
        $user->api_token = null;
        $user->save();

        $this->json('get', '/api/subscribers', [], $headers)->assertStatus(401);
        $this->json('get', '/api/fields', [], $headers)->assertStatus(401);
    }
}
