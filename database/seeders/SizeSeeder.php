<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("sizes")->insert([
            ["name" => "Small"],
            ["name" => "Medium"],
            ["name" => "Large"],
            ["name" => "Extra Large"],
        ]);
    }
}
