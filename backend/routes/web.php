<?php

use App\Models\Tag;
use App\Support\TextHelper;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Route;

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

Route::get('/httpclient-api', function () {
    $response = Http::get('https://bestbuycanada.wd3.myworkdayjobs.com/wday/cxs/bestbuycanada/BestBuyCA_Career/jobs');

    $post = $response->json();
    dd($post);
    echo $post['title'];
    echo $post['body'];
});


Route::get('/scrape', function () {
    $url = 'https://bestbuycanada.wd3.myworkdayjobs.com/wday/cxs/bestbuycanada/BestBuyCA_Career/jobs';
    $params = [
        "appliedFacets" => [
            // "locationRegionStateProvince" => [""],
            // "locationHierarchy2" => [""]

            "locationRegionStateProvince" => [
                "218a720b28a74c67b5c6d42c00bdadfa"
            ],
            "locationHierarchy2" => [
                "4acf03b2e8e30167e22819530502f6dd",
                "4acf03b2e8e3015b97f55d5305026ce0"
            ],
            "jobFamilyGroup" => [
                "4acf03b2e8e3010f6c2451b60502b065"
            ]

        ],

        // "limit" => 10,
        // "offset" => 0,
        "searchText" => ""
    ];
    // cURL setup
    $ch = curl_init($url);
    // Set user agent to mimic browser
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($params),
        CURLOPT_TIMEOUT => 20,
        CURLOPT_ENCODING => '', // sends Accept-Encoding: gzip, deflate, br and auto-decodes
        // CURLOPT_COOKIEJAR => $cookieFile,  // WRITE cookies received from server to this file
        // CURLOPT_COOKIEFILE => $cookieFile, // READ cookies from this file and send them
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Content-Type: application/json",
            "Origin: https://bestbuycanada.wd3.myworkdayjobs.com",
            "Referer: https://bestbuycanada.wd3.myworkdayjobs.com/en-CA/BestBuyCA_Career",
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36",
            "Accept-Language: en-CA,en;q=0.9",
            "Sec-Fetch-Site: same-origin",
            "Sec-Fetch-Mode: cors",
            "Sec-Fetch-Dest: empty",
        ],
    ]);
    // Curl the api
    $response = curl_exec($ch);
    // Converting the Response data to JSON
    $data = json_decode($response, true);
    echo "<pre>";
    print_r($data);
    echo "</pre>";
});



Route::get('/json', function () {
    $ch = curl_init('http://localhost:8001/storage/json/bestbuy.json');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    print_r($response);
    curl_close($ch);
});



Route::get('/checkTag', function () {


    $content = 'Lorem Remote dolor sit amet consectetur adipiscing elit dolor. Est facilis similique mollit officia deserunt dolor occaecat. Cupidatat laborum animi consequatur fugiat vero.

Nulla fugiat dolore in eu ut temporibus omnis. Entry Level est nisi nisi laboris proident at Hybrid imperdiet eu. Eos qui dolores aut cillum commodo commodo minim dignissimos dolore similique do.

Irure nisi id omnis dolor in nihil culpa elit fugiat autem id. Est maxime autem libero fuga eu non. Ullamco elit mollit placeat nulla aliqua nulla autem assumenda cumque eu. Quos mollit aute optio soluta ullamco harum. Cillum deserunt velit qui optio expedita harum at.';

    // Regular solution
    // $tags = Tag::get();
    // foreach ($tags as $tag) {
    //     if (TextHelper::TagMatcher($content, $tag['name'])) {
    //         echo $tag['name'];
    //         return "Present";
    //     } else {
    //         echo "No ";
    //     }
    // }

    // OPTIMIZED SOLUTION
    $tags = Cache::remember('tag_names', 3600, fn() => Tag::pluck('name', 'id'));
    $matched = $tags->filter(
        fn($name) => TextHelper::matchedTags($content, $name)
    );

    // $matched is keyed by tag id, so:
    $ids = $matched->keys();
});
