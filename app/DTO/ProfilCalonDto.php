<?php

namespace App\Dto;

use App\Enum\PosisiCalonEnum;
use App\Services\DateService;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class ProfilCalonDto extends Data
{
    public function __construct(
        public PosisiCalonEnum $posisi,
        public int $nomorUrut,
        public string $namaLengkap,
        public string $tempatLahir,
        public Carbon $tanggalLahir,
        #[DataCollectionOf(KarirCalonDto::class)]
        public DataCollection $karir,
        public string $tanggalLahirText,
        public int $umur
    ){}

    public static function fromArray(array $data): self
    {
        $tanggalLahirCarbon = static::extractTanggalLahir($data['tempat_tanggal_lahir']);

        return new self(
            $data['posisi'],
            $data['nomor_urut'],
            $data['nama_lengkap'],
            static::extractTempatLahir($data['tempat_tanggal_lahir']),
            $tanggalLahirCarbon,
            static::parseKarir($data['karir']),
            static::parseTanggalLahir($tanggalLahirCarbon),
            static::hitungUmur($tanggalLahirCarbon)
        );
    }

    protected static function extractTempatLahir(string $tempatTanggalLahir): string
    {
        $parts = explode(',', $tempatTanggalLahir);
        return trim($parts[0]);
    }

    protected static function extractTanggalLahir(string $tempatTanggalLahir): Carbon
    {
        $parts = explode(',', $tempatTanggalLahir);
        $tanggalLahir = trim($parts[1]);

        return DateService::parseIndonesianDate($tanggalLahir);
    }

    protected static function parseTanggalLahir(Carbon $tanggalLahir): string
    {
        return $tanggalLahir->isoFormat('D MMMM Y');
    }

    protected static function hitungUmur(Carbon $tanggalLahir): int
    {
        return $tanggalLahir->age;
    }

    protected static function parseKarir(array $careers): DataCollection
    {
        $karirCalonCollection = KarirCalonDto::collection([]);

        foreach ($careers as $career) {
            $splitCareer = explode('(', $career, 2);
            $tahunMenjabatRaw = str_replace(' dan ', '/', $splitCareer[1]);

            $splitJumlahPeriodeMenjabat = explode('/', $tahunMenjabatRaw);

            $splitTahunPeriodeMenjabat = explode('-', $splitJumlahPeriodeMenjabat[0], 2);
            $tahunAkhirPeriodeMenjabat = isset($splitTahunPeriodeMenjabat[1]) ?
                                        str_replace(')', '', $splitTahunPeriodeMenjabat[1])
                                        : null;

            $karirCalonCollection[] = [
                'jabatan' => trim($splitCareer[0]),
                'tahunMulai' => intval($splitTahunPeriodeMenjabat[0]),
                'tahunSelesai' => $tahunAkhirPeriodeMenjabat,
            ];

            if (count($splitJumlahPeriodeMenjabat) > 1) {
                $splitTahunPeriodeKeduaMenjabat = explode('-', $splitJumlahPeriodeMenjabat[1], 2);
                $tahunAkhirPeriodeKeduaMenjabat = isset($splitTahunPeriodeKeduaMenjabat[1]) ?
                                                str_replace(')', '', $splitTahunPeriodeKeduaMenjabat[1])
                                                : null;

                $karirCalonCollection[] = [
                    'jabatan' => trim($splitCareer[0]),
                    'tahunMulai' => intval($splitTahunPeriodeKeduaMenjabat[0]),
                    'tahunSelesai' => $tahunAkhirPeriodeKeduaMenjabat,
                ];
            }
        }

        return $karirCalonCollection;
    }
}
