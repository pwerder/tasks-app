<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignmentRequest;
use App\Http\Resources\Api\V1\AssignmentResource;
use App\Models\Assignment;
use App\Models\Task;
use App\Models\User;
use App\Trait\HttpResponses;

class AssignmentsController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AssignmentResource::collection(Assignment::with(['user', 'task'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssignmentRequest $request)
    {
        if (!User::where('id', $request->user_id)->exists()) {
            return $this->response(404, 'Not Found User');
        }

        if (!Task::where('id', $request->task_id)->exists()) {
            return $this->response(404, 'Not Found Task');
        }

        $assigment = Assignment::create([
            'user_id'=> $request->user_id,
            'task_id' => $request->task_id,
        ]);

        return $this->response(200, 'Success', new AssignmentResource($assigment));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $assignment = AssignmentResource::collection(Assignment::with(['user', 'task'])->where('id', $id)->get());
        if (!Assignment::where('id', $id)->exists()) {
            return $this->response(404, 'Not Found', $assignment);
        }
        return $this->response(200,'Successs', $assignment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AssignmentRequest $request, string $id)
    {
        if (!User::where('id', $request->user_id)->exists()) {
            return $this->response(404, 'Not Found User');
        }

        if (!Task::where('id', $request->task_id)->exists()) {
            return $this->response(404, 'Not Found Task');
        }

        try {
            $assignment = Assignment::findOrFail($id);
            $assignment->update($request->all());
            return $this->response(200,"Updated", (new AssignmentResource($assignment)));
        } catch (\Exception $e) {
            return $this->response(400,"Not Updated");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $assignment = Assignment::find($id);
        if (!$assignment) {
            return $this->response(404, "Not found");
        }
        $assignment->delete();
        return $this->response(202, 'Deleted');
    }
}
