<?php namespace Orchestra\Memory\Abstractable;

abstract class Handler
{
    /**
     * Memory name.
     *
     * @var string
     */
    protected $name;

    /**
     * Storage name.
     *
     * @var string
     */
    protected $storage;

    /**
     * Repository instance.
     *
     * @var object
     */
    protected $repository;

    /**
     * Cache instance.
     *
     * @var \Illuminate\Cache\Repository
     */
    protected $cache;

    /**
     * Cache key.
     *
     * @var string
     */
    protected $cacheKey;

    /**
     * Memory configuration.
     *
     * @var array
     */
    protected $config = array();

    /**
     * Cached key value map with md5 checksum.
     *
     * @var array
     */
    protected $keyMap = array();

    /**
     * Setup a new memory handler.
     *
     * @param  string  $name
     * @param  array   $config
     */
    public function __construct($name, array $config)
    {
        $this->name     = $name;
        $this->config   = array_merge($this->config, $config);
        $this->cacheKey = "db-memory:{$this->storage}-{$this->name}";
    }

    /**
     * Add key with id and checksum.
     *
     * @param  string   $name
     * @param  array    $option
     * @return void
     */
    protected function addKey($name, $option)
    {
        $option['checksum'] = $this->generateNewChecksum($option['value']);
        unset($option['value']);

        $this->keyMap = array_add($this->keyMap, $name, $option);
    }

    /**
     * Verify checksum.
     *
     * @param  string   $name
     * @param  string   $check
     * @return boolean
     */
    protected function check($name, $check = '')
    {
        return (array_get($this->keyMap, "{$name}.checksum") === $this->generateNewChecksum($check));
    }

    /**
     * Generate a checksum from given value.
     *
     * @param  mixed   $value
     * @return string
     */
    protected function generateNewChecksum($value)
    {
        ! is_string($value) and $value = (is_object($value) ? spl_object_hash($value) : serialize($value));

        return md5($value);
    }

    /**
     * Is given key a new content.
     *
     * @param  string   $name
     * @return integer
     */
    protected function getKeyId($name)
    {
        return array_get($this->keyMap, "{$name}.id");
    }

    /**
     * Get storage name.
     *
     * @return string
     */
    public function getStorageName()
    {
        return $this->storage;
    }

    /**
     * Get handler name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get if from content is new.
     *
     * @param  string   $name
     * @return boolean
     */
    protected function isNewKey($name)
    {
        return is_null($this->getKeyId($name));
    }
}
