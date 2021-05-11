<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiModel extends Model
{
  use HasFactory;

  protected static $format;

  /**
   * $column_infoの取得
   */
  protected static function getColumnInfo(): array
  {
    return static::$column_info;
  } 

  /**
   * formatを作成
   */
  protected static function makeFormat(): array
  {
    static::$format['search'] = static::getColumnByFlag('search');

    return static::getFormat();
  }

  protected static function getColumnByFlag(String $flag_name): array
  {
    $columns = [];

    foreach(static::$column_info as $a_column){
      if(isset($a_column[$flag_name])){
        $columns[$a_column['column']] = $a_column['column_name'];
      }
    }

    return $columns;
  }

  /**
   * 色々な情報を詰めたformatを取得
   */
  protected static function getformat(): array
  {
    return static::$format;
  } 
}
