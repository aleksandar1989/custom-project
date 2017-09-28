<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    public function execute($action) {
        $this->$action();
    }

    protected function export() {
        $keys = Redis::keys("*");

        $data = [];

        foreach($keys as $key) {
            $data[$key] = Redis::get($key);
        }

        File::put(base_path() . '/redis_data.json', json_encode($data));

        echo 'successfully exported';
    }

    protected function import() {
        $data = json_decode(File::get(base_path() . '/redis_data.json'));

        foreach($data as $key => $value) {
            Redis::set($key, $value);
        }

        echo 'successfully imported';
    }
}
