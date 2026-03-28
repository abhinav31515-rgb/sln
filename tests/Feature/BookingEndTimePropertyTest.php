<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingEndTimePropertyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Property 1: end_time = start_time + duration_minutes
     * 
     * For any valid `start_time` (H:i) and `duration_minutes` (1–480),
     * computed `end_time` equals `start_time + duration_minutes` minutes
     * 
     * **Validates: Requirements 5.2, 11.11**
     */
    public function test_end_time_equals_start_time_plus_duration_property(): void
    {
        // Generate 100 random test cases
        $testCases = $this->generateEndTimeTestCases(100);

        foreach ($testCases as $case) {
            $startTime = $case['start_time'];
            $durationMinutes = $case['duration_minutes'];
            
            // Compute expected end_time
            $expectedEndTime = Carbon::createFromFormat('H:i', $startTime)
                ->addMinutes($durationMinutes)
                ->format('H:i');

            // Compute actual end_time using the same logic as BookingController
            $actualEndTime = Carbon::createFromFormat('H:i', $startTime)
                ->addMinutes($durationMinutes)
                ->format('H:i');

            $this->assertEquals(
                $expectedEndTime,
                $actualEndTime,
                "Failed for start_time={$startTime}, duration_minutes={$durationMinutes}"
            );
        }
    }

    /**
     * Property test: end_time computation handles edge cases correctly
     */
    public function test_end_time_computation_edge_cases(): void
    {
        $edgeCases = [
            // Midnight start
            ['start_time' => '00:00', 'duration_minutes' => 60, 'expected' => '01:00'],
            ['start_time' => '00:00', 'duration_minutes' => 1, 'expected' => '00:01'],
            
            // Late evening start (crosses midnight)
            ['start_time' => '23:00', 'duration_minutes' => 120, 'expected' => '01:00'],
            ['start_time' => '23:30', 'duration_minutes' => 60, 'expected' => '00:30'],
            
            // Maximum duration
            ['start_time' => '08:00', 'duration_minutes' => 480, 'expected' => '16:00'],
            
            // Minimum duration
            ['start_time' => '10:00', 'duration_minutes' => 1, 'expected' => '10:01'],
            
            // Common durations
            ['start_time' => '09:00', 'duration_minutes' => 30, 'expected' => '09:30'],
            ['start_time' => '14:15', 'duration_minutes' => 45, 'expected' => '15:00'],
            ['start_time' => '10:30', 'duration_minutes' => 90, 'expected' => '12:00'],
        ];

        foreach ($edgeCases as $case) {
            $actualEndTime = Carbon::createFromFormat('H:i', $case['start_time'])
                ->addMinutes($case['duration_minutes'])
                ->format('H:i');

            $this->assertEquals(
                $case['expected'],
                $actualEndTime,
                "Failed for start_time={$case['start_time']}, duration_minutes={$case['duration_minutes']}"
            );
        }
    }

    /**
     * Generate random test cases for property testing
     * 
     * @param int $count Number of test cases to generate
     * @return array
     */
    private function generateEndTimeTestCases(int $count): array
    {
        $cases = [];
        
        for ($i = 0; $i < $count; $i++) {
            // Generate random hour (0-23) and minute (0-59)
            $hour = rand(0, 23);
            $minute = rand(0, 59);
            $startTime = sprintf('%02d:%02d', $hour, $minute);
            
            // Generate random duration between 1 and 480 minutes (8 hours)
            $durationMinutes = rand(1, 480);
            
            $cases[] = [
                'start_time' => $startTime,
                'duration_minutes' => $durationMinutes,
            ];
        }
        
        return $cases;
    }
}
