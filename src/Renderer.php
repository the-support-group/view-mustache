<?php

namespace Air\View\Mustache;

use Air\View\Renderer as BaseRenderer;
use Mustache_Engine;

class Renderer extends BaseRenderer
{
    /**
     * @param string|null $cacheDir A directory to cache rendered templates into (enables caching).
     */
    public function __construct($cacheDir = null)
    {
        $this->cacheDir = $cacheDir;
    }


    /**
     * @param string $file The file to load.
     * @param array $data The data to inject.
     * @return string The rendered output.
     */
    public function render($file, array $data)
    {
        if (!is_null($this->cacheDir)) {
            $mustache = new Mustache_Engine([
                'cache' => $this->cacheDir
            ]);
        } else {
            $mustache = new Mustache_Engine();
        }

        return $mustache->render(file_get_contents($file), $data);
    }
}
