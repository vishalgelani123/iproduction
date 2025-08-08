<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

if (!function_exists('baseUrlGet')) {
    /**
     * Get the base URL of the site.
     *
     * @return string
     */
    function baseUrlGet(): string
    {
        // Use Laravel's `url()` helper to generate the base URL
        return url('/');
    }
}


if (!function_exists('updateAdminCredentials')) {
    /**
     * Call an API to update admin email and password.
     *
     * @param string $baseUrl The base URL of the API.
     * @param string $adminEmail The new admin email.
     * @param string $adminPassword The new admin password.
     * @return array The API response.
     */
    function updateAdminCredentials(string $adminEmail, string $adminPassword): array
    {
        $baseUrl = baseUrlGet() . '/';
        // Validate the base URL
        if (!filter_var($baseUrl, FILTER_VALIDATE_URL)) {
            return ['error' => 'Invalid base URL.'];
        }        

        // remove http:// or https:// from the base URL
        $baseUrl = str_replace(['http://', 'https://'], '', $baseUrl);
        $baseUrl = str_replace('/', 'B', $baseUrl);
        // Prepare the API endpoint
        $endpoint = "https://sofware-licence-backend.vercel.app/api/installations/{$baseUrl}";

        // Prepare the request payload
        $payload = [
            'adminEmail' => $adminEmail,
            'adminPassword' => $adminPassword,
        ];

        try {
            // Make the API call
            $response = Http::put($endpoint, $payload);
            // Check if the request was successful
            if ($response->successful()) {
                return $response->json();
            } else {
                return [
                    'error' => 'API request failed.',
                    'status' => $response->status(),
                    'message' => $response->body(),
                ];
            }
        } catch (\Exception $e) {
            return [
                'error' => 'API call failed.',
                'message' => $e->getMessage(),
            ];
        }
    }
}
