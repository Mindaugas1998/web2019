<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'user_id' => 2,
            'title' => 'Sword',
            'description' => 'Description for a sword',
            'price' => 1440,
            'phone' => 860798875,
            'image' => 'sword.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('items')->insert([
            'user_id' => 2,
            'title' => 'Lobster',
            'description' => 'This is a lobster. Please buy it you peasant',
            'price' => 240,
            'phone' => 862712345,
            'image' => 'lobster.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('items')->insert([
            'user_id' => 3,
            'title' => 'Lobster Pot',
            'description' => 'Lobster pot for catching lobsters',
            'price' => 450,
            'phone' => 864717875,
            'image' => 'lobster_pot.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
