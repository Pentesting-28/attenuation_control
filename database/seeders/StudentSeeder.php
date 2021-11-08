<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

use App\Models\Student\{
	Student,
	Sport
};

use App\Traits\UtilTrait;

class StudentSeeder extends Seeder
{
	use UtilTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [
			'name' => [
				'Jose',
				'Maria',
				'Luis',
				'Carmen',
				'Carlos',
				'Ana',
				'Juan',
				'Rosa',
				'Jesus',
				'Juana',
				'Pedro',
				'Luisa',
				'Rafael',
				'Gladys',
				'Angel',
				'Luz',
				'Francisco',
				'Nancy',
			],
			'last_name' => [
				'González',
				'Rodríguez',
				'Pérez',
				'Hernández',
				'García',
				'Martínez',
				'Sánchez',
				'López',
				'Díaz',
				'Ferreira',
				'Ramírez',
				'Castillo',
				'Gómez',
				'Romero',
				'Oliveira',
				'Fernández',
				'Mendoza',
				'Rossi',
			],
			'gender' => [
				'Masculino',
				'Femenino',
			],
		];


    	for($k = 0; $k < count($data['name']); $k++) {

	        $student = Student::create([
	          'name'      => $data['name'][$k],
	          'last_name' => $data['last_name'][$k],
	          'gender'    => $data['gender'][array_rand($data['gender'])],
	          'code'      => $this->generateRandom(6),
	          'schedule'  => $this->schedule(),
	          'status'    => rand(0,1),
	        ]);

        	$student->sports()->sync($this->sports());
    	}

    }

    public function schedule()
    {
		$Object = new DateTime();  
        $Object->setTimezone(new DateTimeZone('America/Caracas'));
        $hour = $Object->format("H:i");

        return $hour;
    }

    public function sports()
    {
		$sport_id = Sport::get(['id']);

		$i = 0;

		$list_sport_id = [];

		$resul_sport_id = [];

		while($i < count($sport_id)) 
		{
			array_push($list_sport_id, $sport_id[$i]["id"]);
		  
			$i++;
		}
		
		$length_max = count($list_sport_id);

		for ($j = 0; $j < rand(1, $length_max); $j++)
		{ 
			array_push($resul_sport_id, $list_sport_id[$j]);
		}

		return $resul_sport_id;
    }
}
