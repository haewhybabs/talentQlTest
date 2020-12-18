<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        try{
            $validatedData = Validator::make($request->json()->all(), [
                'title' => 'required',
            ]);
            if ($validatedData->fails()) {
                return response()->json(['error'=>$validatedData->errors()],422)->header('content-Type','application/json');
            }

            $task = new Task();
            $task->title = $request->input('title');
            $task->description=$request->input('description');
            $task->user_id=auth()->user()->id;
            $task->save();
            return response()->json(['status'=>true,'data'=>$task],200)->header('content-Type','application/json');
        }

        catch (\Exception $exception){
            return response()->json(['error'=>$exception->getMessage()],500)->header('content-Type','application/json');
        }

    }

    public function update(Request $request){
        try{

            $taskId = $request->input('task_id');
            $task = Task::find($taskId);
            if(!$task){
                return response()->json(['status'=>false,'message'=>'Task not found'],404)->header('content-Type','application/json');
            }
           
            //First check if input post exists and then update else use the previous
            $task->title=$request->input('title')?$request->input('title'):$task->title;
            $task->description=$request->input('description')?$request->input('description'):$task->description;
            $task->status = $request->input('status')?$request->input('status'):$task->status;
            $task->save();
            return response()->json(['status'=>true,'data'=>$task],200)->header('content-Type','application/json'); 
        }

        catch (\Exception $exception){
            return response()->json(['error'=>$exception->getMessage()],500)->header('content-Type','application/json');
        }
    }

    public function edit(Task $task){
        try{
            if($task){
                return response()->json(['status'=>true,'data'=>$task],200)->header('content-Type','application/json'); 
            }
            return response()->json(['status'=>false,'message'=>'Task not found'],404)->header('content-Type','application/json'); 
           
        }
        catch (\Exception $exception){
            return response()->json(['error'=>$exception->getMessage()],500)->header('content-Type','application/json');
        }
    
    }
}
