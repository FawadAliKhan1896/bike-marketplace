<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ad;
use App\Models\Dealership;
use App\Models\CalculatorModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Admin User
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // 2. Seed Test User
        $testUser = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        // 3. Seed other users
        $users = User::factory(5)->create();

        // 4. Seed Dealerships
        Dealership::create([
            'name' => 'Lahore Honda Center',
            'email' => 'info@lahorehonda.com',
            'phone' => '042-35801122',
            'address' => '54-A, Jail Road, Gulberg V',
            'city' => 'Lahore',
            'logo' => null,
            'website_url' => 'https://honda.com.pk',
            'description' => 'Official 3S Dealership of Atlas Honda. Specialized in brand new CD 70, CG 125, CB 150F. Offers tuning and certified spare parts.',
            'is_featured' => true,
        ]);

        Dealership::create([
            'name' => 'Yamaha Motospot Karachi',
            'email' => 'sales@yamahakarachi.com',
            'phone' => '021-34320099',
            'address' => 'Main Shahrah-e-Faisal, P.E.C.H.S',
            'city' => 'Karachi',
            'logo' => null,
            'website_url' => 'https://yamaha-motor.com.pk',
            'description' => 'Authorized premium dealership of Yamaha Pakistan. Home of YBR 125, YBR 125G and custom sports accessories.',
            'is_featured' => true,
        ]);

        Dealership::create([
            'name' => 'Suzuki Superbikes Islamabad',
            'email' => 'contact@suzuki-islamabad.com',
            'phone' => '051-2280044',
            'address' => 'Plot 18, G-9 Markaz',
            'city' => 'Islamabad',
            'logo' => null,
            'website_url' => 'https://suzukipakistan.com',
            'description' => 'Certified high-performance Suzuki dealer. We sell GD 110S, GS 150, GR 150 and heavy bikes (Inazuma, Hayabusa).',
            'is_featured' => true,
        ]);

        Dealership::create([
            'name' => 'Chongqing Rider Zone Faisalabad',
            'email' => 'faisalabad@chongqing.com',
            'phone' => '041-8812233',
            'address' => 'Sargodha Road, near Motorway exit',
            'city' => 'Faisalabad',
            'logo' => null,
            'description' => 'Local distributor for Chinese import bikes and Chongqing accessories. Low price and reliable maintenance center.',
            'is_featured' => false,
        ]);

        Dealership::create([
            'name' => 'Electric Ride Point Rawalpindi',
            'email' => 'rawalpindi@electricride.com',
            'phone' => '051-4422998',
            'address' => 'Murree Road, Saddar',
            'city' => 'Rawalpindi',
            'logo' => null,
            'description' => 'All major EV scooter brands (Vlektra, Ezo, Jolta). Eco-friendly electric bikes with long-lasting lithium batteries.',
            'is_featured' => false,
        ]);

        // 5. Seed Calculator Rules
        CalculatorModel::create(['brand' => 'Honda', 'model' => 'CD 70', 'base_price' => 157900, 'depreciation_rate' => 0.06]);
        CalculatorModel::create(['brand' => 'Honda', 'model' => 'CG 125', 'base_price' => 234900, 'depreciation_rate' => 0.08]);
        CalculatorModel::create(['brand' => 'Honda', 'model' => 'CB 150F', 'base_price' => 493900, 'depreciation_rate' => 0.10]);
        CalculatorModel::create(['brand' => 'Yamaha', 'model' => 'YBR 125', 'base_price' => 415000, 'depreciation_rate' => 0.08]);
        CalculatorModel::create(['brand' => 'Yamaha', 'model' => 'YBR 125G', 'base_price' => 453000, 'depreciation_rate' => 0.09]);
        CalculatorModel::create(['brand' => 'Suzuki', 'model' => 'GD 110S', 'base_price' => 352000, 'depreciation_rate' => 0.07]);
        CalculatorModel::create(['brand' => 'Suzuki', 'model' => 'GS 150', 'base_price' => 382000, 'depreciation_rate' => 0.08]);
        CalculatorModel::create(['brand' => 'Suzuki', 'model' => 'GR 150', 'base_price' => 547000, 'depreciation_rate' => 0.11]);

        // 6. Seed Test Advertisements
        $allUsers = $users->concat([$testUser]);
        
        Ad::create([
            'user_id' => $allUsers->random()->id,
            'title' => 'Honda CG 125 Self Start 2024 model',
            'description' => 'Selling my Honda CG 125 self-start red color. Excellent condition, only 4,000 km driven. Brand new tires, oil changed recently. First owner, smart card available.',
            'price' => 220000,
            'brand' => 'Honda',
            'model' => 'CG 125',
            'year' => 2024,
            'condition' => 'Used',
            'location' => 'Lahore',
            'image' => null,
            'views' => 142,
            'engagement' => 12,
            'is_active' => true,
        ]);

        Ad::create([
            'user_id' => $allUsers->random()->id,
            'title' => 'Yamaha YBR 125G Black Edition 2023',
            'description' => 'Perfect sporty look, black color YBR 125G. Mileage is around 45km/L. Engine runs smooth. Driven in Islamabad only. Fully maintained from Yamaha authorized showroom.',
            'price' => 380000,
            'brand' => 'Yamaha',
            'model' => 'YBR 125G',
            'year' => 2023,
            'condition' => 'Used',
            'location' => 'Islamabad',
            'image' => null,
            'views' => 280,
            'engagement' => 24,
            'is_active' => true,
        ]);

        Ad::create([
            'user_id' => $allUsers->random()->id,
            'title' => 'Suzuki GS 150 Custom Modified Cruiser',
            'description' => 'Modified GS 150 with cruiser handlebar, alloy rims, wide back tire and custom exhaust. Great comfort for long tours. Smart card and lifetime token tax paid.',
            'price' => 310000,
            'brand' => 'Suzuki',
            'model' => 'GS 150',
            'year' => 2021,
            'condition' => 'Used',
            'location' => 'Rawalpindi',
            'image' => null,
            'views' => 95,
            'engagement' => 8,
            'is_active' => true,
        ]);

        Ad::create([
            'user_id' => $allUsers->random()->id,
            'title' => 'Honda CD 70 2025 model (Zero Meter)',
            'description' => 'Unregistered brand new CD 70 black color. Zero meter bike, won in a lucky draw. Selling urgently. All files and books are ready to register.',
            'price' => 150000,
            'brand' => 'Honda',
            'model' => 'CD 70',
            'year' => 2025,
            'condition' => 'New',
            'location' => 'Karachi',
            'image' => null,
            'views' => 15,
            'engagement' => 1,
            'is_active' => false, // PENDING APPROVAL FOR ADMIN DEMO
        ]);

        Ad::create([
            'user_id' => $allUsers->random()->id,
            'title' => 'Suzuki GR 150 pristine condition 2022',
            'description' => 'Selling my daily commuter Suzuki GR 150. Sparingly used, 15,000 km. Bike is clean, no accidents, first owner. Tuning history available. Price is slightly negotiable.',
            'price' => 415000,
            'brand' => 'Suzuki',
            'model' => 'GR 150',
            'year' => 2022,
            'condition' => 'Used',
            'location' => 'Lahore',
            'image' => null,
            'views' => 54,
            'engagement' => 3,
            'is_active' => false, // PENDING APPROVAL FOR ADMIN DEMO
        ]);
    }
}
