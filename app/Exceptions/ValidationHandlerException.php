<?php

namespace App\Exceptions;

use Exception;

class ValidationHandlerException extends Exception
{
    protected $errors;
    protected $msg;
    public function __construct($errors, $msg)
    {
        $this->errors = $errors;
        $this->msg = $msg;
    }
    public function render()
    {
        return response()->json([
            "status" => "failed",
            "message" => $this->msg,
            "errors" => $this->errors
        ], 400);
    }
}
