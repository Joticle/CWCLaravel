<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();

        Setting::create(['title' => config('app.name'), 'primary_color' => '#074a74','secondary_color' => '#074a74', 'short_desc' => 'We are passionate education dedicated to providing high-quality resources learners all backgrounds.', 'description' => '<h2 class="title">What is College For World Connections?</h2>
        <p class="post-title">College for World Connections Center for Innovation &amp; Learning is
            a full-service Educator
            Ecosystem for teaching and empowering adults, professionals, and teams in Leadership
            Principles. In
            partnership with Joticle, Inc., our academic instructors dedicate their knowledge
            and expertise to improving
            the lives of others through leadership instruction, creative and critical thinking
            development, and world
            schooling. Leaders RISE and become empowered in a learner friendly, educator
            respected, and educationally
            elevated platform. </p>', 'owner_name' => 'Dr Susan', 'owner_designation' => 'CEO, College For World Connections']);
    }
}
