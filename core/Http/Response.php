<?php

namespace Core\Http;

class Response
{
    private $body = [];

    private $message;

    /**
     * @param array|null $body
     * @param string $message
     */
    public function __construct($body = [], string $message = null)
    {
        $this
            ->setBody($body)
            ->setMessage($message);
    }

    /**
     * @param array|null $body
     *
     * @return Response
     */
    public function setBody($body = [])
    {
        $this->body = (array) $body;

        return $this;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function setMessage(string $message = null)
    {
        $this->message = $message;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getCode(): int
    {
        return http_response_code();
    }

    public function __toString()
    {
        $response = [
            'status'  => $this->getCode(),
            'message' => $this->getMessage(),
            'body'    => $this->getBody(),
        ];

        // Eliminate message from the response in case of success
        if (is_null($this->getMessage())) {
            unset($response['message']);
        }

        // Eliminate body from the response in case of error
        if ($this->getCode() > 299) {
            unset($response['body']);
        }

        return json_encode($response);
    }
}
