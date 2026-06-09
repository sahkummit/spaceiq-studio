<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Add Admin User
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@spaceiqstudio.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Default Services (Architectural Renderings)
        \App\Models\Service::create([
            'title' => 'Exterior & Interior Visualization',
            'slug' => 'architectural-rendering',
            'short_description' => 'Bring your structures to life before the first stone is laid with environmental storytelling.',
            'description' => "Bring your structures to life before the first stone is laid. Our rendering process focuses on environmental storytelling, ensuring your project feels grounded in its physical context.\n\nExterior Visuals: High-impact shots featuring realistic cobblestone driveways, manicured landscaping, and dynamic weather settings (Golden Hour, Twilight, or High Noon).\n\nInterior Detail: Focus on material honesty. We showcase the interplay of shadow and light on wood, stone, and glass to create atmosphere and depth.\n\nAtmospheric Elements: We add the \"human touch\"—modern vehicles, realistic people, and neighborhood contexts—to make the render feel lived-in and approachable.",
            'icon' => 'fa-solid fa-building',
            'sort_order' => 1
        ]);

        \App\Models\Service::create([
            'title' => '3D Modeling & Design Refinement',
            'slug' => 'precision-modeling',
            'short_description' => 'Precision modeling for complex architecture ensuring structural integrity.',
            'description' => "Every great render starts with a perfect model. We take your technical drawings and convert them into highly detailed 3D assets, ensuring structural integrity and aesthetic balance.\n\nMaterial Selection: Don't settle for \"stock\" textures. We apply custom-mapped materials to ensure your roofs, bricks, and finishes look indistinguishable from the real thing.\n\nLighting Studies: Visualizing how natural light interacts with your building throughout the day to optimize design choices.",
            'icon' => 'fa-solid fa-cube',
            'sort_order' => 2
        ]);
        
        \App\Models\Service::create([
            'title' => 'Virtual Walkthroughs',
            'slug' => 'virtual-walkthroughs',
            'short_description' => 'Interactive 360 experiences for real estate pre-sales and presentations.',
            'description' => "Allow your clients to physically step into your vision using our interactive 4K virtual tours. Hand-crafted lighting and precise material scales give unmatched presence.",
            'icon' => 'fa-solid fa-vr-cardboard',
            'sort_order' => 3
        ]);

        // Default Settings
        $settings = [
            // General
            ['group' => 'general', 'key' => 'site_name', 'value' => 'SpaceIQ Studio', 'type' => 'text'],
            ['group' => 'general', 'key' => 'seo_description', 'value' => 'Hyper-realistic 4K renders that captivate clients.', 'type' => 'textarea'],
            
            // Contact
            ['group' => 'contact', 'key' => 'contact_email', 'value' => 'hello@spaceiqstudio.com', 'type' => 'text'],
            ['group' => 'contact', 'key' => 'contact_phone', 'value' => '+1 (555) 123-4567', 'type' => 'text'],
            ['group' => 'contact', 'key' => 'office_address', 'value' => "100 Architectural Way\nSuite 4K\nNew York, NY 10001", 'type' => 'textarea'],
            
            // Social Defaults
            ['group' => 'social', 'key' => 'social_twitter', 'value' => 'https://twitter.com/spaceiqstudio', 'type' => 'text'],
            ['group' => 'social', 'key' => 'social_linkedin', 'value' => 'https://linkedin.com/company/spaceiq', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::create($setting);
        }

        // Privacy Policy
        \App\Models\Page::create([
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'content' => "<h1>Privacy Policy</h1>\n<p>This is a default privacy policy for SpaceIQ Studio.</p>",
            'meta_description' => 'Privacy policy and terms of service.',
            'is_published' => true
        ]);
    }
}
