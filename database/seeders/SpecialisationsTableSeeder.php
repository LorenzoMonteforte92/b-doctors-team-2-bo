<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialisation;
use Illuminate\Support\Str;

class SpecialisationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialisations = [
        'Cardiologia',
        'Medicina Interna',
        'Ortopedia',
        'Traumatologia',
        'Oncologia',
        'Ematologia',
        'Neurologia',
        'Chirurgia Generale',
        'Ginecologia',
        'Ostetricia',
        'Pediatria',
        'Neonatologia',
        'Dermatologia',
        'Psichiatria',
        'Endocrinologia',
        'Diabetologia'
    ];

    foreach($specialisations as $singleSpecialisation){
        $newSpecialisation = new Specialisation();
        $newSpecialisation->name = $singleSpecialisation;
        $newSpecialisation->slug = Str::slug($newSpecialisation->name, '-');
        $newSpecialisation->save();

    }
    }
}
