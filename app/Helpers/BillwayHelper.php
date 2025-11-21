<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BillwayHelper
{
    private $apiKey;
    private $baseUrl;
    private $webhookSecret;

    public function __construct($apiKey, $webhookSecret = null, $isSandbox = true)
    {
        $this->apiKey = $apiKey;
        $this->webhookSecret = $webhookSecret;
        
        // Set base URL based on environment
        if ($isSandbox) {
            $this->baseUrl = 'https://sandbox.safehaven.com/'; // Replace with actual Safe Haven sandbox URL
        } else {
            $this->baseUrl = 'https://api.safehaven.com/'; // Replace with actual Safe Haven live URL
        }
    }

    /**
     * Create a new payment
     */
    public function createPayment($data)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/payments', $data);

            if (!$response->successful()) {
                Log::error('Safe Haven API Error: ' . $response->body());
                return [
                    'success' => false,
                    'message' => 'Failed to create payment: ' . $response->status(),
                    'data' => null
                ];
            }

            $responseData = $response->json();
            return [
                'success' => true,
                'message' => 'Payment created successfully',
                'data' => $responseData
            ];
        } catch (\Exception $e) {
            Log::error('Safe Haven API Exception: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * Verify a payment
     */
    public function verifyPayment($paymentId)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->get($this->baseUrl . '/payments/' . $paymentId);

            if (!$response->successful()) {
                Log::error('Safe Haven Verification Error: ' . $response->body());
                return [
                    'success' => false,
                    'message' => 'Failed to verify payment: ' . $response->status(),
                    'data' => null
                ];
            }

            $responseData = $response->json();
            return [
                'success' => true,
                'message' => 'Payment verified successfully',
                'data' => $responseData
            ];
        } catch (\Exception $e) {
            Log::error('Safe Haven Verification Exception: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * Verify webhook signature
     */
    public function verifyWebhookSignature($payload, $signature)
    {
        if (!$this->webhookSecret) {
            Log::warning('Safe Haven webhook secret not configured');
            return false;
        }

        $expectedSignature = hash_hmac('sha256', $payload, $this->webhookSecret);
        return hash_equals($expectedSignature, $signature);
    }

    /**
     * Get supported currencies
     */
    public function getSupportedCurrencies()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->get($this->baseUrl . '/currencies');

            if (!$response->successful()) {
                return [];
            }

            $data = $response->json();
            return $data['data'] ?? [];
        } catch (\Exception $e) {
            Log::error('Safe Haven Currencies Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Test API connection
     */
    public function testConnection()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->get($this->baseUrl . '/status');

            return $response->successful();
        } catch (\Exception $e) {
            Log::error('Safe Haven Connection Test Error: ' . $e->getMessage());
            return false;
        }
    }
} 