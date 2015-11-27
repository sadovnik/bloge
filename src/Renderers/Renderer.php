<?php

namespace Bloge\Renderers;

use Bloge\NotFoundException;

class Renderer implements \Bloge\Renderer
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
        $path = "{$this->path}/$view";
        
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
        $layout = isset($data['layout']) 
            ? $data['layout'] 
            : 'layout.php';
        
        $data['theme'] = $this;
        $this->data = $data;
        
        return $this->partial($layout, $data);
    }
}