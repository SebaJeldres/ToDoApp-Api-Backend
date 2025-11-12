<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $task = Task::all();

        if(!$task) {
            $data = [
                'message' => 'Error al traer todas las tareas',
                'statues' => 404
            ];
            return response()->json($data,404);
        }

        $data = [
            'messages' => 'Task traidas con exito',
            'Task' => $task,
            'statues' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'task' => 'required|string|max:150'
        ]);

        $task = Task::create([
            'task' => $validated['task'],
            'completed' => false
        ]);

        $data = [
            'messages' => 'Tarea creada con exito',
            'Task' => $task,
            'statues' => 201
        ];

        return response()->json($data,201);


    }

    /**
     * Display the specified resource.
     */
   public function show(string $id)
{
    $task = Task::find($id);

    if (!$task) {
        return response()->json([
            'message' => 'No se encontró la tarea',
            'status' => 404
        ], 404);
    }

    return response()->json([
        'message' => 'Tarea traída con éxito',
        'task' => $task,
        'status' => 200
    ], 200);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'completed' => 'required|boolean'
        ]);

        if(!$validated) {
            $data = [
                'messages' => 'No se actualizo la tarea',
                'statues' => 400
            ];
            return response()->json($data,400);
        }

        $task->completed = $validated['completed'];
        $task->save();

        $data = [
            'messages' => 'Se actualizo correctamente',
            'Task' => $task,
            'statues' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        $data = [
            'messages' => 'Se elimino correctamente',
            'statues' => 200
        ];
        return response()->json($data,200);
    }
}
