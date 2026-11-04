<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = [
            [
                'name' => 'Al Rashid Construction Supplies',
                'email' => 'contact@alrashid.com',
                'mobile_number' => '+971501234567',
                'address' => 'Al Qusais, Dubai, UAE',
            ],
            [
                'name' => 'Gulf Steel Traders',
                'email' => 'sales@gulfsteel.com',
                'mobile_number' => '+971502345678',
                'address' => 'Al Quoz, Dubai, UAE',
            ],
            [
                'name' => 'Desert Cement Co.',
                'email' => 'info@desertcement.com',
                'mobile_number' => '+971503456789',
                'address' => 'Ras Al Khaimah, UAE',
            ],
            [
                'name' => 'Oasis Electricals',
                'email' => 'orders@oasiselectricals.com',
                'mobile_number' => '+971504567890',
                'address' => 'Sharjah, UAE',
            ],
        ];

        foreach ($vendors as $vendor) {
            Vendor::firstOrCreate(['email' => $vendor['email']], $vendor);
        }
    }
}
