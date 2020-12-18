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
}
