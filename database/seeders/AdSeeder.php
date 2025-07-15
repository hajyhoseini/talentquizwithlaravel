<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Ad;

class AdSeeder extends Seeder
{
    public function run(): void
    {
        $ads = [
            [
                'number' => '09121234567',
                'operator' => 'mci',
                'price' => 10000,
                'voice_url' => null,
                'video_url' => null,
            ],
            [
                'number' => '09351234567',
                'operator' => 'irancell',
                'price' => 15000,
                'voice_url' => 'https://example.com/audio.mp3',
                'video_url' => null,
            ],
            [
                'number' => '09221234567',
                'operator' => 'rightel',
                'price' => 12000,
                'voice_url' => null,
                'video_url' => 'https://example.com/video.mp4',
            ],
        ];

        foreach ($ads as $ad) {
            Ad::create($ad);
        }
    }
}

