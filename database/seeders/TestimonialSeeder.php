<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;
class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::create([
            'name' => 'أحمد محمد',
            'role' => 'مدير تسويق',
            'message' => 'تجربة رائعة بكل المقاييس! التصميم كان أكثر مما توقعت.',
            'rating' => 5,
            'is_active' => true,
        ]);

        Testimonial::create([
            'name' => 'سارة علي',
            'role' => 'صاحبة مشروع',
            'message' => 'خدمة ممتازة ولكن التوصيل تأخر قليلاً.',
            'rating' => 4,
            'is_active' => true,
        ]);
    }
}
