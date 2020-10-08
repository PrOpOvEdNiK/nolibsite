<?php


namespace BS\Main;


class Request
{
    private $get;
    private $post;
    private $files;
    private $server;
    private $session;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->files = $_FILES;
        $this->server = $_SERVER;
        $this->session = $_SESSION;
    }

    /**
     * @return array
     */
    public function getGet(): array
    {
        return $this->get;
    }

    /**
     * @return array
     */
    public function getPost(): array
    {
        return $this->post;
    }

    /**
     * @return array
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * @return array
     */
    public function getServer(): array
    {
        return $this->server;
    }

    /**
     * @return array
     */
    public function getSession(): array
    {
        return $this->session;
    }

    public function get(string $name)
    {
        return $this->get[$name];
    }

    public function post(string $name)
    {
        return $this->post[$name];
    }

    public function server(string $name)
    {
        return $this->server[$name];
    }

    public function session(string $name)
    {
        return $this->session[$name];
    }

    public function has(string $name, string $entity)
    {
        return \array_key_exists($name, $this->$entity);
    }

    /**
     * Filter key.
     *
     * @param string $key
     * @param string $entity
     * @param int $filter FILTER_* constant
     * @param mixed $options Filter options
     *
     * @return mixed
     * @see https://php.net/filter-var
     */
    public function filter(string $key, string $entity, int $filter = FILTER_DEFAULT, $options = [])
    {
        $value = $this->$entity($key);

        if (!\is_array($options) && $options) {
            $options = ['flags' => $options];
        }

        if (\is_array($value) && !isset($options['flags'])) {
            $options['flags'] = FILTER_REQUIRE_ARRAY;
        }

        return filter_var($value, $filter, $options);
    }
}
