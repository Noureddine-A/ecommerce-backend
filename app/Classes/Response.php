<?php
namespace App\Classes;

class Response {

    private $responseMessage;

    public function __construct(string $responseMessage) {
        $this->responseMessage = $responseMessage;
    }

    public function getResponseMessage():string {
        return $this->responseMessage;
    }

}

?>