<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends ApiModel
{
  use HasFactory;

  /**
   * テーブル
   */
  protected $table = 'tasks';

  //更新できるカラム
  protected $fillable = ['user_id', 'title', 'content', 'how_to_improve', 'tag', 'status'];

  /**
   * 主キー
   */
  protected $primaryKey = 'task_id';

  //自動インクリメント
  public $incrementing = true;

  protected static $column_info = [
    ['column' => 'task_id',
      'column_name' => 'タスクID',
    ],
    ['column' => 'user_id',
      'column_name' => 'ユーザID',
    ],
    ['column' => 'title',
      'column_name' => 'タイトル',
      'search' => true,
    ],
    ['column' => 'content',
      'column_name' => '本文',
    ],
    ['column' => 'how_to_improve',
      'column_name' => '改善案'
    ],
    ['column' => 'tag',
      'column_name' => 'タグ',
      'search' => true,
    ],
    ['column' => 'status',
      'column_name' => 'ステータス',
      'search' => true,
    ],
  ];
}
