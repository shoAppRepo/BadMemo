<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      //実データに近いものを作成
      // \App\Models\User::factory(2)->create();

      //テストデータ
      $this->call([
        UsersTableSeeder::class,
      ]);
    }
}
