<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * @param null $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response|Commerce\RemoteAPI\Site\OrderRemoteAPI
     */
    public function show($id = null)
    {
        $task = Task::find($id);

        return !$task ? response(null, 404) : $task;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $newTask = Task::create([
            'title' => $request->input('title'),
            'desc' => $request->input('desc'),
        ]);

        return response()->json($newTask, 401);
    }

    /**
     * @param null $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id = null)
    {
        return Task::destroy($id) ? response(null, 200) : response(null, 404);
    }

    /**
     * @param null $id
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update($id = null, Request $request)
    {
        $task = Task::find($id);

        if (!$task) {
            return response(null, 404);
        }

        if ($request->input('title')) {
            $task->title = $request->input('title');
        }

        if ($request->input('desc')) {
            $task->desc = $request->input('desc');
        }

        $task->save();
    }
}
