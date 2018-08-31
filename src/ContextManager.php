<?php

namespace Scuttlebyte\ContextManager;

use Scuttlebyte\ContextManager\Exception\UnregisteredContextException;

class ContextManager
{
    /**
     * The collection of Contexts
     * @var array
     */
    private $contexts = array();

    /**
     * Add a context to the collection
     * @param String|array $key
     * @param $value
     * @return void
     */
    public function put($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $arrayKey => $arrayValue) {
                $this->bind((string)$arrayKey, $arrayValue);
            }
        } else {
            $this->bind((string)$key, $value);
        }
    }

    /**
     * Get a value from the contexts
     * @param $key
     * @throws UnregisteredContextException
     * @return mixed
     */
    public function get($key)
    {
        if (array_key_exists($key, $this->contexts)) {
            return $this->contexts[$key];
        }

        throw new Exception\UnregisteredContextException("No context registered for " . $key);
    }

    /**
     * Get all contexts
     * @return array
     */
    public function all()
    {
        return $this->contexts;
    }

    /**
     * Store a key value pair into the collection
     * @param String $key
     * @param mixed $value
     * @return void
     */
    private function bind(String $key, $value)
    {
        $this->contexts[$key] = $value;
    }
}
