<?php

namespace Database\Seeders;

use App\Models\AllowedIps;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllowedIpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // For Laravel homestead default IP
        DB::table('allowed_ips')->insert([
            'ip' => '192.168.56.1'
        ]);
        AllowedIps::factory()
            ->count(5)
            ->create();
    }
}
