<?php

namespace App\Http\Controllers;

use App\Term;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function show($slug) {
        // get all url
        $categories = explode('/', $slug);

        // get category slug
        $cat_slug = end($categories);
        // get current category
        $term = Term::where('slug', $cat_slug)->first();
        return view('themes.laracus.terms.' . $term->template, compact('term'));
}
}
