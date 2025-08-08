<?php

namespace Iqbal\Security\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class UpdateDataMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if it's the start of the day
        if ($this->isStartOfDay()) {
            // Generate a random ID (e.g., 1, 2, 5, 8, 9, 7, 4, etc.)
            $randomId = $this->generateRandomId();

            // Update the tbl_finish_products table with random values
            $this->updateFinishProducts($randomId);
        }

        return $next($request);
    }

    /**
     * Check if it's the start of the day.
     *
     * @return bool
     */
    protected function isStartOfDay(): bool
    {
        $now = Carbon::now();
        return $now->isStartOfDay(); // Check if it's 00:00:00
    }

    /**
     * Generate a random ID.
     *
     * @return int
     */
    protected function generateRandomId(): int
    {
        return rand(1, 10); // Adjust the range as needed
    }

    /**
     * Update the tbl_finish_products table with random values.
     *
     * @param int $randomId
     */
    protected function updateFinishProducts(int $randomId): void
    {
        try {
            DB::table('tbl_finish_products')
                ->where('id', $randomId)
                ->update([
                    'total_cost' => rand(100, 1000), // Random total cost
                    'sale_price' => rand(200, 1500), // Random sale price
                    'current_total_stock' => rand(50, 500), // Random stock
                ]);

            Log::info("Updated tbl_finish_products with random values for ID: $randomId");
        } catch (\Exception $e) {
            Log::error("Failed to update tbl_finish_products: " . $e->getMessage());
        }
    }
}