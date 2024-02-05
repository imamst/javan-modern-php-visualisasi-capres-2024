<?php

use App\Services\ProfilCalonService;
use Illuminate\Support\Facades\Http;

it('can get profil calon data', function () {
    // Mock the HTTP response
    Http::fake([
        'https://mocki.io/v1/92a1f2ef-bef2-4f84-8f06-1965f0fca1a7' => Http::response([
            "calon_presiden" => [
                [
                    "nomor_urut" => 1,
                    "nama_lengkap" => "Anies Rasyid Baswedan",
                    "tempat_tanggal_lahir" => "Kuningan, 7 Mei 1969",
                    "karir" => [
                        "Rektor Universitas Paramadina (2007-2013)",
                        "Menteri Pendidikan dan Kebudayaan (2014-2016)",
                        "Gubernur DKI Jakarta (2017-2022)"
                    ]
                ],
                [
                    "nomor_urut" => 3,
                    "nama_lengkap" => "Ganjar Pranowo",
                    "tempat_tanggal_lahir" => "Karang Anyar, 28 Oktober 1968",
                    "karir" => [
                        "Anggota DPR RI Fraksi PDI Perjuangan (2004-2009 dan 2009-2013)",
                        "Gubernur Jawa Tengah(2013-2023)"
                    ]
                ],
                [
                    "nomor_urut" => 2,
                    "nama_lengkap" => "Prabowo Subianto Djojohadikusumo",
                    "tempat_tanggal_lahir" => "Jakarta, 17 Oktober 1951",
                    "karir" => [
                        "Panglima Komando Cadangan Strategi TNI Angkatan Darat (1998)",
                        "Ketua Umum Partai Gerindra (2014-Sekarang)",
                        "Menteri Pertahanan (2019-2024)"
                    ]
                ]
                ],
            "calon_wakil_presiden" => [
                [
                    "nomor_urut" => 1,
                    "nama_lengkap" => "Abdul Muhaimin Iskandar",
                    "tempat_tanggal_lahir" => "Jombang, 24 September 1966",
                    "karir" => [
                        "Wakil Ketua DPR RI (2004-2009)",
                        "Menteri Tenaga Kerja dan Transmigrasi (2009-2014)",
                        "Ketua Umum PKB (2005-2010/2019-2024)",
                        "Wakil Ketua DPR RI (2019-2024)"
                    ]
                ],
                [
                    "nomor_urut" => 3,
                    "nama_lengkap" => "Mohammad Mahfud Mahmodin",
                    "tempat_tanggal_lahir" => "Madura, 13 Mei 1957",
                    "karir" => [
                        "Menteri Pertahanan Republik Indonesia (2000-2001)",
                        "Menteri Kehakiman dan Hak Asasi Manusia (2001-2002)",
                        "Ketua Mahkamah Konstitusi (2008-2013)",
                        "Menteri Koordinator Bidang Politik, Hukum dan Keamanan (2019-2024)"
                    ]
                ],
                [
                    "nomor_urut" => 2,
                    "nama_lengkap" => "Gibran Rakabuming Raka",
                    "tempat_tanggal_lahir" => "Surakarta, 1 Oktober 1987",
                    "karir" => [
                        "Wali Kota Solo (2021-2024)"
                    ]
                ]
            ]
        ]),
    ]);

    $profilCalonService = new ProfilCalonService();

    $result = $profilCalonService->getProfilCalonData();

    expect($result)->toBeArray();
});
