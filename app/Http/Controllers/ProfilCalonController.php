<?php

namespace App\Http\Controllers;

use App\Services\ProfilCalonService;
use Illuminate\View\View;

class ProfilCalonController extends Controller
{
    public $profilCalonService;

    public function __construct()
    {
        $this->profilCalonService = new ProfilCalonService();
    }

    public function __invoke(): View
    {
        $dataProfilCalon = $this->profilCalonService->getProfilCalonData();

        if ($dataProfilCalon) {
            ksort($dataProfilCalon);
        }

        return view('welcome', [
            'dataProfilCalon' => $dataProfilCalon
        ]);
    }
}
