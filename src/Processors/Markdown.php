<?php

namespace Bloge\Processors;

use Bloge\Processor;
use Parsedown;

class Markdown extends Parsedown implements Processor
{
    public function process($file, array $data)
    {
        $data['content'] = $this->text($data['content']);
        
        return $data;
    }
}