<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TranslateWordRequest;
use App\TranslateWord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TranslateWordsController extends Controller
{
    public function store(TranslateWordRequest $request) {
        $translateWord = TranslateWord::create([
            'key' => $request->input('key')
        ]);

        if($translateWord) {
            $message = [
                'message' => 'Key has been created.',
                'type' => 'success',
                'translate_word_id' => $translateWord->id
            ];
        } else {
            $message = [
                'message' => 'Key has not been created.',
                'type' => 'danger',
                'translate_word_id' => $translateWord->id
            ];
        }

        return redirect()->back()->with($message);
    }

    /**
     * Delete translation key
     * @param $id
     */
    public function destroy($id) {
        // get translate word by id
        $translateWord = TranslateWord::find($id);

        if($translateWord->delete()) {
            $message = [
                'message' => 'Key has been deleted.',
                'type' => 'success'
            ];
        } else {
            $message = [
                'message' => 'Key has not been deleted.',
                'type' => 'danger'
            ];
        }

        return redirect()->back()->with($message);
    }
}
