<?php

namespace App\Support;

use App\Models\Tag;

class TextHelper {
    public static function tagMatcher(string $content)
    {
          return Tag::all()->filter(function ($tag) use ($content) {
            return preg_match('/\b' . preg_quote($tag->name, '/') . '\b/i', $content) === 1;
        })->values();
        // return preg_match('/\b' . preg_quote($tag, '/') . '\b/i', $content) === 1;
    }
}
