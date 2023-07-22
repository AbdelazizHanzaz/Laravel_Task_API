<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $tasks = $user->tasks;
        return response([
            "tasks" => $tasks,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();
        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'completed' => $validated['completed'],
            'user_id' => Auth::user()->id
        ]);

        return response([
            "task" => $task,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = Auth::user();

        $userTasks = $user->tasks->pluck('id')->toArray();

        if (!in_array($id, $userTasks)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $task = Task::findOrFail($id);

        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        $validated = $request->validated();
        $task = Task::findOrFail($id);

        if ($task->user_id == auth()->user()->id) {

            $task->update(
                [
                    "title" => $validated["title"],
                    "description" => $validated["description"],
                    "completed" => $validated["completed"],
                    "user_id" => Auth::user()->id
                ]
            );

            return response([
                "task" => $task,
            ], 200);
        }

        return response()->json(['message' => 'You are not authorized to update this task.'], 403);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // Get the task by ID.
        $task = Task::findOrFail($id);

        // Check if the user is authorized to delete the task.
        if ($task->user_id != auth()->user()->id) {
            return response()->json(['message' => 'You are not authorized to delete this task.'], 403);
        }

        // Delete the task.
        $task->delete();

        // Return a success response.
        return response()->json(['message' => 'Task deleted successfully.'], 200);
    }
}
