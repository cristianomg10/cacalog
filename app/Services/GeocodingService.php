<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeocodingService
{
    public function geocode(string $address): ?array
    {
        $key = config('services.opencage.key') ?: Setting::getValue('opencage_api_key', '');

        if (empty($key)) {
            return null;
        }

        try {
            $response = Http::timeout(10)->get('https://api.opencagedata.com/geocode/v1/json', [
                'q' => $address,
                'key' => $key,
                'language' => 'pt',
                'limit' => 1,
            ]);
        } catch (\Exception $e) {
            Log::warning('GeocodingService: falha na requisição para {address}: {error}', [
                'address' => $address,
                'error' => $e->getMessage(),
            ]);
            return null;
        }

        if ($response->failed()) {
            Log::warning('GeocodingService: resposta HTTP {status} para {address}', [
                'address' => $address,
                'status' => $response->status(),
            ]);
            return null;
        }

        $results = $response->json('results');

        if (empty($results)) {
            return null;
        }

        $geometry = $results[0]['geometry'] ?? null;

        if (!$geometry || !isset($geometry['lat'], $geometry['lng'])) {
            return null;
        }

        return [
            'lat' => $geometry['lat'],
            'lng' => $geometry['lng'],
        ];
    }

    public function buildAddress(string $logradouro, string $numero, ?string $complemento, string $bairro, string $cidade, string $estado): string
    {
        $endereco = "{$logradouro}, {$numero}";

        if ($complemento) {
            $endereco .= " - {$complemento}";
        }

        $endereco .= ", {$bairro}, {$cidade}/{$estado}, Brasil";

        return $endereco;
    }
}
