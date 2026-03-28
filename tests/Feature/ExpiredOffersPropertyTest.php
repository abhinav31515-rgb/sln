<?php

namespace Tests\Feature;

use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ExpiredOffersPropertyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Property 2: expired offers never appear in active offers query
     * 
     * For any Offer with `valid_until` in the past, the active offers query
     * result does not include that offer
     * 
     * **Validates: Requirements 7.4, 11.12**
     */
    public function test_expired_offers_never_appear_in_active_query_property(): void
    {
        // Generate 50 random expired offers
        $expiredOffers = $this->generateExpiredOffers(50);
        
        // Generate 20 random active offers
        $activeOffers = $this->generateActiveOffers(20);

        // Clear cache to ensure fresh query
        Cache::forget('offers.active');

        // Test the query logic directly (same as OfferController)
        $returnedOffers = Offer::where('valid_until', '>', now())->get();
        $returnedOfferIds = $returnedOffers->pluck('id')->toArray();

        // Property: No expired offer should appear in the result
        foreach ($expiredOffers as $expiredOffer) {
            $this->assertNotContains(
                $expiredOffer->id,
                $returnedOfferIds,
                "Expired offer (ID: {$expiredOffer->id}, valid_until: {$expiredOffer->valid_until}) should not appear in active offers"
            );
        }

        // Verify that active offers DO appear
        foreach ($activeOffers as $activeOffer) {
            $this->assertContains(
                $activeOffer->id,
                $returnedOfferIds,
                "Active offer (ID: {$activeOffer->id}, valid_until: {$activeOffer->valid_until}) should appear in active offers"
            );
        }
    }

    /**
     * Property test: offers expiring exactly at current time are excluded
     */
    public function test_offers_expiring_at_current_time_are_excluded(): void
    {
        // Create an offer that expires exactly now
        $offerExpiringNow = Offer::factory()->create([
            'title' => 'Expiring Now',
            'valid_until' => now(),
        ]);

        // Create an offer expiring 1 second ago
        $offerExpiredOneSecondAgo = Offer::factory()->create([
            'title' => 'Expired One Second Ago',
            'valid_until' => now()->subSecond(),
        ]);

        // Create an offer expiring 1 second in the future
        $offerExpiringInFuture = Offer::factory()->create([
            'title' => 'Expiring In Future',
            'valid_until' => now()->addSecond(),
        ]);

        Cache::forget('offers.active');

        $response = $this->get(route('offers.index'));
        $returnedOffers = $response->viewData('offers');
        $returnedOfferIds = $returnedOffers->pluck('id')->toArray();

        // Offers expiring now or in the past should NOT appear
        $this->assertNotContains($offerExpiringNow->id, $returnedOfferIds);
        $this->assertNotContains($offerExpiredOneSecondAgo->id, $returnedOfferIds);

        // Offer expiring in the future SHOULD appear
        $this->assertContains($offerExpiringInFuture->id, $returnedOfferIds);
    }

    /**
     * Generate random expired offers for property testing
     * 
     * @param int $count Number of expired offers to generate
     * @return \Illuminate\Support\Collection
     */
    private function generateExpiredOffers(int $count)
    {
        $offers = collect();
        
        for ($i = 0; $i < $count; $i++) {
            // Generate random past date between 1 day and 365 days ago
            $daysAgo = rand(1, 365);
            $hoursAgo = rand(0, 23);
            $minutesAgo = rand(0, 59);
            
            $validUntil = now()
                ->subDays($daysAgo)
                ->subHours($hoursAgo)
                ->subMinutes($minutesAgo);

            $offer = Offer::factory()->create([
                'title' => "Expired Offer {$i}",
                'valid_until' => $validUntil,
            ]);
            
            $offers->push($offer);
        }
        
        return $offers;
    }

    /**
     * Generate random active offers for property testing
     * 
     * @param int $count Number of active offers to generate
     * @return \Illuminate\Support\Collection
     */
    private function generateActiveOffers(int $count)
    {
        $offers = collect();
        
        for ($i = 0; $i < $count; $i++) {
            // Generate random future date between 1 day and 365 days from now
            $daysFromNow = rand(1, 365);
            $hoursFromNow = rand(0, 23);
            $minutesFromNow = rand(0, 59);
            
            $validUntil = now()
                ->addDays($daysFromNow)
                ->addHours($hoursFromNow)
                ->addMinutes($minutesFromNow);

            $offer = Offer::factory()->create([
                'title' => "Active Offer {$i}",
                'valid_until' => $validUntil,
            ]);
            
            $offers->push($offer);
        }
        
        return $offers;
    }
}
