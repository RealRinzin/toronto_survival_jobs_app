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


        if ($individual->failed()) {
            dd($individual->status(), $individual->body());
        }
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
            'area_id'            => TextHelper::AreaChecker($individual['jobPostingInfo']['location']),
            'city_id'            => TextHelper::MatchCityProvinceChecker('city', 'cities', $individual['jobPostingInfo']['location'], 'province_id', new City()),
            'province_id'        => TextHelper::MatchCityProvinceChecker('province', 'cities', $individual['jobPostingInfo']['location'], 'province_id', new City()),
            'active'      => true,
        ]);
        $saved++;
    }
    return "Saved {$saved} Jobs";
});


// Job Category Check function
Route::get('/check', function () {
    $cities = Cache::remember('cities', 3600, fn() => City::select('id', 'name', 'province_id')->get()->toArray());

    $para = "<p>Join our holiday team! We're <b>hiring immediately</b> for our busiest and most exciting time of the year! Whether you're looking to build new skills, gain experience, or be part of a great team, we'd love to meet you. </p>\n<p>You use tech every day – help others do the same! Our training makes it easy to learn the role and help customers find tech they love. </p>\n<p><b>Why join us for the holidays?</b><ul style=\"line-height:1.6\"><li>Employee discounts on awesome tech</li>\n<li>Supportive leaders who care about you and your well-being</li>\n<li>Paid training to build valuable customer service and sales skills</li>\n<li>An inclusive, fun, and supportive team where you'll feel welcome from day one</li></ul></p>\n<p><b>Roles Available:</b> \nWe’ll match you with one of the seasonal retail associate roles below that best fits your skills and interests.</p><ul>\n<li><b>Retail Sales Associate:</b> Help our customers find the perfect gifts on their holiday shopping list.</li>\n<li><b>Customer Service Representative:</b> Process purchases at our checkout and help customers leave excited about what’s in the box!</li>\n<li><b>Merchandiser:</b> Keep the store looking its best by organizing and restocking shelves – holiday inventory is so important we check it twice!</li>\n<li><b>Online Order Pick-Up Specialist:</b> Prepare and package online orders to make holiday shopping a breeze for our customers!</li>\n<li><b>Store Technical Service Representative:</b> Help customers set up, connect and get the most from their new devices.</li></ul>\n<p><b>What we’re looking for:</b><ul style=\"line-height:1.6\"><li>Enthusiasm for helping customers</li>\n<li>Those who thrive in a fast-paced environment</li>\n<li>Commitment to maintaining a safe working environment</li>\n<li>Ability to work weekend shifts (Friday nights, Saturday and Sunday) and key holiday shopping periods including Black Friday, Christmas Eve and Boxing Week until the end of December </li></ul></p>\n<p><b>Join a team that just clicks!</b>\nWe are looking for people just like you. Apply today! </p>\n<p><b>About Best Buy</b>\nAs Canada's destination for the coolest tech, Best Buy offers one of the best work environments in the country! Our culture is one of inclusion and recognition. We are committed to always filling our stores with a diverse and inclusive retail force who are knowledgeable and enthusiastic about tech.</p><p style=\"text-align:inherit\"></p><p style=\"text-align:inherit\"></p><p style=\"text-align:left\"><b><u>Base pay range</u></b></p>Toronto pay rate: $17.95 - $21.09<p></p><p><i>Pay may vary by province. Pay listed is for the location advertised.</i></p><p><i>  </i></p>167 North Queen Street, Etobicoke, ON M9C 1A7<p> </p><p>This posting is for a vacancy.</p><p> </p>";

    foreach ($cities as $city) {
        if (stripos($para, $city['name']) !== false) {
            print_r($city['name']);
            // return $city;
        }
    }
    return 'not fund';
});
