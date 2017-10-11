<?php

namespace App\Http\Controllers\Admin;

use App\Language;
use App\Translate;
use App\TranslateWord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TranslatesController extends Controller
{
    public function index(Request $request) {
        if($request->input('search')) {
            return redirect('admin/languages/translates/' . $request->input('search'));
        }

        $translateWords = TranslateWord::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.translates.index', compact('translateWords'));
    }

    /**
     * This is actually search
     * @param $key
     */
    public function show($key) {
        $translateWords = TranslateWord::where('key', 'like', '%' . $key . '%')->orderBy('created_at', 'desc')->paginate(3);
        return view('admin.translates.index', compact('translateWords'));
    }

    /**
     * Create translation
     * @param $translateWordId
     */
    public function store(Request $request) {
        // validation
        $validator = Validator::make($request->all(), [
            'language' => 'required',
            'translate' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with([
                    'translate_word_id' => $request->input('translate_word_id')
                ]);
        }

        // get language id by code
        $language_id = Language::where('code', $request->input('language'))->first()->id;

        // create new translation
        $translate = Translate::create([
            'translate_word_id' => $request->input('translate_word_id'),
            'language_id' => $language_id,
            'value' => $request->input('translate')
        ]);

        if($translate) {
            $message = [
                'message' => 'Translation has been created.',
                'type' => 'success',
                'translate_word_id' => $request->input('translate_word_id')
            ];
        } else {
            $message = [
                'message' => 'Translation has not been created.',
                'type' => 'danger',
                'translate_word_id' => $request->input('translate_word_id')
            ];
        }

        return redirect()->back()->with($message);
    }

    /**
     * Update translation
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'translate' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with([
                    'translate_word_id' => $request->input('translate_word_id')
                ]);
        }

        $translate = Translate::findOrFail($id);

        $translate->value = $request->input('translate');

        if($translate->save()) {
            $message = [
                'message' => 'Translation has been updated.',
                'type' => 'success',
                'translate_word_id' => $request->input('translate_word_id')
            ];
        } else {
            $message = [
                'message' => 'Translation has not been updated.',
                'type' => 'danger',
                'translate_word_id' => $request->input('translate_word_id')
            ];
        }

        return redirect()->back()->with($message);
    }

    /**
     * Delete translation value
     * @param $id
     */
    public function destroy($id, Request $request) {
        // get translate by id
        $translate = Translate::find($id);
        $translate_word_id = $translate->translate_word_id;

        if($translate->delete()) {
            $message = [
                'message' => 'Translation has been deleted.',
                'type' => 'success',
                'translate_word_id' => $translate_word_id
            ];
        } else {
            $message = [
                'message' => 'Translation has not been deleted.',
                'type' => 'danger',
                'translate_word_id' => $translate_word_id
            ];
        }

        return redirect()->back()->with($message);
    }
}
