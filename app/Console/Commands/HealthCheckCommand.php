<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Exception;

class HealthCheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:health-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check database, cache, and queue connectivity';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $failures = [];

        // Check database connectivity
        try {
            DB::connection()->getPdo();
            $this->info('✓ Database connection successful');
        } catch (Exception $e) {
            $this->error('✗ Database connection failed: ' . $e->getMessage());
            $failures[] = 'database';
        }

        // Check cache connectivity
        try {
            $testKey = 'health_check_' . time();
            $testValue = 'test_value';
            Cache::set($testKey, $testValue, 10);
            $retrieved = Cache::get($testKey);
            
            if ($retrieved === $testValue) {
                $this->info('✓ Cache connection successful');
                Cache::forget($testKey);
            } else {
                throw new Exception('Cache value mismatch');
            }
        } catch (Exception $e) {
            $this->error('✗ Cache connection failed: ' . $e->getMessage());
            $failures[] = 'cache';
        }

        // Check queue configuration
        try {
            $queueConnection = config('queue.default');
            
            if (empty($queueConnection)) {
                throw new Exception('QUEUE_CONNECTION not configured');
            }
            
            $this->info('✓ Queue configuration valid (driver: ' . $queueConnection . ')');
        } catch (Exception $e) {
            $this->error('✗ Queue configuration check failed: ' . $e->getMessage());
            $failures[] = 'queue';
        }

        // Return non-zero exit code if any check failed
        if (count($failures) > 0) {
            $this->error("\nHealth check failed: " . implode(', ', $failures));
            return 1;
        }

        $this->info("\n✓ All health checks passed");
        return 0;
    }
}

