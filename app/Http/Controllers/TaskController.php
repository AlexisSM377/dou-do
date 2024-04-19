<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\BuildError;
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
        try {
            if (!empty($request->user_id)) {
                $tasks = Task::where('responsable_id',
                    User::where('external_identifier', $request->user_id)->first()->id
                )->get();
                return new TaskCollecion($tasks);
            }
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
            return response()->json(['message', 'Se ha generado un error interno, por favor, comunícate con el soporte.'], 500);
        }
    }

    /**
     * Gets from database a task and returns it
     *
     * @param User $user
     * @return JSON
     */
    public function show(Task $task)
    {
        try {
            return new TaskResource($task);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
            return response()->json(['message', 'Se ha generado un error interno, por favor, comunícate con el soporte.'], 500);
        }
    }

    /**
     * Save in database a new Task and returns it
     *
     * @return JSON
     */
    public function store(TaskStoreRequest $request)
    {
        try {
            $collaborator = User::where('external_identifier', $request->responsable)->first();
            Task::create(
                array_merge(
                    ['responsable_id' => $collaborator->id],
                    $request->all()
                )
            );
            return response()->json(['message' => 'Tarea creada.']);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
            return response()->json(['message', 'Se ha generado un error interno, por favor, comunícate con el soporte.'], 500);
        }
    }

    /**
     * Updates a Task and returns it
     *
     * @return JSON
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        try {
            $task->update($request->all());
            return response()->json(['message' => 'Tarea actualizada.']);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
            return response()->json(['message', 'Se ha generado un error interno, por favor, comunícate con el soporte.'], 500);
        }
    }

    /**
     * Remove a task and returns a informatical message
     *
     * @param User $user
     * @return JsonResponse<200>
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();
            return response()->json(['message' => 'Tarea eliminada.']);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
            return response()->json(['message', 'Se ha generado un error interno, por favor, comunícate con el soporte.'], 500);
        }
    }
}
