<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use HasFactory;

    protected $table='tasks';
    protected $primaryKey = 'task_id';
    protected $fillable = [
        'user_id', 'title', 'status', 'description', 
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function findUserTask($userId){
        return Task::where('user_id',$userId)->get();
    }

}
