<?php

namespace App\Http\Controllers\Admin;

use App\TranslateWord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TranslatesController extends Controller
{
    public function index(Request $request) {
        if($request->input('search')) {
            return redirect('admin/languages/translates/' . $request->input('search'));
        }

        $translateWords = TranslateWord::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.translates.index', compact('translateWords'));
    }
}
