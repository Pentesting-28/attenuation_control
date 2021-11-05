<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student\Sport;

class SportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	"name" => [
	        	"Natación",
				"Triatlon",
				"Ballet",
				"Defensa Personal",
				"Gimnasio",
        	],
        ];

        for($i = 0; $i < count($data["name"]); $i++)
        {
        	$sport = new Sport();
        	$sport->name = $data["name"][$i];
        	$sport->save();
        }
    }
}
