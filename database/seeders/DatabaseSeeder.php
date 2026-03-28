<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@aurumstudio.in',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $services = [
            ['name'=>'Signature Facial','category'=>'skin','duration'=>60,'price'=>3200,'image'=>null,'description'=>'Deep cleanse, tone & nourish with luxury botanicals'],
            ['name'=>'Hair Couture','category'=>'hair','duration'=>90,'price'=>4500,'image'=>null,'description'=>'Precision cut & style by master stylists'],
            ['name'=>'Hot Stone Massage','category'=>'body','duration'=>75,'price'=>5800,'image'=>null,'description'=>'Volcanic stone therapy for deep muscle release'],
            ['name'=>'Nail Artistry','category'=>'nails','duration'=>45,'price'=>1800,'image'=>null,'description'=>'Bespoke nail art with luxury gel formulations'],
            ['name'=>'Bridal Package','category'=>'bridal','duration'=>300,'price'=>28000,'image'=>null,'description'=>'Full bridal preparation — hair, makeup, nails'],
            ['name'=>'Scalp Ritual','category'=>'hair','duration'=>45,'price'=>2600,'image'=>null,'description'=>'Therapeutic scalp treatment with Ayurvedic oils'],
            ['name'=>'The Gold Leaf Ritual','category'=>'body','duration'=>120,'price'=>12000,'image'=>null,'description'=>'24-karat gold-infused facial + scalp therapy + champagne welcome.'],
            ['name'=>'Himalayan Salt Journey','category'=>'body','duration'=>90,'price'=>8500,'image'=>null,'description'=>'Detoxifying salt cave exfoliation followed by deep-tissue massage.'],
        ];
        
        $category = \App\Models\Category::create([
            'name' => 'General Services',
            'slug' => 'general-services',
            'description' => 'General luxury treatments',
        ]);

        foreach ($services as $service) {
            \App\Models\Service::create([
                'category_id' => $category->id,
                'name' => $service['name'],
                'duration_minutes' => $service['duration'],
                'price' => $service['price'],
                'image_url' => $service['image'],
                'description' => $service['description'],
            ]);
        }

        $admin = \App\Models\User::first();
        $therapists = [
            ['specialty'=>'Facial & Skin','bio'=>'Certified aesthetic therapist with 8 years at luxury spas across London & Mumbai.','avatar_url'=>null],
            ['specialty'=>'Hair Artistry','bio'=>'Award-winning stylist trained at Toni & Guy International.','avatar_url'=>null],
            ['specialty'=>'Body Rituals','bio'=>'Master bodywork therapist, specialist in Ayurvedic and Thai techniques.','avatar_url'=>null],
        ];

        foreach ($therapists as $therapistData) {
            // Create a user for each therapist
            $user = \App\Models\User::factory()->create([
                'role' => 'therapist',
            ]);
            
            \App\Models\Therapist::create([
                'user_id' => $user->id,
                'specialty' => $therapistData['specialty'],
                'bio' => $therapistData['bio'],
                'avatar_url' => $therapistData['avatar_url'],
            ]);
        }

        $products = [
            ['name'=>'Gold Serum Elixir','category'=>'skin','price'=>4800,'stock'=>24,'description'=>'Luxury skin hydration','image_url'=>null],
            ['name'=>'Repair Hair Masque','category'=>'hair','price'=>2200,'stock'=>15,'description'=>'Intensive protein repair treatment for all hair types','image_url'=>null],
            ['name'=>'Rose Body Oil','category'=>'body','price'=>3600,'stock'=>30,'description'=>'Damascus rose infused luxury body oil','image_url'=>null],
            ['name'=>'Cuticle Renewal Balm','category'=>'tools','price'=>980,'stock'=>50,'description'=>'Nourishing cuticle balm with vitamin E','image_url'=>null],
            ['name'=>'Charcoal Cleanser','category'=>'skin','price'=>1800,'stock'=>18,'description'=>'Deep pore cleansing activated charcoal face wash.','image_url'=>null],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }

        $offers = [
            ['title'=>'Summer Glow Package','discount_percentage'=>30,'discount_code'=>'GLOW30','valid_until'=>now()->addMonths(3)],
            ['title'=>'Couples Ritual','discount_percentage'=>15,'discount_code'=>'COUPLE15','valid_until'=>now()->addMonths(2)],
        ];

        foreach ($offers as $offer) {
            \App\Models\Offer::create($offer);
        }

        // Seed Memberships
        \App\Models\Membership::factory()->count(3)->create();

        // Seed Journal Posts
        \App\Models\JournalPost::factory()->count(8)->create();

        // Seed Schedules for therapists
        $therapistModels = \App\Models\Therapist::all();
        foreach ($therapistModels as $therapist) {
            // Create schedules for Monday to Friday (1-5)
            for ($day = 1; $day <= 5; $day++) {
                \App\Models\Schedule::create([
                    'therapist_id' => $therapist->id,
                    'day_of_week' => $day,
                    'start_time' => '09:00:00',
                    'end_time' => '18:00:00',
                ]);
            }
        }

        // Seed Bookings
        $users = \App\Models\User::all();
        $services = \App\Models\Service::all();
        $therapistModels = \App\Models\Therapist::all();
        
        for ($i = 0; $i < 10; $i++) {
            \App\Models\Booking::factory()->create([
                'user_id' => $users->random()->id,
                'service_id' => $services->random()->id,
                'therapist_id' => $therapistModels->random()->id,
            ]);
        }

        // Seed SiteIdentity with all 24 keys
        $identityKeys = [
            // Brand
            'brand_name' => 'AURUM',
            'brand_accent_index' => '2',
            'tagline' => 'Luxury Unisex Salon',
            'city' => 'Gurugram',
            
            // Hero
            'hero_headline' => 'Where Luxury Meets Wellness',
            'hero_subheadline' => 'Experience world-class spa treatments in the heart of Gurugram',
            'hero_cta_label' => 'Book Your Experience',
            'hero_stat_1_value' => '500+',
            'hero_stat_1_label' => 'Happy Clients',
            'hero_stat_2_value' => '50+',
            'hero_stat_2_label' => 'Premium Services',
            'hero_stat_3_value' => '15+',
            'hero_stat_3_label' => 'Expert Therapists',
            'hero_stat_4_value' => '10+',
            'hero_stat_4_label' => 'Years Experience',
            
            // Contact
            'contact_phone' => '+91 124 4567890',
            'contact_email' => 'hello@aurumstudio.in',
            'contact_address' => 'DLF Phase 2, Gurugram, Haryana 122002',
            
            // Social
            'social_instagram' => 'https://instagram.com/aurumstudio',
            'social_facebook' => 'https://facebook.com/aurumstudio',
            'social_twitter' => 'https://twitter.com/aurumstudio',
            
            // Footer
            'footer_copyright' => '© 2025 AURUM. All rights reserved.',
            'footer_tagline' => 'Elevating beauty, one treatment at a time',
            'footer_city' => 'Gurugram, India',
        ];

        foreach ($identityKeys as $key => $value) {
            \App\Models\SiteIdentity::create([
                'key' => $key,
                'value' => $value,
            ]);
        }

        // Seed PageSeo records for 5 routes
        $this->seedPageSeo();
    }

    /**
     * Seed PageSeo records with JSON-LD schemas
     */
    private function seedPageSeo(): void
    {
        // Home route with LocalBusiness JSON-LD
        \App\Models\PageSeo::create([
            'route_name' => 'home',
            'title' => 'AURUM - Luxury Unisex Salon in Gurugram',
            'description' => 'Experience world-class spa treatments, premium hair care, and luxury wellness services at AURUM, Gurugram\'s premier unisex salon.',
            'og_title' => 'AURUM - Luxury Unisex Salon in Gurugram',
            'og_description' => 'Experience world-class spa treatments, premium hair care, and luxury wellness services at AURUM, Gurugram\'s premier unisex salon.',
            'og_image' => null,
            'twitter_card' => 'summary_large_image',
            'twitter_title' => 'AURUM - Luxury Unisex Salon in Gurugram',
            'twitter_description' => 'Experience world-class spa treatments, premium hair care, and luxury wellness services at AURUM, Gurugram\'s premier unisex salon.',
            'json_ld' => [
                '@context' => 'https://schema.org',
                '@type' => 'LocalBusiness',
                'name' => 'AURUM',
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => 'DLF Phase 2',
                    'addressLocality' => 'Gurugram',
                    'addressRegion' => 'Haryana',
                    'postalCode' => '122002',
                    'addressCountry' => 'IN',
                ],
                'telephone' => '+91 124 4567890',
                'url' => url('/'),
                'openingHours' => 'Mo-Su 09:00-20:00',
            ],
            'llm_summary' => 'AURUM is a luxury unisex salon in Gurugram offering premium spa treatments, hair care, body rituals, and wellness services. We specialize in signature facials, hot stone massage, bridal packages, and gold-infused treatments.',
            'llm_keywords' => 'luxury salon Gurugram, spa treatments, unisex salon, hair care, body massage, facial treatments, bridal packages, wellness center, premium beauty services',
            'canonical_url' => url('/'),
            'robots' => 'index, follow',
            'updated_at' => now(),
        ]);

        // Services index with Service schema array
        $services = \App\Models\Service::all();
        $serviceSchemas = $services->map(function ($service) {
            return [
                '@type' => 'Service',
                'name' => $service->name,
                'description' => $service->description,
                'offers' => [
                    '@type' => 'Offer',
                    'price' => $service->price,
                    'priceCurrency' => 'INR',
                ],
            ];
        })->toArray();

        \App\Models\PageSeo::create([
            'route_name' => 'services.index',
            'title' => 'Our Services - AURUM Luxury Salon',
            'description' => 'Explore our range of premium spa and wellness services including facials, massages, hair treatments, and bridal packages.',
            'og_title' => 'Our Services - AURUM Luxury Salon',
            'og_description' => 'Explore our range of premium spa and wellness services including facials, massages, hair treatments, and bridal packages.',
            'og_image' => null,
            'twitter_card' => 'summary_large_image',
            'twitter_title' => 'Our Services - AURUM Luxury Salon',
            'twitter_description' => 'Explore our range of premium spa and wellness services including facials, massages, hair treatments, and bridal packages.',
            'json_ld' => [
                '@context' => 'https://schema.org',
                '@type' => 'ItemList',
                'itemListElement' => $serviceSchemas,
            ],
            'llm_summary' => 'Browse AURUM\'s comprehensive service menu featuring signature facials, therapeutic massages, hair artistry, nail care, and exclusive bridal packages. All treatments use premium products and are performed by certified therapists.',
            'llm_keywords' => 'spa services Gurugram, facial treatments, massage therapy, hair salon services, bridal packages, luxury treatments, wellness services',
            'canonical_url' => route('services.index'),
            'robots' => 'index, follow',
            'updated_at' => now(),
        ]);

        // Products index
        \App\Models\PageSeo::create([
            'route_name' => 'products.index',
            'title' => 'Premium Products - AURUM',
            'description' => 'Shop our curated collection of luxury skincare, haircare, and wellness products from leading international brands.',
            'og_title' => 'Premium Products - AURUM',
            'og_description' => 'Shop our curated collection of luxury skincare, haircare, and wellness products from leading international brands.',
            'og_image' => null,
            'twitter_card' => 'summary_large_image',
            'twitter_title' => 'Premium Products - AURUM',
            'twitter_description' => 'Shop our curated collection of luxury skincare, haircare, and wellness products from leading international brands.',
            'json_ld' => null,
            'llm_summary' => 'AURUM offers a carefully selected range of premium beauty and wellness products including gold serums, hair repair treatments, body oils, and skincare essentials.',
            'llm_keywords' => 'luxury beauty products, skincare products, hair care products, body oils, premium cosmetics, salon products',
            'canonical_url' => route('products.index'),
            'robots' => 'index, follow',
            'updated_at' => now(),
        ]);

        // Journal index
        \App\Models\PageSeo::create([
            'route_name' => 'journal.index',
            'title' => 'Wellness Journal - AURUM',
            'description' => 'Discover expert tips, beauty trends, and wellness advice from our team of certified therapists and beauty professionals.',
            'og_title' => 'Wellness Journal - AURUM',
            'og_description' => 'Discover expert tips, beauty trends, and wellness advice from our team of certified therapists and beauty professionals.',
            'og_image' => null,
            'twitter_card' => 'summary_large_image',
            'twitter_title' => 'Wellness Journal - AURUM',
            'twitter_description' => 'Discover expert tips, beauty trends, and wellness advice from our team of certified therapists and beauty professionals.',
            'json_ld' => null,
            'llm_summary' => 'The AURUM Wellness Journal features articles on skincare routines, spa treatment benefits, self-care practices, and the latest beauty trends curated by our expert team.',
            'llm_keywords' => 'wellness blog, beauty tips, skincare advice, spa treatments guide, self-care, beauty trends, health and wellness',
            'canonical_url' => route('journal.index'),
            'robots' => 'index, follow',
            'updated_at' => now(),
        ]);

        // Bookings create
        \App\Models\PageSeo::create([
            'route_name' => 'bookings.create',
            'title' => 'Book Your Appointment - AURUM',
            'description' => 'Schedule your luxury spa experience at AURUM. Choose your preferred service, therapist, and time slot for a personalized wellness journey.',
            'og_title' => 'Book Your Appointment - AURUM',
            'og_description' => 'Schedule your luxury spa experience at AURUM. Choose your preferred service, therapist, and time slot for a personalized wellness journey.',
            'og_image' => null,
            'twitter_card' => 'summary_large_image',
            'twitter_title' => 'Book Your Appointment - AURUM',
            'twitter_description' => 'Schedule your luxury spa experience at AURUM. Choose your preferred service, therapist, and time slot for a personalized wellness journey.',
            'json_ld' => null,
            'llm_summary' => 'Book your appointment at AURUM with our easy online booking system. Select from our range of services, choose your preferred therapist, and pick a convenient time slot.',
            'llm_keywords' => 'book spa appointment, salon booking Gurugram, schedule treatment, online booking, spa reservation, beauty appointment',
            'canonical_url' => route('bookings.create'),
            'robots' => 'index, follow',
            'updated_at' => now(),
        ]);
    }
}
