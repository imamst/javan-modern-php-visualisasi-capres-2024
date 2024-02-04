<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class KarirCalonDto extends Data
{
    public function __construct(
        public string $jabatan,
        public int $tahunMulai,
        public int | string | null $tahunSelesai
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['jabatan'],
            $data['tahunMulai'],
            strlen($data['tahunSelesai']) === 4 ? intval($data['tahunSelesai']) : $data['tahunSelesai']
        );
    }
}
