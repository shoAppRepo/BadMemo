<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
  public function index()
  {
    $all_tasks = Task::orderBy('task_id')->get();
    $column_info = Task::getColumnInfo();

    $data = [
      'all_items' => $all_tasks,
      'column_info' => $column_info,
    ];

    return $data;
  }

  public function update(Request $request)
  {
    $exists = $request->exists;
    $new_items = $request->new_items;
    $delete_items = $request->delete_items;

    foreach($exists as $exist){
      $update_target = Task::where('task_id', '=', $exist['task_id'])
        ->first();

      $update_target->fill($exist);

      $update_target->save();
    }

    if(count($new_items) > 0){
      foreach($new_items as $new_item){
        $task_model = new Task();

        $task_model->create($new_item);
      }
    }

    if(count($delete_items) > 0){
      foreach($delete_items as $delete_item){
        $delete_target = Task::where('task_id', '=', $delete_item['task_id'])
        ->first();

        $delete_target->delete();
      }
    }

    return $this->index();
  }
}