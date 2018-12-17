<?php

use Illuminate\Database\Seeder;


class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('statuses')->insert(['code' => 0,'name' => 'новый']);
        \DB::table('statuses')->insert(['code' => 10,'name' => 'подтвержден']);
        \DB::table('statuses')->insert(['code' => 20,'name' => 'завершен']);
    }
}
