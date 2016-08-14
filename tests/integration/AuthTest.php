<?php

use \Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class AuthTest
 */
class AuthTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Integration test on POST /api/v1/login
     */
    public function testUserCanLoginSuccessfully()
    {
        $registerResponse = $this->post('api/v1/user', [
            'name' => 'john doe',
            'email' => 'email@example.com',
            'password' => 'Pa$$w0rd',
            'password_confirmation' => 'Pa$$w0rd',
        ]);

        $registerResponse->shouldReturnJson();
        $registerResponse->seeStatusCode(201);

        $loginResponse = $this->post('api/v1/login', [
            'email' => 'email@example.com',
            'password' => 'Pa$$w0rd',
        ]);

        $loginResponse->shouldReturnJson();
        $loginResponse->seeStatusCode(200);
        $loginResponse->seeJsonStructure([
            'api_token'
        ]);
    }
}
