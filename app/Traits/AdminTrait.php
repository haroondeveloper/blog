<?php

namespace App\Traits;

trait AdminTrait
{
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
