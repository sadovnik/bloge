<?php

namespace Bloge\Content;

use Bloge\NotFoundException;

/**
 * Basic PHP content
 * 
 * @package bloge
 */
class PHP extends FileSystem
{
    /**
     * @{inheritDoc}
     */
    public function fetch($path, array $data = [])
    {
        $file = \Bloge\globPath($this->path($path));
        
        if (!is_file($file)) {
            throw new NotFoundException($path);
        }
        
        return \Bloge\renderData($file, $data);
    }
}