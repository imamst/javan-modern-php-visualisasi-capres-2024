<x-guest-layout>
    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-2 ">
                @foreach ($dataProfilCalon as $index => $dataProfil)
                <div class="col-span-2 p-4 text-center">
                    <h3 class="text-4xl font-bold">{{ $index }}</h3>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col gap-y-2 items-center border border-gray-100">
                    <p class="font-bold">{{ $dataProfil['presiden']['namaLengkap'] }}</p>
                    <p class="font-bold">{{ $dataProfil['presiden']['tempatLahir'].' '.$dataProfil['presiden']['tanggalLahirText'] }}</p>
                    <p class="font-bold">{{ $dataProfil['presiden']['umur'] }} Tahun</p>
                    <div class="mt-4">
                        <p class="font-bold">Karir</p>
                        @foreach ($dataProfil['presiden']['karir'] as $karir)
                            <p>- {{ $karir['jabatan'] }} ({{ $karir['tahunMulai'] }}{{ isset($karir['tahunSelesai']) ? ' - '.$karir['tahunSelesai'] : '' }})</p>
                        @endforeach
                    </div>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col gap-y-2 items-center border border-gray-100">
                    <p class="font-bold">{{ $dataProfil['wakil_presiden']['namaLengkap'] }}</p>
                    <p class="font-bold">{{ $dataProfil['wakil_presiden']['tempatLahir'].' '.$dataProfil['wakil_presiden']['tanggalLahirText'] }}</p>
                    <p class="font-bold">{{ $dataProfil['wakil_presiden']['umur'] }} Tahun</p>
                    <div class="mt-4">
                        <p class="font-bold">Karir</p>
                        @foreach ($dataProfil['wakil_presiden']['karir'] as $karir)
                            <p>- {{ $karir['jabatan'] }} ({{ $karir['tahunMulai'] }}{{ isset($karir['tahunSelesai']) ? ' - '.$karir['tahunSelesai'] : '' }})</p>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-guest-layout>
