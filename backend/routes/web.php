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

    $address = "Testing, asdfads, 2324";
    // $cities = Cache::remember('cities', 3600, fn() => City::select('id', 'name', 'province_id')->get()->toArray());
    $para = "ng a safe working environment</li>\n<li>Ability to work weekend shifts (Friday nights, Saturday and Sunday) and key holiday shopping periods including Black Friday, Christmas Eve and Boxing Week until the end of December </li></ul></p>\n<p><b>Join a team that just clicks!</b>\nWe are looking for people just like you. Apply today! </p>\n<p><b>About Best Buy</b>\nAs Canada's destination for the coolest tech, Best Buy offers one of the best work environments in the country! Our culture is one of inclusion and recognition. We are committed to always filling our stores with a diverse and inclusive retail force who are knowledgeable and enthusiastic about tech.</p><p style=\"text-align:inherit\"></p><p style=\"text-align:inherit\"></p><p style=\"text-align:left\"><b><u>Base pay range</u></b></p>Toronto pay rate: $17.95 - $21.09<p></p><p><i>Pay may vary by province. Pay listed is for the location advertised.</i></p><p><i>  </i></p>167 North Queen Street, Toronto, ON M9C 1A7<p> </p><p>This posting is for a vacancy.</p><p> </p>";

    // 1. Create a function with the parameter to receive location adddress and description
    // 2. Check if the city exsit in the cities columns with address
    // 3. If city doesnot exist, then check the description for the city match
    // 4. If both does not exist then return 0 (other city and its province)

    // 1.
    function checkMatch(string $add, string $des): string
    {
        $cities = Cache::remember('cities', 3600, fn() => City::select('id', 'name', 'province_id')->get()->toArray());
        foreach ($cities as $city) {
            // 2 echo
            if (stripos($add, $city['name']) !== false) {
                return $city['name'] . 'city';
                // 3
            } elseif (stripos($des, $city['name']) !== false) {
                return $city['name'] . 'city2';
            }
        }
        // 4
        return "There is not matching";
    }
    // checkMatch
    $test = checkMatch($address, $para);
    echo $test;
});



Route::get('/salary_check', function () {
    $para = "ng a safe working environment</li>\n<li>Ability to work weekend shifts (Friday nights, Saturday and Sunday) and key holiday shopping periods including Black Friday, Christmas Eve and Boxing Week until the end of December </li></ul></p>\n<p><b>Join a team that just clicks!</b>\nWe are looking for people just like you. Apply today! </p>\n<p><b>About Best Buy</b>\nAs Canada's destination for the coolest tech, Best Buy offers one of the best work environments in the country! Our culture is one of inclusion and recognition. We are committed to always filling our stores with a diverse and inclusive retail force who are knowledgeable and enthusiastic about tech.</p><p style=\"text-align:inherit\"></p><p style=\"text-align:inherit\"></p><p style=\"text-align:left\"><b><u>Base pay range</u></b></p>salary pay rate: $17.95 - $21.09<p></p><p><i>Pay may vary by province. Pay listed is for the location advertised.</i></p><p><i>  </i></p>167 North Queen Street, Toronto, ON M9C 1A7<p> </p><p>This posting is for a vacancy.</p><p> </p>";


    $test = preg_match('/\$\s?\d{2}/', $para, $m);
    print_r($m[0]);
});



Route::get('/gemini', function () {

    // $model = 'gemini-3.8-flash';
    // $model = 'gemini-3.1-flash-lite';
    $model = 'gemini-3.5-flash-lite';
    // $model = 'gemma-4-31b-it';
    // check AI Studio's model list for current names
    $para = '<p>Join our holiday team! We&#39;re <b>hiring immediately</b> for our busiest and most exciting time of the year! Whether you&#39;re looking to build new skills, gain experience, or be part of a great team, we&#39;d love to meet you. </p><br /><p>You use tech every day – help others do the same! Our training makes it easy to learn the role and help customers find tech they love. </p><br /><p><b>Why join us for the holidays?</b></p><ul><li>Employee discounts on awesome tech</li><li>Supportive leaders who care about you and your well-being</li><li>Paid training to build valuable customer service and sales skills</li><li>An inclusive, fun, and supportive team where you&#39;ll feel welcome from day one</li></ul><p><br /><br /></p><p><b>Roles Available:</b> <br />We’ll match you with one of the seasonal retail associate roles below that best fits your skills and interests.</p><ul><li><b>Retail Sales Associate:</b> Help our customers find the perfect gifts on their holiday shopping list.</li><li><b>Customer Service Representative:</b> Process purchases at our checkout and help customers leave excited about what’s in the box!</li><li><b>Merchandiser:</b> Keep the store looking its best by organizing and restocking shelves – holiday inventory is so important we check it twice!</li><li><b>Online Order Pick-Up Specialist:</b> Prepare and package online orders to make holiday shopping a breeze for our customers!</li><li><b>Technical Service Representative:</b> Set up and connect our customers’ devices in the store and in their homes, so they can enjoy their new tech right away. Must have a valid driver’s license.</li></ul><br /><p><b>What we’re looking for:</b></p><ul><li>Enthusiasm for helping customers</li><li>Those who thrive in a fast-paced environment</li><li>Commitment to maintaining a safe working environment</li><li>Ability to work weekend shifts (Friday nights, Saturday and Sunday) and key holiday shopping periods including Black Friday, Christmas Eve and Boxing Week until the end of December </li></ul><p><br /><br /></p><p><b>Join a team that just clicks!</b><br />We are looking for people just like you. Apply today! </p><br /><p><b>About Best Buy</b><br />As Canada&#39;s destination for the coolest tech, Best Buy offers one of the best work environments in the country! Our culture is one of inclusion and recognition. We are committed to always filling our stores with a diverse and inclusive retail force who are knowledgeable and enthusiastic about tech Salary $90 - $100/hr.</p><p></p>
<p></p>1220 Prospect Street, Fredericton, NB E3B 3C1<p></p><p>This posting is for a vacancy.</p><p> </p>';
    $response = Http::withHeaders(['x-goog-api-key' => config('services.gemini.key')])
        ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent", [
            // 'contents' => [[
            //     'parts' => [['text' => "Extract the pay or salary and area or area,city and province with its full name and  from this job posting. Return only JSON: {\"min\": number|null, \"max\": number|null, \"period\": \"hour\"|\"year\"|null}\city,province\n\n" . $para]],
            // ]],
            'contents' => [[
                'parts' => [[
                    'text' => "Extract salary and location from this Canadian job posting. Return only valid JSON with exactly these fields: {\"min\": number|null, \"max\": number|null, \"period\": \"hour\"|\"year\"|null, \"city\": string|null, \"province\": string|null}.
                    Rules:
                    - Extract salary range; if only one value, use it for both min and max.
                    - Normalize salary to numbers without currency symbols or commas.
                    - Set period to \"hour\" or \"year\"; otherwise null.
                    - Extract city and full official province/territory name (e.g., ON → Ontario).
                    - Use null for missing or ambiguous fields. Never guess or invent values.
                    - No Markdown or additional text.
                    Job posting:
                    " . $para,
                ]],
            ]],

            'generationConfig' => ['responseMimeType' => 'application/json'],
        ]);
    if ($response->failed()) {
        return response()->json(['status' => $response->status(), 'body' => $response->body()], 500);
    }

    $json = $response->json('candidates.0.content.parts.0.text');
    $salary = json_decode($json, true);
    return $salary;
});



Route::get('/groq', function () {

    $para = '<p>You’ll love it here! We are <b>hiring immediately</b> for a <b>merchandiser</b>, which we call a <b>product process specialist</b> at Best Buy<b>. </b>As a <b>merchandiser</b>, you will keep our store looking great.</p><p></p><p>No experience required! Your everyday tech use has already given you a great foundation, and we’ll provide the rest of the training you need to assist our customers.</p><p></p><p>Join us and grow your career with our retail team as a <b>merchandiser</b>.</p><p></p><p><b>What you’ll do:</b></p><ul><li><p>Replenish inventory on the shelves and ensure product availability</p></li><li><p>Help customers retrieve their products and respond to their questions</p></li><li><p>Create an amazing customer experience</p></li></ul><p></p><p><b>What we’re looking for: </b></p><ul><li><p>Enthusiasm to assist our customers</p></li><li><p>Flexibility to adapt to dynamic situations in a fast-paced environment</p></li><li><p>A commitment to maintaining a safe and fun working environment</p></li></ul><p></p><p><b>Why you’ll love it here:</b></p><ul><li><p>Employee discounts on awesome tech </p></li><li><p>Competitive compensation and benefits</p></li><li><p>Flexible schedules as per business needs</p></li><li><p>Supportive leaders who care about you and your wellbeing</p></li><li><p>An inclusive, fun, and supportive team who you will quickly call friends</p></li><li><p>Training programs to build new and transferable skills and achieve certifications</p></li></ul><p></p><p><b>Join our amazing team!</b></p><p>We are looking for people just like you.</p><p></p><p><b>About Best Buy</b></p><p>As Canada&#39;s destination for the coolest tech, Best Buy offers one of the best work environments in the country! Our culture is one of inclusion and recognition. We are committed to always filling our stores across Canada with a diverse and inclusive retail force who are passionate, knowledgeable, and enthusiastic about tech.</p><p></p><p>Grow your career in similar roles (customer service representative, sales associate, online order pick-up specialist) or development roles (team lead, assistant store leader, store leader).</p><p style="text-align:inherit"></p><p style="text-align:inherit"></p><p style="text-align:left"><b><u>Base pay range</u></b></p><p></p><p><i>Pay may vary by province. Pay $89.33 listed is for the location advertised.</i></p><p><i>  </i></p>167 North Queen Street, Etobicoke, ON M9C 1A7<p> </p><p>This posting is for a vacancy.</p><p> </p>';
    $response = Http::withToken(config('services.groq.key'))
        ->post('https://api.groq.com/openai/v1/chat/completions', [
            // 'model' => 'openai/gpt-oss-120b', // check Groq's model list for current names
            'model' => 'openai/gpt-oss-20b',
            'messages' => [
                ['role' => 'system', 'content' => 'Extract pay and address, city, province, neighbourhood from job postings. Return only JSON: {"min": number|null, "max": number|null, "period": "hour"|"year"|null|"city"|"province"|"neighbourhood"|"address"}'],
                [
                    'role' => 'user',
                    'content' => $para,
                ],
            ],
            'response_format' => ['type' => 'json_object'],
        ]);
    if ($response->failed()) {
        return response()->json(['status' => $response->status(), 'body' => $response->body()], 500);
    }

    $salary = json_decode($response->json('choices.0.message.content'), true);
    return $salary;
});
