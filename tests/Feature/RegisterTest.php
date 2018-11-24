<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class RegisterTest extends TestCase
{

    /**
     * Test case for required fields for registration
     *
     * @return void
     */
    public function testsRequiresPasswordEmailAndName()
    {
        $this->json('post', '/api/register')
            ->assertStatus(422)
            ->assertJson([ "errors" => [
                'name' => ['The name field is required.'],
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]]);
    }


    /**
     * Test case for confirm password match for registration
     *
     * @return void
     */
    public function testsRequirePasswordConfirmation()
    {
        $uData = [
            'name' => 'Dummy User',
            'email' => 'dummy@user.com',
            'password' => '123456',
            'password_confirmation' => '1234',
        ];

        $this->json('post', '/api/register', $uData)
            ->assertStatus(422)
            ->assertJson([ "errors" => [
                'password' => ['The password confirmation does not match.']],
            ]);
    }


    /**
     * Test case for required fields for registration
     *
     * @return void
     */
    public function testsRegistersSuccessfully()
    {
        $uData = [
            'name' => 'Dummy User',
            'email' => 'dummy@user.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ];

        $this->json('post', '/api/register', $uData)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token',
                ],
            ]);;
    }
}
