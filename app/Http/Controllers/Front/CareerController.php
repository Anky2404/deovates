<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Career;

class CareerController extends Controller
{
    private $prefix = 'front.';
    private $folder = 'career.';

    public function index()
    {
        $careers = Career::with('department')
            ->active()
            ->latest('id')
            ->get();

        // Pad grid with placeholder roles
        $placeholders = collect([
            (object) ['slug' => null, 'title' => 'Frontend Developer', 'department' => (object) ['name' => 'Engineering'], 'location' => 'ludhiana', 'is_remote' => true, 'employment_type' => 'full-time'],
            (object) ['slug' => null, 'title' => 'Backend Developer', 'department' => (object) ['name' => 'Engineering'], 'location' => 'ludhiana', 'is_remote' => true, 'employment_type' => 'full-time'],
            (object) ['slug' => null, 'title' => 'UI/UX Designer', 'department' => (object) ['name' => 'Design'], 'location' => 'ludhiana', 'is_remote' => false, 'employment_type' => 'full-time'],
        ])->take(max(0, 4 - $careers->count()));

        $careers = $careers->concat($placeholders);

        return view($this->prefix . $this->folder . 'index', compact('careers'));
    }

    public function details($slug)
    {
        $career = Career::with('department')
            ->active()
            ->where('slug', $slug)
            ->first();

        if (! $career) {
            abort(404);
        }

        $related = Career::active()
            ->where('id', '!=', $career->id)
            ->latest('id')
            ->take(3)
            ->get();

        return view($this->prefix . $this->folder . 'details', compact('career', 'related'));
    }
}
