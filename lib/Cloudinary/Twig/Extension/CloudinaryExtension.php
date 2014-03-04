<?php

namespace Cloudinary\Twig\Extension;

use Cloudinary\Resource as CloudinaryResource;

/**
 * Cloudinary twig extension.
 *
 * @author Keisuke SATO <sato@crocos.co.jp>
 */
class CloudinaryExtension extends \Twig_Extension
{
    /**
     * @var CloudinaryResource $cloudinary
     */
    protected $cloudinary;

    /**
     * Constructor.
     *
     * @param CloudinaryResource|string $cloudName
     */
    public function __construct($cloudName)
    {
        if ($cloudName instanceof CloudinaryResource) {
            $this->cloudinary = $cloudName;
        } elseif (is_string($cloudName)) {
            $this->cloudinary = new CloudinaryResource($cloudName);
        } else {
            throw new \InvalidArgumentException();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'cl_url' => new \Twig_Function_Method($this, 'getUrl'),
            'cl_fb_url' => new \Twig_Function_Method($this, 'getFacebookUrl'),
            'cl_fetch_url' => new \Twig_Function_Method($this, 'getFetchUrl'),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'cloudinary';
    }

    /**
     * Get cloudinary url
     *
     * @param string $name
     * @param array $options
     * @return string
     */
    public function getUrl($name, array $options = array())
    {
        return $this->cloudinary->getUrl($name, $options);
    }

    /**
     * Get cloudinary facebook url
     *
     * @param string $name
     * @param array $options
     * @return string
     */
    public function getFacebookUrl($name, array $options = array())
    {
        $options['type'] = 'facebook';

        return $this->cloudinary->getUrl($name, $options);
    }

    /**
     * Get cloudinary fetch url
     *
     * @param string $name
     * @param array $options
     * @return string
     */
    public function getFetchUrl($name, array $options = array())
    {
        $options['type'] = 'fetch';

        return $this->cloudinary->getUrl($name, $options);
    }

    /**
     * Set cloudinary
     *
     * @param CloudinaryResource $resource
     * @return CloudinaryExtension
     */
    public function setCloudinary(CloudinaryResource $resource)
    {
        $this->cloudinary = $resource;

        return $this;
    }

    /**
     * Get cloudinary
     *
     * @return CloudinaryResource
     */
    public function getCloudinary()
    {
        return $this->cloudinary;
    }
}
