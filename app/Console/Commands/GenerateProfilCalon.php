<?php

namespace App\Console\Commands;

use App\Services\ProfilCalonService;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class GenerateProfilCalon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-profil-calon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to get profile data of Indonesian leaders candidate';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dataProfil = (new ProfilCalonService())->getProfilCalonData();

        if ($dataProfil) {
            ksort($dataProfil);
        }

        $this->newLine();
        $this->info("Profil Calon Presiden dan Calon Wakil Presiden 2024");
        $this->newLine();

        foreach ($dataProfil as $index => $profil) {
            $this->line("Calon Nomor Urut $index");
            $this->newLine();
            $this->table(
                ['Posisi', 'Nama Lengkap', 'Tempat Lahir', 'Tanggal Lahir'],
                [
                    Arr::only($profil['presiden'], ['posisi', 'namaLengkap', 'tempatLahir', 'tanggalLahirText']),
                    Arr::only($profil['wakil_presiden'], ['posisi', 'namaLengkap', 'tempatLahir', 'tanggalLahirText'])
                ]
            );
            $this->newLine();
        }
    }
}
