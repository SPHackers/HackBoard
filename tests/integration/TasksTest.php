<?php

use \Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class TasksTest
 */
class TasksTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * This suite is run before every tests within this class
     */
    public function setUp()
    {
        parent::setUp();

        $registerResponse = $this->post('api/v1/user', [
            'name' => 'john doe',
            'email' => 'email@example.com',
            'password' => 'Pa$$w0rd',
            'password_confirmation' => 'Pa$$w0rd',
        ]);

        $registerResponse->seeStatusCode(201);

        $loginResponse = $this->post('api/v1/login', [
            'email' => 'email@example.com',
            'password' => 'Pa$$w0rd',
        ]);

        $loginJson = json_decode($loginResponse->response->getContent());
        $this->api_token = $loginJson->api_token;
    }

    /**
     * Integration test GET /api/v1/task/{id}
     */
    public function testFetchATask()
    {
        $response = $this->post('api/v1/task', [
            'title' => 'a title',
            'desc' => 'a small description',
            'api_token' => $this->api_token,
        ]);

        $createJson = json_decode($response->response->getContent());

        $getResponse = $this->get('api/v1/task/' . $createJson->id, [
            'api_token' => $this->api_token,
        ]);

        $getJson = json_decode($getResponse->response->getContent());
        $this->assertEquals($getJson, $createJson);
    }

    /**
     * Integration test POST /api/v1/task
     */
    public function testStoreNewTask()
    {
        $response = $this->post('api/v1/task', [
            'title' => 'a title',
            'desc' => 'a small description',
            'api_token' => $this->api_token,
        ]);

        $response->shouldReturnJson();
        $response->seeStatusCode(201);

        $json = json_decode($response->response->getContent());
        $this->seeInDatabase('tasks', (array)$json);
    }

    /**
     * Integration test DELETE /api/v1/task/{id}
     */
    public function testDestroyTask()
    {
        $storeResponse = $this->post('api/v1/task', [
            'title' => 'a title',
            'desc' => 'a small description',
            'api_token' => $this->api_token,
        ]);

        $json = json_decode($storeResponse->response->getContent());
        $this->seeInDatabase('tasks', (array)$json);

        $deleteResponse = $this->delete('api/v1/task/' . $json->id, [
            'api_token' => $this->api_token,
        ]);
        $deleteResponse->assertResponseOk();

        $this->missingFromDatabase('tasks', (array)$json);
    }

    /**
     * Integration test PUT /api/v1/task/{id}
     */
    public function testUpdateTask()
    {
        $storeResponse = $this->post('api/v1/task', [
            'title' => 'a title',
            'desc' => 'a small description',
            'api_token' => $this->api_token,
        ]);

        $json = json_decode($storeResponse->response->getContent());
        $this->seeInDatabase('tasks', (array)$json);

        $updateResponse = $this->put('api/v1/task/' . $json->id, [
            'title' => 'an updated title',
            'api_token' => $this->api_token,
        ]);
        $updateResponse->assertResponseOk();

        $this->seeInDatabase('tasks', [
            'id' => $json->id,
            'title' => 'an updated title'
        ]);
    }
}
