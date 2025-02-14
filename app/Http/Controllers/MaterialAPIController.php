<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialAPIController extends Controller
{  public function getMaterialsForCarousel()
    {
        $materials = Material::with(['materialCover', 'materialType'])
            ->whereHas('materialType', function($query) {
                $query->whereNotIn('mat_unique_id', ['MCL', 'TAA', 'TXT', 'VAA'])
                      ->where('status', 'active');
            })
            ->where('status', 'active')
            ->whereNotNull('title')
            ->whereNotNull('material_cover_id')
            ->select('id', 'title', 'material_cover_id')
            ->inRandomOrder()
            ->limit(10)
            ->get()
            ->map(function($material) {
                // Remove the extra 'storage/' from the path
                $coverUrl = $material->materialCover->url;
                $coverUrl = str_replace('storage/', '', $coverUrl);
                
                return [
                    'title' => $material->title,
                    'coverImage' => config('app.url') . '/storage/' . $coverUrl
                ];
            })
            ->filter(function($material) {
                return $material['coverImage'] !== null;
            })
            ->values();

        return response()->json([
            'status' => 'success',
            'data' => $materials,
            'baseUrl' => config('app.url')
        ]);
    }
    }
