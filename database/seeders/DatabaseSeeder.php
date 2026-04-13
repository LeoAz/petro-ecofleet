<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Création des utilisateurs de base
        User::factory(10)->create();

        $this->call([
            // Données de base (indépendantes ou avec peu de dépendances)
            BrandSeeder::class,
            PatternSeeder::class,
            TypeSeeder::class,
            CustomerSeeder::class,
            TownSeeder::class,
            RoadSeeder::class,
            PlanSeeder::class,
            ProductSeeder::class,
            ProviderSeeder::class,
            GarageSeeder::class,
            CategorySeeder::class,
            MotifSeeder::class,

            // Données liées aux véhicules
            VehicleSeeder::class,
            TrailerSeeder::class,
            DriverSeeder::class,

            // Exploitation (dépend de Vehicle, Driver, Road, etc.)
            TripSeeder::class,
            ExpenseSeeder::class,
            FuelOrderSeeder::class,
            LoadSeeder::class,
            UnloadSeeder::class,

            // Maintenance et Stock (dépend de Vehicle, Garage, Category)
            PartSeeder::class,
            RepairSeeder::class,
            MaintenanceSeeder::class,
        ]);
    }
}
