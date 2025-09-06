<?php

namespace AwareWallet\Collection;

class ParameterCollection
{

    private $data;

    public function __construct(array $data)
    {
        $this->data = $data ?? [];
    }

    public function get(string $key)
    {
        return array_key_exists($key, $this->data)
            ? $this->data[$key]
            : null;
    }

    public function add($key, $value)
    {
        $this->data[$key] = $value;
    }

}
