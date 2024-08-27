<?php

namespace Core;

class Request
{
    protected $data;
    protected $files;

    public function __construct()
    {
        $this->capture();
    }

    public function capture()
    {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $method = $_SERVER['REQUEST_METHOD'];

        if (strpos($contentType, 'application/json') !== false) {
            $this->data = json_decode(file_get_contents('php://input'), true);
        } elseif ($method === 'GET') {
            $this->data = $_GET;
        } elseif ($method === 'POST') {
            $this->data = $_POST;
        } elseif (in_array($method, ['PUT', 'PATCH', 'DELETE'])) {
            // Para PUT, PATCH y DELETE, se deben manejar manualmente
            parse_str(file_get_contents('php://input'), $this->data);
        }

        $this->files = $_FILES;
    }

    public function input($key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    public function all()
    {
        return $this->data;
    }

    public function isJson()
    {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        return strpos($contentType, 'application/json') !== false;
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function isMethod($method)
    {
        return strtoupper($method) === $this->getMethod();
    }

    public function file($key)
    {
        return $this->files[$key] ?? null;
    }

    public function hasFile($key)
    {
        return isset($this->files[$key]);
    }

    public function header($key, $default = null)
    {
        $key = strtoupper(str_replace('-', '_', $key));
        return $_SERVER['HTTP_' . $key] ?? $default;
    }

    public function has($key)
    {
        return isset($this->data[$key]);
    }

    public function hasAny(array $keys)
    {
        foreach ($keys as $key) {
            if ($this->has($key)) {
                return true;
            }
        }

        return false;
    }
}
