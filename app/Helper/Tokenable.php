<?php

namespace App\Helper;

use Illuminate\Support\Str;

trait Tokenable
{
    public function generateAndSaveApiAuthToken()
    {
        $token = Str::random(60);

        $this->api_token = $token;
        $this->save();

        return $this;
    }
}
