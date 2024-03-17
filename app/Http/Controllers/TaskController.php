<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\TaskStoreRequest;
use App\Models\Task;
use App\Models\User;
use GuzzleHttp\Psr7\Request;

/**
 * Controller class to Tasks actions
 */
class TaskController extends Controller
{
    /**
     * Return a general list from tasks
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
        return response()->json(['message' => 'Tarea creada']);
    }
}
