<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Specification;
use App\Models\Smartphone;

class RecommendationController extends Controller
{
    public function showForm()
    {
        $categories = Category::active()->get();
    $specifications = Specification::active()->get();
    
    // Price ranges
    $priceRanges = [
        '2000000-3000000' => 'Rp 2 - 3 Juta',
        '3000000-4000000' => 'Rp 3 - 4 Juta', 
        '4000000-5000000' => 'Rp 4 - 5 Juta',
        '5000000-6000000' => 'Rp 5 - 6 Juta',
        '6000000-8000000' => 'Rp 6 - 8 Juta',
        '8000000-10000000' => 'Rp 8 - 10 Juta',
        '10000000-15000000' => 'Rp 10 - 15 Juta',
        '15000000-99999999' => 'Di atas Rp 15 Juta'
    ];

    return view('recommendation.form', compact('categories', 'specifications', 'priceRanges'));
    }

    public function getRecommendation(Request $request)
    {
    // Validasi input
    $request->validate([
        'price_range' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'ram_priority' => 'required|integer|min:1|max:5',
        'storage_priority' => 'required|integer|min:1|max:5',
        'specifications' => 'required|array',
        'specifications.*' => 'integer|min:1|max:5'
    ]);

    // Parse price range
    [$minPrice, $maxPrice] = explode('-', $request->price_range);

    // Get smartphones dalam range harga dan kategori
    $smartphones = Smartphone::active()
        ->where('category_id', $request->category_id)
        ->where(function($query) use ($minPrice, $maxPrice) {
            $query->whereBetween('price_min', [$minPrice, $maxPrice])
                  ->orWhereBetween('price_max', [$minPrice, $maxPrice])
                  ->orWhere(function($q) use ($minPrice, $maxPrice) {
                      $q->where('price_min', '<=', $minPrice)
                        ->where('price_max', '>=', $maxPrice);
                  });
        })
        ->with(['category', 'specifications'])
        ->get();

    if ($smartphones->isEmpty()) {
        return back()->with('error', 'Tidak ada smartphone yang sesuai dengan kriteria Anda. Silakan coba kriteria lain.');
    }

    // Implementasi Content-Based Filtering dengan Cosine Similarity
    $recommendations = $this->calculateCosineSimilarity($smartphones, $request->all());

    // Price ranges untuk view
    $priceRanges = [
        '2000000-3000000' => 'Rp 2 - 3 Juta',
        '3000000-4000000' => 'Rp 3 - 4 Juta',
        '4000000-5000000' => 'Rp 4 - 5 Juta',
        '5000000-6000000' => 'Rp 5 - 6 Juta',
        '6000000-8000000' => 'Rp 6 - 8 Juta',
        '8000000-10000000' => 'Rp 8 - 10 Juta',
        '10000000-15000000' => 'Rp 10 - 15 Juta',
        '15000000-99999999' => 'Di atas Rp 15 Juta'
    ];

    return view('recommendation.result', compact('recommendations', 'request', 'priceRanges'));
    }

    private function calculateCosineSimilarity($smartphones, $userPreferences)
    {
        $results = [];

        // Normalisasi preferensi user menjadi vektor
        $userVector = $this->normalizeUserPreferences($userPreferences);

        foreach ($smartphones as $smartphone) {
            // Normalisasi spesifikasi smartphone menjadi vektor
            $phoneVector = $this->normalizeSmartphoneSpecs($smartphone, $userPreferences);

            // Hitung cosine similarity
            $similarity = $this->cosineSimilarity($userVector, $phoneVector);

            $results[] = [
                'smartphone' => $smartphone,
                'similarity_score' => $similarity,
                'similarity_percentage' => round($similarity * 100, 2)
            ];
        }

        // Sort berdasarkan similarity score (descending)
        usort($results, function($a, $b) {
            return $b['similarity_score'] <=> $a['similarity_score'];
        });

        return collect($results);
    }

    private function normalizeUserPreferences($preferences)
    {
        // Normalisasi prioritas user ke skala 0-1
        $vector = [];
        
        // RAM priority (normalized)
        $vector[] = ($preferences['ram_priority'] - 1) / 4; // 1-5 menjadi 0-1
        
        // Storage priority (normalized) 
        $vector[] = ($preferences['storage_priority'] - 1) / 4; // 1-5 menjadi 0-1
        
        // Specifications priorities
        foreach ($preferences['specifications'] as $specId => $priority) {
            $vector[] = ($priority - 1) / 4; // 1-5 menjadi 0-1
        }

        return $vector;
    }

    private function normalizeSmartphoneSpecs($smartphone, $userPreferences)
    {
        $vector = [];

        // Normalisasi RAM (8GB=0, 12GB=0.5, 16GB=1.0)
        $ramNormalized = $this->normalizeRAM($smartphone->ram);
        $vector[] = $ramNormalized;

        // Normalisasi Storage (256GB=0, 512GB=0.5, 1024GB=1.0)
        $storageNormalized = $this->normalizeStorage($smartphone->storage);
        $vector[] = $storageNormalized;

        // Normalisasi specifications berdasarkan pivot values
        foreach ($userPreferences['specifications'] as $specId => $priority) {
            $specValue = $smartphone->specifications->where('id', $specId)->first();
            if ($specValue) {
                $vector[] = $specValue->pivot->value; // Sudah dalam bentuk 0-1
            } else {
                $vector[] = 0; // Default jika spec tidak ada
            }
        }

        return $vector;
    }

    private function normalizeRAM($ram)
    {
        // Normalisasi berdasarkan standar pasar
        if ($ram <= 8) return 0.0;
        if ($ram <= 12) return 0.5;
        return 1.0;
    }

    private function normalizeStorage($storage)
    {
        // Normalisasi berdasarkan standar pasar
        if ($storage <= 256) return 0.0;
        if ($storage <= 512) return 0.5;
        return 1.0;
    }

    private function cosineSimilarity($vectorA, $vectorB)
    {
        if (count($vectorA) !== count($vectorB)) {
            return 0;
        }

        $dotProduct = 0;
        $magnitudeA = 0;
        $magnitudeB = 0;

        for ($i = 0; $i < count($vectorA); $i++) {
            $dotProduct += $vectorA[$i] * $vectorB[$i];
            $magnitudeA += $vectorA[$i] * $vectorA[$i];
            $magnitudeB += $vectorB[$i] * $vectorB[$i];
        }

        $magnitudeA = sqrt($magnitudeA);
        $magnitudeB = sqrt($magnitudeB);

        if ($magnitudeA == 0 || $magnitudeB == 0) {
            return 0;
        }

        return $dotProduct / ($magnitudeA * $magnitudeB);
    }
}
