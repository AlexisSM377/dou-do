<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        //* Not used
        // $tasks = Task::paginate(30);
        // return new TaskResource($tasks);
    }
}
