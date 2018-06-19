<?php

class ImageTest extends ContentfulTestCase {
    

    protected function getPackageProviders($app)
    {
        return [
            'Distilleries\Contentful\ContentfulServiceProvider',
            'AgentProviderTest'
        ];
    }

    public function testGetUrl()
    {
        $url = "http://test.com/test.jpg";

       
           $this->assertEquals( \Distilleries\Contentful\Helpers\Image::getUrl($url), $url.'?q=80&fit=fill');
    }

     public function testGetUrlWithParameters()
    {
        $url = "http://test.com/test.jpg?q=80&fit=fill";

        $this->assertEquals( \Distilleries\Contentful\Helpers\Image::getUrl($url), $url);
    }

    public function testGetWebpEnabled()
    {

        $url = "http://test.com/test.jpg";

         $this->app->make('config')->set('contentful.image.webp_enabled',true);
         $this->assertEquals( \Distilleries\Contentful\Helpers\Image::getUrl($url), $url.'?q=80&fm=webp&fit=fill');

    }

    
    public function testGetWebpDisabled()
    {

        $url = "http://test.com/test.jpg";

         $this->app->make('config')->set('contentful.image.webp_enabled',false);
         $this->assertEquals( \Distilleries\Contentful\Helpers\Image::getUrl($url), $url.'?q=80&fit=fill');

    }

   public function testProgressiveMode()
    {

        $url = "http://test.com/test.jpg";

         $this->app->make('config')->set('contentful.image.webp_enabled',false);
         $this->app->make('config')->set('contentful.image.progressive','progressive');
         $this->assertEquals( \Distilleries\Contentful\Helpers\Image::getUrl($url), $url.'?q=80&fl=progressive&fit=fill');

    }


    public function testGetUrlWithReplaceHost()
    {
        $url = "http://test.com/test.jpg";

        $this->app->make('config')->set('contentful.image.replace_host','test.com');
        $this->app->make('config')->set('contentful.image.dest_host','test-destination.com');

         $this->assertEquals( \Distilleries\Contentful\Helpers\Image::getUrl($url),'http://test-destination.com/test.jpg?q=80&fit=fill');

    }

    public function testGetUrlWithWebp()
    {
        $url = "http://test.com/test.jpg?";

        $this->app->make('config')->set('contentful.image.webp_enabled',true);

        $this->assertEquals( \Distilleries\Contentful\Helpers\Image::getUrl($url), $url.'q=80&fm=webp&fit=fill');
    }

    public function testGetUrlWithoutWebp()
    {
        $url = "http://test.com/test.jpg?";

        $this->app->make('config')->set('contentful.image.webp_enabled',false);
        $this->app->make('config')->set('contentful.image.progressive','progressive');

        $this->assertEquals( \Distilleries\Contentful\Helpers\Image::getUrl($url), $url.'q=80&fl=progressive&fit=fill');

    }

}


