<?php

use Illuminate\Database\Seeder;
use App\ShippingStatus;

class ShippingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'code' => 'POS',
                'name' => 'POSTING LOKET',
                'description' => 'Paket Telah Diterima Oleh Loket',
            ],
            [
                'code' => 'SRT-WRH',
                'name' => 'SORTING GUDANG',
                'description' => 'Paket Sedang Disorting Digudang',
            ],
            [
                'code' => 'DLV-WRH',
                'name' => 'PAKET DALAM PERJALANAN',
                'description' => 'Paket Dalam Perjalanan',
            ],
            [
                'code' => 'RCV-WRH',
                'name' => 'PAKET DITERIMA OLEH GUDANG',
                'description' => 'Paket Telah Diterima Oleh Gudang',
            ],
            [
                'code' => 'DLV-CST',
                'name' => 'PAKET DALAM PERJALANAN KE TUJUAN',
                'description' => 'Paket Sedang Dikirim Oleh Kurir Ke Lokasi Customer',
            ],
            [
                'code' => 'ARV',
                'name' => 'PAKET TELAH DITERIMA',
                'description' => 'Paket Telah Diterima Oleh Customer',
            ],
            [
                'code' => 'FLD-BLM',
                'name' => 'PAKET GAGAL - KENDALA BENCANA ALAM',
                'description' => 'Paket Gagal dikirim Karena Kendala Bencana Alam',
            ],
            [
                'code' => 'RET-CST',
                'name' => 'PAKET GAGAL DIKIRIM - CUSTOMER NOT FOUND',
                'description' => 'Paket Kembali ke gudang karena customer tidak ada di lokasi',
            ]
        ];
        echo "****************************\n";
        echo "*********SHIPING STATUS*****\n";
        echo "****************************\n";
        foreach ($data as $item) {

            $created = ShippingStatus::create($item);
            if ( $created ) {
                $code = $created->code;
                echo "SUCCESS - Shipping Status Created CODE: $code \n";
            } else {
                $code = $item['code'];
                echo "FAILED - Shipping Status Failed CODE: $code\n";

            }
        }
        echo "****************************\n";
    }
}
