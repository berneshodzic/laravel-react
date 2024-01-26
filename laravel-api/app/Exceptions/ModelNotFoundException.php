<?php

namespace App\Exceptions;

use Exception;

class ModelNotFoundException extends Exception
{
    public function render($request)
    {
        return response()->json(["error" => true, "message" => $this->getMessage()]);
    }
}
