<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  use HasFactory;

  /**
   * テーブル
   */
  protected $table = 'tasks';

  //更新できるカラム
  protected $fillable = ['title', 'content', 'how_to_improve', 'tag', 'status'];

  /**
   * 主キー
   */
  protected $primaryKey = 'task_id';

  //自動インクリメント
  public $incrementing = true;

  protected static $column_info = [
    ['column_name' => 'task_id'],
    ['column_name' => 'title'],
    ['column_name' => 'content'],
    ['column_name' => 'how_to_improve'],
    ['column_name' => 'tag'],
    ['column_name' => 'status'],
  ];

  /**
   * $column_infoの取得
   */
  protected static function getColumnInfo()
  {
    return static::$column_info;
  } 
}
