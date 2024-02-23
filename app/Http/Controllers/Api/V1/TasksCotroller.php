<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\Api\V1\TaskResource;
use App\Models\Task;
use App\Trait\HttpResponses;
use Illuminate\Http\Request;

class TasksCotroller extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $task = Task::create([
            'title' => $request->title,
            'description'=> $request->description,
            'status' => $request->status
        ]);

        return $this->response(200, 'Created Success', (new TaskResource($task)));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return $this->response(404, "Not found");
        }
        return $this->response(200, "Success", (new TaskResource($task)));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, int $id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->update($request->all());
            return $this->response(200,"Updated", (new TaskResource($task)));
        } catch (\Exception $e) {
            return $this->response(400,"Not Updated");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return $this->response(404, "Not found");
        }
        $task->delete();
        return $this->response(202, 'Deleted');
    }
}
