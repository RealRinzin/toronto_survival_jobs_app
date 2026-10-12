<?php

use App\Models\JobCategory;
use App\Models\JobListing;
use App\Models\ScrapeCompanyJob;
use App\Models\Tag;
use App\Support\TextHelper;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

Route::get('/', function () {
    // return view('welcome');
    $response = Http::get('https://books.toscrape.com/catalogue/category/books/philosophy_7/index.html');

    $crawler = new Crawler($response->body());

    $books = $crawler->filter('article.product_pod')->each(
        function ($node) {
            return [
                'title' => $node->filter('h3 a')->attr('title'),
                'price' => $node->filter('.price_color')->text(),
                'availability' => trim(
                    $node->filter('.availability')->text()
                ),
            ];
        }
    );

    return response()->json($books);
});



Route::get('/insert', function () {
    $source = ScrapeCompanyJob::first();
    $companyIds        = DB::table('companies')->pluck('id')->all();
    $employmentTypeIds = DB::table('employment_types')->pluck('id')->all();
    $categoryIds       = DB::table('job_categories')->pluck('id')->all();
    $areaIds           = DB::table('areas')->pluck('id')->all();
    $cityIds           = DB::table('cities')->pluck('id')->all();
    $provinceIds       = DB::table('provinces')->pluck('id')->all();
    $now = now();

    // // Base API
    $res = Http::withHeaders(array_filter([
        'Origin'    => $source->origin,
        'Referer'   => $source->origin,
        'Accept'    => $source->accept,
        'Accept-Language'        => $source->accept_language,
        'User-Agent'             => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
    ]))
        ->timeout(20)
        ->post($source->base_url, $source->request_body);
    // check
    if ($res->failed()) {
        dd($res->status(), $res->body());
    }
    $saved = 0;
    // Inserting Looping
    foreach ($res->json('jobPostings', []) as $posting) {
        JobListing::updateOrCreate([
            'title'       => $posting['title'],
            'slug'        => Str::slug($posting['title']),
            'unique_job_id'        => $posting['externalPath'],
            'description' => "We are looking for a to join our team. "
                . "You will collaborate with cross-functional teams, write clean and "
                . "maintainable code, and help ship features to production.",
            'address'     => rand(100, 999) . ' King Street West',
            'location'    => 'Toronto, ON',
            'country'     => 'CA',
            'salary'      => rand(0, 1) ? rand(50000, 150000) : null,
            'published'   => true,
            'apply_url'   => 'https://example.com/careers/',
            'posted_date' => $now->toDateString(),
            'due_date'    => $now->toDateString(),
            'system_posted_date' => $now->toDateString(),
            'created_at'  => $now,
            'updated_at'  => $now,
            'company_id'         => Arr::random($companyIds ?: [null]),
            'employment_type_id' => Arr::random($employmentTypeIds ?: [null]),
            'job_category_id'     => TextHelper::JobRoleCategoryChecker($posting['title']),
            // 'job_category_id'     => 1,
            'area_id'            => Arr::random($areaIds ?: [null]),
            'city_id'            => Arr::random($cityIds ?: [null]),
            'province_id'        => Arr::random($provinceIds ?: [null]),
            'active'      => true,
        ]);
        $saved++;
    }
    return "Saved {$saved} Jobs";
});


// Job Category Check function

Route::get('/check', function () {
    
});
