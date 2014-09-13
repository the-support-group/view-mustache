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
     * @param string $fileName The name of the file to load.
     * @return ViewInterface A view.
     */
    public function get($fileName)
    {
        return new View(new Renderer, $this->find($fileName));
    }
}
