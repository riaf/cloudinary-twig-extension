<?php

use Cloudinary\Resource as CloudinaryResource;
use Cloudinary\Twig\Extension\CloudinaryExtension;

class CloudinaryExtensionTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $ext = new CloudinaryExtension('test123');

        $this->assertEquals('cloudinary', $ext->getName());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConstructorException()
    {
        $ext = new CloudinaryExtension([]);
    }

    public function testGetUrl()
    {
        $cloudinary = new CloudinaryResource('test123');
        $ext = new CloudinaryExtension($cloudinary);

        $this->assertEquals(
            $cloudinary->getUrl('test'),
            $ext->getUrl('test')
        );

        $this->assertTrue(is_array($ext->getFunctions()));
    }

    public function testGetFacebookUrl()
    {
        $cloudinary = new CloudinaryResource('test123');
        $ext = new CloudinaryExtension('test123');

        $this->assertEquals(
            $cloudinary->getUrl('test', array('type' => 'facebook')),
            $ext->getFacebookUrl('test')
        );
    }

    public function testGetFetchUrl()
    {
        $cloudinary = new CloudinaryResource('test123');
        $ext = new CloudinaryExtension('test123');

        $this->assertEquals(
            $cloudinary->getUrl('http://example.com/?hoge=fuga', array('type' => 'fetch')),
            $ext->getFetchUrl('http://example.com/?hoge=fuga')
        );
    }

    public function testCloudinary()
    {
        $cloudinary = new CloudinaryResource('test123');
        $ext = new CloudinaryExtension($cloudinary);

        $this->assertTrue($ext->getCloudinary() instanceof CloudinaryResource);

        $cloudinary2 = new CloudinaryResource('test456');
        $ext->setCloudinary($cloudinary2);

        $this->assertEquals($cloudinary2, $ext->getCloudinary());
    }
}
