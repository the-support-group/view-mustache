<?php

namespace Air\View\Mustache;

use Air\View\Renderer as BaseRenderer;
use Mustache_Engine;

class Renderer extends BaseRenderer
{
    /**
     * @param string $file The file to load.
     * @param array $data The data to inject.
     * @return string The rendered output.
     */
    public function render($file, array $data)
    {
        $mustache = new Mustache_Engine;
        return $mustache->render(file_get_contents($file), $data);
    }
}
