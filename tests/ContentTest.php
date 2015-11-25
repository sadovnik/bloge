<?php

use Bloge\Basic\Content;

/**
 * @todo cleanup data() dataProvider
 */
class ContentTest extends TestCase
{
    public function data()
    {
        return [
            [
                'index.php', 
                [
                    'title' => 'hello', 
                    'content' => 'Hello!'
                ]
            ],
            [
                'project.php', 
                [
                    'title' => 'Much projects',
                    'content' => '
Much projects, so awesome:

* Doge food
* Doge bloge
* Doge meme
* Dogescript
'
                ]
            ]
        ];
    }
    
    public function failingData()
    {
        return [
            ['foobar.php'],
            ['tron.php']
        ];
    }
    
    private function content()
    {
        return new Content(CONTENT_DIR);
    }
    
    /**
     * @dataProvider data
     */
    public function testFetch($file, $expected)
    {
        $this->assertEquals(
            $expected, 
            $this->content()->fetch($file)
        );
    }
    
    /**
     * @dataProvider failingData
     * @expectedException \Bloge\FileNotFoundException
     */
    public function testFailingFetch($file)
    {
        $this->content()->fetch($file);
    }
    
    public function testBrowse()
    {
        $this->assertEquals(
            Bloge\listFiles(CONTENT_DIR, CONTENT_DIR),
            $this->content()->browse()
        );
    }
}