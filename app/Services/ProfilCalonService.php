<?php

namespace App\Services;

use App\Dto\ProfilCalonDto;
use App\Enum\PosisiCalonEnum;
use Illuminate\Database\LostConnectionException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProfilCalonService
{
    public function getProfilCalonData()
    {
        try {
            $profilCalonResponse = Http::timeout(60)
                                ->get('https://mocki.io/v1/92a1f2ef-bef2-4f84-8f06-1965f0fca1a7')
                                ->json();

            $data = [];

            foreach ($profilCalonResponse['calon_presiden'] as $profilCalonPresiden) {
                $data[$profilCalonPresiden['nomor_urut']]["presiden"] = ProfilCalonDto::fromArray([
                    'posisi' => PosisiCalonEnum::PRESIDEN,
                    ...$profilCalonPresiden
                ])->toArray();
            }

            foreach ($profilCalonResponse['calon_wakil_presiden'] as $profilCalonWakilPresiden) {
                $data[$profilCalonWakilPresiden['nomor_urut']]["wakil_presiden"] = ProfilCalonDto::fromArray([
                    'posisi' => PosisiCalonEnum::WAKIL_PRESIDEN,
                    ...$profilCalonWakilPresiden
                ])->toArray();
            }

            return $data;
        } catch (ConnectionException|LostConnectionException $e) {
            report($e);

            return null;
        }
    }
}
