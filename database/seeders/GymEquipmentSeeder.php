<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GymEquipmentSeeder extends Seeder
{
    public function run()
    {
        DB::table('alat_gyms')->insert([
            ['image_path' => 'images/home-image/alat-gym/exercise-mat.png', 'nama_alat' => 'Exercise Mat', 'deskripsi' => 'Comfortable mat for your workout sessions.', 'harga' => 5000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['image_path' => 'images/home-image/alat-gym/foam-roller.png', 'nama_alat' => 'Foam Roller', 'deskripsi' => 'Perfect for muscle relaxation and recovery.', 'harga' => 10000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['image_path' => 'images/home-image/alat-gym/weight-vest.png', 'nama_alat' => 'Weight Vest', 'deskripsi' => 'Increase intensity with this weight vest.', 'harga' => 15000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['image_path' => 'images/home-image/alat-gym/adjustable-dumbbells.png', 'nama_alat' => 'Adjustable Dumbbells', 'deskripsi' => 'Adjustable dumbbells for various exercises.', 'harga' => 20000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['image_path' => 'images/home-image/alat-gym/kettlebells-8kg.png', 'nama_alat' => 'Kettlebells 8kg', 'deskripsi' => '8kg kettlebell for strength training.', 'harga' => 20000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['image_path' => 'images/home-image/alat-gym/resistance-band.png', 'nama_alat' => 'Resistance Band', 'deskripsi' => 'Resistance band for mobility and strength.', 'harga' => 10000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}

