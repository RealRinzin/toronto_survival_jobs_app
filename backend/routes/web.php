<?php

use App\Models\City;
use App\Models\EmploymentType;
use App\Models\JobListing;
use App\Models\ScrapeCompanyJob;
use App\Support\TextHelper;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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


// 
Route::get('/insert', function () {
    $source = ScrapeCompanyJob::first();
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
        'User-Agent'             => $source->user_agent,
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
        // Individual 
        $individual = Http::withHeaders(array_filter([
            'Origin'    => $source->origin,
            'Referer'   => $source->origin,
            'Accept'    => $source->accept,
            'Accept-Language'        => $source->accept_language,
            'User-Agent'             => $source->user_agent,
        ]))
            ->timeout(20)
            ->get($source->endpoint . $posting['externalPath']);

        // check
        if ($individual->failed()) {
            dd($individual->status(), $individual->body());
        }
        // return $individual['jobPostingInfo'];
        // Insert the Job
        JobListing::updateOrCreate([
            'title'       => $individual['jobPostingInfo']['title'],
            'slug'        => Str::slug($individual['jobPostingInfo']['title']),
            'unique_job_id'        => $individual['jobPostingInfo']['jobPostingId'],
            'description' => $individual['jobPostingInfo']['jobDescription'],
            'address'     => $individual['jobPostingInfo']['location'],
            'location'    => 'Toronto, ON',
            'country'     => 'CA',
            'salary'      => rand(0, 1) ? rand(50000, 150000) : null,
            'published'   => true,
            'apply_url'   => $individual['jobPostingInfo']['externalUrl'],
            'posted_date' => $individual['jobPostingInfo']['startDate'],
            'due_date' => $individual['jobPostingInfo']['endDate'],
            'system_posted_date' => $now->toDateString(),
            'created_at'  => $now,
            'updated_at'  => $now,
            'company_id'         => $source->id,
            'employment_type_id' => TextHelper::EmploymentTypeChecker($individual['jobPostingInfo']['timeType']),
            'job_category_id'     => TextHelper::JobRoleCategoryChecker($individual['jobPostingInfo']['title']),
            'area_id'            => Arr::random($areaIds ?: [null]),
            // 'city_id'            => TextHelper::CityChecker($individual['jobPostingInfo']['location']),
            'city_id'            => TextHelper::MatchAreaCityProvinceChecker('cities', $individual['jobPostingInfo']['location'], 'province_id', new City()),
            'province_id' => 1,
            // 'province_id'        => TextHelper::MatchAreaCityProvinceChecker('provinces',$individual['jobPostingInfo']['location'],'active',new City()),
            'active'      => true,
        ]);
        $saved++;
    }
    return "Saved {$saved} Jobs";
});


// Job Category Check function
Route::get('/check', function () {
    $address = 'asdfad ,23234 Brampton';
    return TextHelper::MatchAreaCityProvinceChecker('cities', $address, 'province_id', new City());

});
