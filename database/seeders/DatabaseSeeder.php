<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Smartphone;
use App\Models\Specification;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Admin
        Admin::create([
            'username' => 'admin',
            'password' => 'admin123',
            'name' => 'Administrator'
        ]);

        // Seed Categories
        $categories = [
            ['name' => 'Gaming', 'description' => 'Smartphone untuk gaming dan performa tinggi'],
            ['name' => 'Fotografi', 'description' => 'Smartphone dengan kamera terbaik untuk photography'],
            ['name' => 'Bisnis', 'description' => 'Smartphone untuk kebutuhan profesional dan bisnis'],
            ['name' => 'Budget', 'description' => 'Smartphone dengan harga terjangkau namun berkualitas'],
            ['name' => 'Flagship', 'description' => 'Smartphone premium dengan fitur terlengkap dan terdepan']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Seed Specifications
        $specifications = [
            ['name' => 'Kamera', 'type' => 'camera', 'weight' => 0.20, 'description' => 'Kualitas kamera untuk fotografi dan videografi'],
            ['name' => 'Baterai', 'type' => 'battery', 'weight' => 0.25, 'description' => 'Daya tahan baterai untuk penggunaan sehari-hari'],
            ['name' => 'Performa', 'type' => 'performance', 'weight' => 0.25, 'description' => 'Kecepatan prosesor dan performa gaming'],
            ['name' => 'Desain', 'type' => 'design', 'weight' => 0.15, 'description' => 'Desain premium dan kualitas build'],
            ['name' => 'Konektivitas', 'type' => 'connectivity', 'weight' => 0.15, 'description' => '5G, WiFi, dan fitur konektivitas lainnya']
        ];

        foreach ($specifications as $spec) {
            Specification::create($spec);
        }

        // Seed Sample Smartphones
        $smartphones = [
            // Samsung
            ['brand' => 'Samsung', 'model' => 'Galaxy A26 5G', 'category_id' => 4, 'price_min' => 4400000, 'price_max' => 4400000, 'ram' => 8, 'storage' => 256, 'battery' => 5000, 'camera' => 50],
            ['brand' => 'Samsung', 'model' => 'Galaxy A56 5G', 'category_id' => 3, 'price_min' => 6700000, 'price_max' => 7200000, 'ram' => 8, 'storage' => 256, 'battery' => 5000, 'camera' => 50],
            ['brand' => 'Samsung', 'model' => 'Galaxy S25 Ultra', 'category_id' => 5, 'price_min' => 18500000, 'price_max' => 20500000, 'ram' => 12, 'storage' => 512, 'battery' => 5000, 'camera' => 200],
            
            // Xiaomi  
            ['brand' => 'Xiaomi', 'model' => 'Redmi Note 14 5G', 'category_id' => 4, 'price_min' => 3200000, 'price_max' => 3200000, 'ram' => 8, 'storage' => 256, 'battery' => 5110, 'camera' => 108],
            ['brand' => 'Xiaomi', 'model' => 'Redmi Note 14 Pro 5G', 'category_id' => 1, 'price_min' => 4000000, 'price_max' => 4000000, 'ram' => 8, 'storage' => 256, 'battery' => 5110, 'camera' => 200],
            ['brand' => 'Xiaomi', 'model' => '15 Ultra', 'category_id' => 5, 'price_min' => 19000000, 'price_max' => 19000000, 'ram' => 16, 'storage' => 512, 'battery' => 5400, 'camera' => 50],
            
            // Oppo
            ['brand' => 'Oppo', 'model' => 'A5 Pro 5G', 'category_id' => 4, 'price_min' => 3800000, 'price_max' => 3800000, 'ram' => 8, 'storage' => 256, 'battery' => 5800, 'camera' => 50],
            ['brand' => 'Oppo', 'model' => 'Reno 13 5G', 'category_id' => 2, 'price_min' => 9000000, 'price_max' => 9000000, 'ram' => 12, 'storage' => 256, 'battery' => 5600, 'camera' => 50],
            
            // Realme
            ['brand' => 'Realme', 'model' => '14 5G', 'category_id' => 4, 'price_min' => 4400000, 'price_max' => 4400000, 'ram' => 8, 'storage' => 256, 'battery' => 6000, 'camera' => 50],
            ['brand' => 'Realme', 'model' => 'GT 7', 'category_id' => 1, 'price_min' => 8600000, 'price_max' => 8600000, 'ram' => 12, 'storage' => 256, 'battery' => 7000, 'camera' => 50],
            
            // Vivo
            ['brand' => 'Vivo', 'model' => 'V50 5G', 'category_id' => 2, 'price_min' => 6000000, 'price_max' => 6000000, 'ram' => 8, 'storage' => 256, 'battery' => 6000, 'camera' => 50],
            ['brand' => 'Vivo', 'model' => 'X200 Pro', 'category_id' => 5, 'price_min' => 18000000, 'price_max' => 18000000, 'ram' => 16, 'storage' => 512, 'battery' => 6000, 'camera' => 50],
        ];

        foreach ($smartphones as $phone) {
            $phone['full_name'] = $phone['brand'] . ' ' . $phone['model'];
            $phone['is_active'] = true;
            Smartphone::create($phone);
        }
    }
}
