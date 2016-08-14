<?php

use \Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Integration test on POST /api/v1/user
     */
    public function testCreateSuccessfullyANewUser()
    {
        $response = $this->post('api/v1/user', [
            'name' => 'john doe',
            'email' => 'email@example.com',
            'password' => 'Pa$$w0rd',
            'password_confirmation' => 'Pa$$w0rd',
        ]);

        $response->shouldReturnJson();
        $response->seeStatusCode(201);

        $createJson = json_decode($response->response->getContent());
        $this->seeInDatabase('users', (array)$createJson);
    }

    /**
     * Integration test on POST /api/v1/user
     */
    public function testCannotCreateUserWithoutPassConfirmation()
    {
        $response = $this->post('api/v1/user', [
            'name' => 'john doe',
            'email' => 'email@example.com',
            'password' => 'Pa$$w0rd',
        ]);

        $response->shouldReturnJson();
        $response->seeStatusCode(401);
    }

    /**
     * Integration test on POST /api/v1/user
     */
    public function testCannotCreateUserWithPassConfirmationMismatch()
    {
        $response = $this->post('api/v1/user', [
            'name' => 'john doe',
            'email' => 'email@example.com',
            'password' => 'Pa$$w0rd',
            'password_confirmation' => 'An0th3rP4$$',
        ]);

        $response->shouldReturnJson();
        $response->seeStatusCode(401);
    }

    /**
     * Integration test on POST /api/v1/user
     */
    public function testCannotCreateUserWithExistingEmail()
    {
        $this->post('api/v1/user', [
            'name' => 'john doe',
            'email' => 'email@example.com',
            'password' => 'Pa$$w0rd',
            'password_confirmation' => 'Pa$$w0rd',
        ]);

        $response = $this->post('api/v1/user', [
            'name' => 'john doe #2',
            'email' => 'email@example.com',
            'password' => 'Pa$$w0rd',
            'password_confirmation' => 'Pa$$w0rd',
        ]);

        $response->shouldReturnJson();
        $response->seeStatusCode(401);
    }
}
