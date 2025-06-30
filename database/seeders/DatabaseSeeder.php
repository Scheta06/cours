<?php
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            VendorSeeder::class,
            FormSeeder::class,
            SocketSeeder::class,
            ChipsetSeeder::class,
            MemoryTypeSeeder::class,
            MemoryCapacitySeeder::class,
            ProcessorSeeder::class,
            MotherboardSeeder::class,
            CoolerSeeder::class,
            RamsSeeder::class,
            StorageSeeder::class,
            VideocardSeeder::class,
            PsuSeeder::class,
            ChassisSeeder::class,
            ConfigurationSeeder::class,
        ]);
    }
}
