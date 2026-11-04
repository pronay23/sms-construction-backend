<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    /**
     * Display the home page with top navbar and left sidebar layout.
     */
    public function index(): View
    {
        $homes = collect();

        try {
            if (Schema::hasTable('homes')) {
                $homes = Home::query()->latest()->take(6)->get();
            }
        } catch (\Throwable) {
            $homes = collect();
        }

        return view('home', compact('homes'));
    }
}
