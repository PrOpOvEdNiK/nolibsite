<?php


namespace BS\Main;


class Response
{
    /**
     * Status codes translation table.
     *
     * The list of codes is complete according to the
     * {@link https://www.iana.org/assignments/http-status-codes/http-status-codes.xhtml Hypertext Transfer Protocol (HTTP) Status Code Registry}
     * (last updated 2016-03-01).
     *
     * Unless otherwise noted, the status code is defined in RFC2616.
     *
     * @var array
     */
    public const STATUS_MAP = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        103 => 'Early Hints',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        208 => 'Already Reported',
        226 => 'IM Used',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Payload Too Large',
        414 => 'URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        421 => 'Misdirected Request',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Too Early',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        451 => 'Unavailable For Legal Reasons',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        510 => 'Not Extended',
        511 => 'Network Authentication Required',
    ];

    private $headers = [];
    private $status;
    private $content;

    private $version = "1.1";

    public function __construct(?string $content = '', int $status = 200, array $headers = [])
    {
        $this->content = $content;
        $this->status = $status;
        $this->headers = $headers;
    }

    public function setContent(string $content): Response
    {
        $this->content = $content;

        return $this;
    }

    public function setStatus(int $statusCode): Response
    {
        $this->status = $statusCode;

        return $this;
    }

    public function setHeader(string $key, string $value): Response
    {
        $this->headers[$key] = $value;

        return $this;
    }

    private function prepare(): void
    {
        if (!array_key_exists('Content-Type', $this->headers)) {
            $this->setHeader('Content-Type', 'text/html; charset=UTF-8');
        }

        if (!array_key_exists('Content-Length', $this->headers)) {
            $this->setHeader('Content-Length', mb_strlen($this->content));
        }

        $this->setHeader('Powered', "Buynitsky Sergey");
    }

    private function sendHeaders(): void
    {
        foreach ($this->headers as $kHeader => $vHeader) {
            header("{$kHeader}: {$vHeader}", true, $this->status);
        }

        $statusText = self::STATUS_MAP[$this->status];
        header(sprintf('HTTP/%s %s %s', $this->version, $this->status, $statusText), true, $this->status);
    }

    private function sendContent(): void
    {
        echo $this->content;
    }

    public function send(): void
    {
        $this->prepare();
        $this->sendHeaders();
        $this->sendContent();
        die;
    }

    public function redirect($url, $status = 301): void
    {
        $this->setHeader('Location', $url)->setStatus($status)->send();
    }

    public function sendNotFound(?string $content = ''): void
    {
        if ($content) {
            $this->setContent($content);
        }
        $this->setStatus(404)->send();
    }
}
