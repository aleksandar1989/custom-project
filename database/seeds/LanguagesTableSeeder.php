<?php

use Illuminate\Database\Seeder;
use App\Language;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $language = new Language();
        $language->code = 'en';
        $language->name = 'ENG';
        $language->save();
    }
}
