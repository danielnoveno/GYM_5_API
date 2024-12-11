<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function getImageUrl($id)
    {
        // Tambahkan log
        \Log::info("Request received for image ID: $id");

        $image = Image::find($id);

        if ($image) {
            $imageUrl = asset('storage/' . $image->path);
            \Log::info("Image found: $imageUrl");
                        
            return response()->json(['imageUrl' => $imageUrl]);
        }

        \Log::error("Image not found for ID: $id");
        return response()->json(['message' => 'Image not found'], 404);
    }


}
