<?php

namespace Air\View\Mustache;

use Air\View\ViewFactory as BaseViewFactory;
use Air\View\View;
use Air\View\ViewInterface;

class ViewFactory extends BaseViewFactory
{
    /**
     * @var string $fileExtension The file extension to use when looking for views.
     */
    protected $fileExtension = 'mustache';


    /**
     * @var array $viewBaseData The data to set in the view when getting it.
     */
    private $viewBaseTags;


    /**
     * @param string|null $cacheDir A directory to cache rendered templates into (enables caching).
     * @param string|null $partialsDir A directory where static partials are stored.
     * @param array $viewBaseTags The base data for the view.
     */
    public function __construct($cacheDir = null, $partialsDir = null, array $viewBaseTags = [])
    {
        $this->cacheDir = $cacheDir;
        $this->partialsDir = $partialsDir;
        $this->viewBaseTags = $viewBaseTags;
    }


    /**
     * @param string $fileName The name of the file to load.
     * @return ViewInterface A view.
     */
    public function get($fileName)
    {
        $view = new View(new Renderer($this->cacheDir, $this->partialsDir), $this->find($fileName));

        foreach ($this->viewBaseTags as $tag => $value) {
            $view->$tag = $value;
        }

        return $view;
    }


    /**
     * Return a mustache raw template.
     *
     * @param string $fileName The name of the file to load.
     * @return string The unrendered template (raw).
     * @throws \Exception
     */
    public function getUnrendered($fileName)
    {
        return file_get_contents($this->find($fileName));
    }
}
