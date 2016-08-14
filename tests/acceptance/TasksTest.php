<?php

use \Illuminate\Foundation\Testing\DatabaseTransactions;

class TasksTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Acceptance test GET /api/task/{id}
     */
    public function testFetchATask()
    {
        $response = $this->post('api/task', [
            'title' => 'a title',
            'desc' => 'a small description',
        ]);

        $createJson = json_decode($response->response->getContent());

        $getResponse = $this->get('api/task/' . $createJson->id);

        $getJson = json_decode($getResponse->response->getContent());
        $this->assertEquals($getJson, $createJson);
    }

    /**
     * Acceptance test POST /api/task
     */
    public function testStoreNewTask()
    {
        $response = $this->post('api/task', [
            'title' => 'a title',
            'desc' => 'a small description',
        ]);

        $response->shouldReturnJson();

        $json = json_decode($response->response->getContent());
        $this->seeInDatabase('tasks', (array)$json);
    }

    /**
     * Acceptance test DELETE /api/task/{id}
     */
    public function testDestroyTask()
    {
        $storeResponse = $this->post('api/task', [
            'title' => 'a title',
            'desc' => 'a small description',
        ]);

        $json = json_decode($storeResponse->response->getContent());
        $this->seeInDatabase('tasks', (array)$json);

        $deleteResponse = $this->delete('api/task/' . $json->id);
        $deleteResponse->assertResponseOk();

        $this->missingFromDatabase('tasks', (array)$json);
    }

    /**
     * Acceptance test PUT /api/task/{id}
     */
    public function testUpdateTask()
    {
        $storeResponse = $this->post('api/task', [
            'title' => 'a title',
            'desc' => 'a small description',
        ]);

        $json = json_decode($storeResponse->response->getContent());
        $this->seeInDatabase('tasks', (array)$json);

        $updateResponse = $this->put('api/task/' . $json->id, [
            'title' => 'an updated title',
        ]);
        $updateResponse->assertResponseOk();

        $this->seeInDatabase('tasks', [
            'id' => $json->id,
            'title' => 'an updated title'
        ]);
    }
}
