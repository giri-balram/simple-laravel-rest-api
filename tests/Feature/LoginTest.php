<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LoginTest extends TestCase
{   
    /**
     * Testcase for check requireed email and password field for login.
     *
     * @return void
     */
    public function testRequiresEmailAndPassword()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson(["errors"=>[
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.']],
            ]);
    }

    /**
     * Testcase for user login success.
     *
     * @return void
     */
    public function testUserLoginsSuccessfully()
    {
    	//load a sample data
        $user = factory(User::class)->create([
        	'name'     => 'Test User',
            'email'    => 'user@userlogin.com',
            'password' => bcrypt('123456'),
        ]);

        //test the sample user data
        $tuserData = ['email' => 'user@userlogin.com', 'password' => '123456'];

        $this->json('POST', 'api/login', $tuserData)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'api_token',
                    'created_at',
                    'updated_at',
                ],
            ]);

    }
}
