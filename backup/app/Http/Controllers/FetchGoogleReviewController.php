<?php

namespace App\Http\Controllers;

use App\Models\GoogleReviews;

class FetchGoogleReviewController extends Controller
{
    public function fetchAndSaveReviews()
    {
        $apiKey = 'AIzaSyBrHj_sx1JcYBCU_ckrGTp2iK97YqKe5oI';
        $placeId = 'ChIJuXOqK65ZWjcRaetjnY7Tme8';
        $url = "https://maps.googleapis.com/maps/api/place/details/json?key=$apiKey&placeid=$placeId";

        // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Decode the response
        $data = json_decode($response, true);

        // Check if the response is successful
        if ($data['status'] !== 'OK') {
            return response()->json(['error' => 'Failed to fetch reviews'], 500);
        }

        // Extract reviews
        $reviews = $data['result']['reviews'] ?? [];

        // Save reviews to the database
        foreach ($reviews as $review) {
            $getAuthorId = $review['author_url'];
            $authorId = explode('/', $getAuthorId);
            $authorId = $authorId[5];
            //check if the review by that authorId already exists
            $checkAuthorId = GoogleReviews::where('authorId', $authorId)->first();
            if (!$checkAuthorId) {
                GoogleReviews::updateOrCreate(
                    [
                        'place_id' => $placeId,
                        'reviewer_name' => $review['author_name'],
                        'reviewer_text' => $review['text'],
                        'authorId' => $authorId,
                    ],
                    [
                        'reviewer_photo' => $review['profile_photo_url'] ?? null,
                        'reviewer_rating' => $review['rating'],
                    ]
                );
            }
        }

        return response()->json(['success' => 'Reviews saved successfully'], 200);
    }
}
