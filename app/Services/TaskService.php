<?php

namespace App\Services;

use App\Common\Exceptions\FatalErrorException;
use App\Repositories\Task\TaskRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\ErrorHandler\Error\FatalError;

class TaskService
{
    protected TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function createTask($request)
    {
        $input['title'] = $request->title;

        $input['priority'] = $request->priority;

        $input['scheduled_date'] = Carbon::now()->toDateString();

        $input['completed_date'] = Carbon::now()->toDateString();

        if(!isset($request->completed_status)) {
            $input['completed_status'] = 0;
        }else{
            $input['completed_status'] = $request->completed_status;
        }

        try {

            DB::beginTransaction();

            $task = $this->taskRepository->insert($input);

            DB::commit();

        }catch (Exception $exception) {

            DB::rollBack();

            throw new \App\Common\Exceptions\FatalErrorException($exception->getMessage());

        }

        return $task;
    }

    public function updateTask($request, $id)
    {
        $task = $this->taskRepository->getDataById($id);

        $input['title'] = $request->title;

        $input['priority'] = $request->priority;

        $input['scheduled_date'] = Carbon::now()->toDateString();

        $input['completed_date'] = Carbon::now()->toDateString();

        if(!isset($request->completed_status)) {
            $input['completed_status'] = 0;
        }else{
            $input['completed_status'] = $request->completed_status;
        }
        try {

            DB::beginTransaction();

            $this->taskRepository->update($input, $id);

            DB::commit();

        } catch (Exception $exception) {
            DB::rollBack();

            throw new \App\Common\Exceptions\FatalErrorException($exception);
        }

        return $this->taskRepository->getDataById($id);
    }

    public function deleteTasks($ids)
    {
        dd($ids);
    }

    public function getAllTasks()
    {
        return $this->taskRepository->all();
    }
}
