<?php

namespace Bloge\Renderers;

use Bloge\NotFoundException;

/**
 * Basic renderer
 * 
 * This renderer renders raw PHP templates
 * 
 * @package bloge
 */
class PHP implements IRenderer
{
    /**
     * @var string $path
     */
    protected $path;
    
    /**
     * @var array $data
     */
    protected $data = [];
    
    /**
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = chop($path, '/');
    }
    
    /**
     * @param string $view
     * @param array $data
     * @return string
     */
    public function partial($view, array $data = [])
    {
        $data['theme'] = $this;
        $view = \Bloge\removeExtension($view);
        $path = "{$this->path}/$view.php";
        
        if (!file_exists($path)) {
            throw new NotFoundException($view);
        }
        
        return \Bloge\render($path, array_merge($this->data, $data));
    }
    
    /**
     * @{inheritDoc} 
     */
    public function render(array $data = [])
    {
        $this->data = $data;
        $layout = isset($data['layout']) 
            ? $data['layout'] 
            : 'layout';
        
        return $this->partial($layout, $data);
    }
}