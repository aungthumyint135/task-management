<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use App\Common\Routing\Controller;
use App\Common\Exceptions\FatalErrorException;

class TaskController extends Controller
{

    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $tasks = $this->taskService->getAllTasks();

        return $this->response($tasks->toArray());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws FatalErrorException
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);
        $response = $this->taskService->createTask($request);

        return $this->response($response->toArray());
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws FatalErrorException
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $task = $this->taskService->updateTask($request,$id);

        return $this->response($task->toArray());
    }

    /**
     * @param $ids
     */
    public function destroy($ids)
    {
        $task = $this->taskService->deleteTasks($ids);
    }
}
