<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\TaskStoreRequest;
use App\Http\Requests\Update\TaskUpdateRequest;
use App\Http\Resources\Collections\TaskCollecion;
use App\Http\Resources\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Controller class to Tasks actions
 */
class TaskController extends Controller
{
    /**
     * Returns a user tasks list
     *
     * @param Request $request
     * @return JSON
     */
    public function index(Request $request)
    {
        if (!empty($request->user)) {
            $tasks = Task::where('user_id',
                User::where('external_identifier', $request->user)->first()->id
            )->get();
            return new TaskCollecion($tasks);
        }
    }
    /**
     * Save in database a new Task and returns it
     *
     * @return JSON
     */
    public function store(TaskStoreRequest $request)
    {
        $user = User::where('id', $request->user_id)->first();
        Task::create(
            array_merge(
                $request->all(),
                ['user_id' => $user->id],
            )
        );
        return response()->json(['message' => 'Tarea creada.']);
    }

    /**
     * Gets from database a task and returns it
     *
     * @param User $user
     * @return JSON
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * Updates a Task and returns it
     *
     * @return JSON
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        $task->update($request->all());
        return response()->json(['message' => 'Tarea actualizada.']);
    }

    /**
     * Remove a task and returns a informatical message
     *
     * @param User $user
     * @return JsonResponse<200>
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Tarea eliminada']);
    }
}
