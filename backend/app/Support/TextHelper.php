<?php

namespace App\Support;

class TextHelper
{
    // public static function tagMatcher(string $content, string $tag): bool
    // {
    //     return preg_match('/\b' . preg_quote($tag, '/') . '\b/i', $content) === 1;
    // }
    public static function matchedTags(string $content, array $tags): array
    {
        if ($content === '' || empty($tags)) {
            return [];
        }

        $pattern = '/\b(' . implode('|', array_map(
            fn($t) => preg_quote($t, '/'),
            $tags
        )) . ')\b/iu';

        preg_match_all($pattern, $content, $m);

        return array_unique(array_map('mb_strtolower', $m[1]));
    }
}
