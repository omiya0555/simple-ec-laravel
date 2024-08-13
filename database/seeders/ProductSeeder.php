<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // DBファサードをインポート

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $militaryGoods = [
            [
                'title' => 'タクティカルリュック',
                'description' => 'Durable and spacious backpack designed for military and outdoor activities.',
                'price' => 12000,
                'image_path' => 'images/tactical_backpack.png',
            ],
            [
                'title' => '戦闘用ブーツ',
                'description' => 'High-quality boots providing excellent grip and ankle support.',
                'price' => 15000,
                'image_path' => 'images/combat_boots.png',
            ],
            [
                'title' => '偽装用ジャケット',
                'description' => 'Water-resistant jacket with a camouflage pattern, ideal for outdoor missions.',
                'price' => 8000,
                'image_path' => 'images/camouflage_jacket.png',
            ],
            [
                'title' => '暗視ゴーグル',
                'description' => 'Advanced night vision goggles for enhanced visibility in low-light conditions.',
                'price' => 45000,
                'image_path' => 'images/night_vision_goggles.png',
            ],
            [
                'title' => 'タクティカルベルト',
                'description' => 'Sturdy belt designed to hold essential tools and accessories securely.',
                'price' => 3000,
                'image_path' => 'images/tactical_belt.png',
            ],
        ];

        DB::table('products')->insert($militaryGoods);
    }
}
