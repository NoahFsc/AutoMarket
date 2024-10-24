<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcheterController extends Controller
{
    public function index()
    {
        $cards = [
            ['image' => 'https://images.caradisiac.com/logos/3/9/2/7/283927/S8-tesla-model-y-alors-fiable-en-occasion-ou-pas-210209.jpg', 'name' => 'Tesla Model Y', 'price' => '37.850€', 'seller' => 'John Doe'],
            ['image' => 'https://images.caradisiac.com/logos/3/9/2/7/283927/S8-tesla-model-y-alors-fiable-en-occasion-ou-pas-210209.jpg', 'name' => 'Tesla Model X', 'price' => '50.000€', 'seller' => 'John Doe'],
            ['image' => 'https://images.caradisiac.com/logos/3/9/2/7/283927/S8-tesla-model-y-alors-fiable-en-occasion-ou-pas-210209.jpg', 'name' => 'Tesla Model X', 'price' => '50.000€', 'seller' => 'John Doe'],
            ['image' => 'https://images.caradisiac.com/logos/3/9/2/7/283927/S8-tesla-model-y-alors-fiable-en-occasion-ou-pas-210209.jpg', 'name' => 'Tesla Model X', 'price' => '50.000€', 'seller' => 'John Doe'],
            ['image' => 'https://images.caradisiac.com/logos/3/9/2/7/283927/S8-tesla-model-y-alors-fiable-en-occasion-ou-pas-210209.jpg', 'name' => 'Tesla Model X', 'price' => '50.000€', 'seller' => 'John Doe'],
            ['image' => 'https://images.caradisiac.com/logos/3/9/2/7/283927/S8-tesla-model-y-alors-fiable-en-occasion-ou-pas-210209.jpg', 'name' => 'Tesla Model X', 'price' => '50.000€', 'seller' => 'John Doe'],
            ['image' => 'https://images.caradisiac.com/logos/3/9/2/7/283927/S8-tesla-model-y-alors-fiable-en-occasion-ou-pas-210209.jpg', 'name' => 'Tesla Model X', 'price' => '50.000€', 'seller' => 'John Doe'],
            ['image' => 'https://images.caradisiac.com/logos/3/9/2/7/283927/S8-tesla-model-y-alors-fiable-en-occasion-ou-pas-210209.jpg', 'name' => 'Tesla Model X', 'price' => '50.000€', 'seller' => 'John Doe'],
            ['image' => 'https://images.caradisiac.com/logos/3/9/2/7/283927/S8-tesla-model-y-alors-fiable-en-occasion-ou-pas-210209.jpg', 'name' => 'Tesla Model X', 'price' => '50.000€', 'seller' => 'John Doe'],
            ['image' => 'https://images.caradisiac.com/logos/3/9/2/7/283927/S8-tesla-model-y-alors-fiable-en-occasion-ou-pas-210209.jpg', 'name' => 'Tesla Model X', 'price' => '50.000€', 'seller' => 'John Doe'],
            ['image' => 'https://images.caradisiac.com/logos/3/9/2/7/283927/S8-tesla-model-y-alors-fiable-en-occasion-ou-pas-210209.jpg', 'name' => 'Tesla Model X', 'price' => '50.000€', 'seller' => 'John Doe'],
            ['image' => 'https://images.caradisiac.com/logos/3/9/2/7/283927/S8-tesla-model-y-alors-fiable-en-occasion-ou-pas-210209.jpg', 'name' => 'Tesla Model X', 'price' => '50.000€', 'seller' => 'John Doe'],
        ];

        //$cards = collect($cards)->paginate(12);

        return view('acheter.index', compact('cards'));
    }
}
