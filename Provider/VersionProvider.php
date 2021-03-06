<?php

namespace Shivas\VersioningBundle\Provider;

use RuntimeException;

/**
 * Class VersionProvider
 */
class VersionProvider implements ProviderInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * Constructor
     *
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @return bool
     */
    public function isSupported()
    {
        return $this->hasVersionFile() && $this->canGetVersion();
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        $result = file_get_contents($this->path . DIRECTORY_SEPARATOR . 'VERSION');

        return $result;
    }

    /**
     * @return bool
     */
    private function hasVersionFile()
    {
        return file_exists($this->path . DIRECTORY_SEPARATOR . 'VERSION');
    }

    /**
     * @return boolean
     * @throws RuntimeException
     */
    private function canGetVersion()
    {
        try {
            if (false === $this->getVersion()) {
                return false;
            }
        } catch (RuntimeException $e) {
            return false;
        }

        return true;
    }
}
