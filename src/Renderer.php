<?php

namespace Air\View\Mustache;

use Air\View\Renderer as BaseRenderer;
use Mustache_Loader_FilesystemLoader;
use Mustache_Engine;

class Renderer extends BaseRenderer
{
    /**
     * @param string|null $cacheDir A directory to cache rendered templates into (enables caching).
     * @param string|null $partialsDir A directory where static partials are stored.
     */
    public function __construct($cacheDir = null, $partialsDir = null)
    {
        $this->cacheDir = $cacheDir;
        $this->partialsDir = $partialsDir;
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
                'cache' => $this->cacheDir,
                'partials_loader' => new Mustache_Loader_FilesystemLoader($this->partialsDir),
                'escape' => function($value) {
                    return htmlspecialchars($value, ENT_COMPAT, 'UTF-8', false);
                }
            ]);
        } else {
            $mustache = new Mustache_Engine([
                'partials_loader' => new Mustache_Loader_FilesystemLoader($this->partialsDir),
                'escape' => function($value) {
                    return htmlspecialchars($value, ENT_COMPAT, 'UTF-8', false);
                }
            ]);
        }

        return $mustache->render(file_get_contents($file), $data);
    }
}
