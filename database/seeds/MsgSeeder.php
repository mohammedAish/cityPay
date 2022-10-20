<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MsgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Currency ::class,10)->create();
    }
}
