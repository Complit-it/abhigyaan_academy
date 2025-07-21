<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPageContent extends Model
{
    use HasFactory;

   protected $fillable =[
         'section_id',
         'section_header_text',
         'section_sub_header_text',
         'image_url',
         'image_alt_text',
         'video_link',
         'video_alt_text',
         'content',
         'navigation_link',
         'navigation_text',
         'other_data_1',
            'other_data_2',
            'other_data_3',
            'other_data_4',
            'other_data_5',
    ];
}
