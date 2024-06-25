<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sponsorship;

class SponsorshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorships = [
            [
                'name' => 'Pacchetto Silver',
                'price' =>  '2.99',
                'duration' => '24',
            ],
            [
                'name' => 'Pacchetto Gold',
                'price' =>  '5.99',
                'duration' => '72',
            ],
            [
                'name' => 'Pacchetto Platinum',
                'price' =>  '9.99',
                'duration' => '144',
            ],
                
            
            ];

        foreach($sponsorships as $singleSponsorship){
            $newSponsorship = new Sponsorship();
            $newSponsorship->name = $singleSponsorship['name'];
            $newSponsorship->price = $singleSponsorship['price'];
            $newSponsorship->duration = $singleSponsorship['duration'];
            $newSponsorship->save();
        }    
        

    }
}
