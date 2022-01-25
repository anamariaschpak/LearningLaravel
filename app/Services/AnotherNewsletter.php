<?php

namespace App\Services;

class AnotherNewsletter implements Newsletter {
    public function subscribe(string $email, ?string $list = null)
    {
        return 'AnotherNewsletter subscription';
    }
}
