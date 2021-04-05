<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $commands = [
            '/createcv' => 'Create a CV.',
            '/history' => 'List all created CVs.',
            '/help' => 'List all available commands.'
        ];

        foreach($commands as $command => $description) {
            DB::insert('insert into commands (command, description) values (?, ?)', [$command, $description]);
        }
    }
}
