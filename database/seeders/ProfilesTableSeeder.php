<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
            [
                // 'name' => 'Marco Rossi',
                // 'email' => 'marco.rossi@clinicamilano.it',
                // 'address' => 'Via Dante Alighieri 10, Milano',
                'telephone_number' => '+39 02 1234567',
                'performance' => "Visite cardiologiche, ECG, gestione dell'ipertensione",
                'bio' => "Marco Rossi è un cardiologo esperto con oltre 20 anni di esperienza. Laureatosi all'Università
                          di Milano, ha completato la sua specializzazione in Cardiologia presso il Policlinico di Milano. È noto per
                          le sue ricerche sulle aritmie cardiache e ha pubblicato numerosi articoli in riviste scientifiche."
            ],
            [
                // 'name' => 'Luca Bianchi',
                // 'email' => 'luca.bianchi@ospedalemaggiore.it',
                // 'address' => 'Via Rizzoli 20, Bologna',
                'telephone_number' => '+39 051 7654321',
                'performance' => 'Chirurgia ortopedica, trattamento delle fratture, terapia del dolore articolare',
                'bio' => "Luca Bianchi ha ottenuto la laurea in Medicina e Chirurgia presso l'Università di Bologna.
                          Specializzatosi in Ortopedia e Traumatologia, lavora presso l'Ospedale Maggiore di Bologna. Ha un
                          particolare interesse per le protesi articolari e la chirurgia ricostruttiva."
            ],
            [
                // 'name' => 'Alessandro Ferrari',
                // 'email' => 'alessandro.ferrari@ospedalesangiovanni.it',
                // 'address' => 'Corso Francia 45, Torino',
                'telephone_number' => '+39 011 8765432',
                'performance' => 'Diagnosi e trattamento dei tumori, chemioterapia, terapia del dolore oncologico',
                'bio' => "Laureato in Medicina presso l'Università di Torino, Alessandro Ferrari ha completato la sua
                          specializzazione in Oncologia e Ematologia. È attualmente direttore del dipartimento di Oncologia presso
                          l'Ospedale San Giovanni di Torino e ha ricevuto numerosi riconoscimenti per le sue ricerche sui tumori
                          del sangue."
            ],
            [
                // 'name' => 'Paolo Verdi',
                // 'email' => 'paolo.verdi@ospedalepadova.it',
                // 'address' => 'Via San Francesco 18, Padova',
                'telephone_number' => '+39 049 1239876',
                'performance' => 'Diagnosi e trattamento delle malattie neurodegenerative, elettromiografia, consulenze
                                  neurologiche',
                'bio' => "Paolo Verdi è un giovane neurologo, laureatosi da poco all'Università di Padova. Attualmente
                          lavora presso l'Ospedale Civile di Padova, dove si occupa principalmente di disturbi neurodegenerativi. È
                          autore di diverse pubblicazioni su riviste accademiche."
            ],
            [
                // 'name' => 'Giovanni Neri',
                // 'email' => 'giovanni.neri@ospedalenapoli.it',
                // 'address' => 'Via Toledo 25, Napoli',
                'telephone_number' => '+39 081 7896543',
                'performance' => 'Interventi chirurgici generali, laparoscopia, gestione delle emergenze chirurgiche',
                'bio' => "Giovanni Neri ha conseguito la laurea in Medicina e Chirurgia presso l'Università di Napoli.
                          Con oltre 25 anni di esperienza, è un chirurgo generale di fama nazionale, specializzato in interventi
                          laparoscopici. È stato premiato per la sua eccellenza nella pratica chirurgica."
            ],
            [
                // 'name' => 'Maria Conti',
                // 'email' => 'maria.conti@policlinicoroma.it',
                // 'address' => 'Piazza del Popolo 12, Roma',
                'telephone_number' => '+39 06 9876543',
                'performance' => 'Visite ginecologiche, monitoraggio delle gravidanze, ecografie ostetriche',
                'bio' => "Maria Conti è una ginecologa e ostetrica con 15 anni di esperienza. Ha studiato all'Università
                          di Roma La Sapienza e ha completato la specializzazione presso il Policlinico Umberto I. Si dedica
                          particolarmente alla salute riproduttiva delle donne e alla cura delle gravidanze ad alto rischio."
            ],
            [
                // 'name' => 'Anna Russo',
                // 'email' => 'anna.russo@ospedalemeyer.it',
                // 'address' => 'Viale Pieraccini 24, Firenze',
                'telephone_number' => '+39 055 8765432',
                'performance' => 'Visite pediatriche, assistenza neonatale, vaccinazioni',
                'bio' => "Laureatasi in Medicina presso l'Università di Firenze, Anna Russo ha proseguito con la
                          specializzazione in Pediatria e Neonatologia. Lavora presso l'Ospedale Meyer di Firenze, dove è nota
                          per il suo impegno nella cura dei neonati prematuri."
            ],
            [
                // 'name' => 'Laura Bianchi',
                // 'email' => 'laura.bianchi@clinicamilano.it',
                // 'address' => 'Via Montenapoleone 8, Milano',
                'telephone_number' => '+39 02 2345678',
                'performance' => 'Trattamenti dermatologici, dermatoscopia, trattamenti estetici cutanei',
                'bio' => "Laura Bianchi è una giovane dermatologa laureata presso l'Università di Pavia. Ha completato
                          la specializzazione in Dermatologia presso lo stesso ateneo. Lavora in una clinica privata a Milano e si
                          occupa principalmente di malattie cutanee e trattamenti estetici."
            ],
            [
                // 'name' => 'Giulia Ricci',
                // 'email' => 'giulia.ricci@ospedalesanmartino.it',
                // 'address' => 'Via Assarotti 29, Genova',
                'telephone_number' => '+39 010 1234567',
                'performance' => "Consulenze psichiatriche, trattamento dei disturbi dell'umore, terapia farmacologica",
                'bio' => "Giulia Ricci ha conseguito la laurea in Medicina e Chirurgia presso l'Università di Genova,
                          seguita dalla specializzazione in Psichiatria. Con oltre 10 anni di esperienza, lavora presso l'Ospedale
                          San Martino di Genova, dove si occupa di disturbi dell'umore e ansia."
            ],
            [
                // 'name' => 'Elisa Ferrari',
                // 'email' => 'elisa.ferrari@ospedalepisa.it',
                // 'address' => 'Via Roma 5, Pisa',
                'telephone_number' => '+39 050 8765432',
                'performance' => 'Gestione del diabete, controllo delle malattie tiroidee, consulenze endocrinologiche',
                'bio' => "Elisa Ferrari ha ottenuto la laurea presso l'Università di Pisa e ha completato la
                          specializzazione in Endocrinologia e Diabetologia. Attualmente, è responsabile del centro per la cura del
                          diabete presso l'Ospedale di Pisa. Ha pubblicato diverse ricerche sull'innovazione nel trattamento del
                          diabete."
            ],
        ];

        foreach($profiles as $singleProfile){
            
            $newProfile = new Profile();
            $newProfile->photo = 'https://media-assets.wired.it/photos/615dbfb0a047de03943a3dda/master/w_2580%2Cc_limit/9ff64ad8-59a5-4f2d-846c-be85ab4f7d70.png';
            $newProfile->telephone_number = $singleProfile['telephone_number'];
            $newProfile->performance = $singleProfile['performance'];
            $newProfile->bio = $singleProfile['bio'];
            $newProfile->save();
        }
    }
}
