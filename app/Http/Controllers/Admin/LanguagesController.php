<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LanguageRequest;
use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class LanguagesController extends Controller
{
    /**
     * Show all languages
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        // get all languages
        $languages = Language::all();

        return view('admin.languages.index', compact('languages'));
    }

    /**
     * Create new language
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        return view('admin.languages.create');
    }

    /**
     * Store new language
     * @param LanguageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LanguageRequest $request) {
        $language = Language::create([
            'code' => $request->input('code'),
            'name' => $request->input('name')
        ]);

        if($language) {
            $message = [
                'message' => 'Language has been created.',
                'type' => 'success'
            ];
        } else {
            $message = [
                'message' => 'Language has not been created.',
                'type' => 'danger'
            ];
        }

        return redirect('admin/languages')->with($message);
    }

    /**
     * Delete language
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) {
        // get language
        $language = Language::findOrFail($id);

        if($language->delete()) {

            $message = [
                'message' => 'Language has been deleted.',
                'type' => 'success'
            ];
        } else {
            $message = [
                'message' => 'Language has not been deleted.',
                'type' => 'danger'
            ];
        }

        return redirect()->back()->with($message);
    }
}
