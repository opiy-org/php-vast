<?php

namespace OpiyOrg\Vast\Creative\InLine\Linear;

class MediaFile
{
    const DELIVERY_PROGRESSIVE = 'progressive';
    const DELIVERY_STREAMING = 'streaming';

    private $domElement;

    /**
     * MediaFile constructor.
     * @param \DomElement $domElement
     */
    public function __construct(\DomElement $domElement)
    {
        $this->domElement = $domElement;
    }

    /**
     * @return $this
     */
    public function setProgressiveDelivery()
    {
        $this->domElement->setAttribute('delivery', self::DELIVERY_PROGRESSIVE);
        return $this;
    }

    /**
     * @return $this
     */
    public function setStreamingDelivery()
    {
        $this->domElement->setAttribute('delivery', self::DELIVERY_STREAMING);
        return $this;
    }

    /**
     * @param $delivery
     * @return $this
     * @throws \Exception
     */
    public function setDelivery($delivery)
    {
        if (!in_array($delivery, array(self::DELIVERY_PROGRESSIVE, self::DELIVERY_STREAMING))) {
            throw new \Exception('Wrong delivery specified');
        }

        $this->domElement->setAttribute('delivery', $delivery);
        return $this;
    }


    /**
     * @param $mime
     * @return $this
     */
    public function setType($mime)
    {
        $this->domElement->setAttribute('type', $mime);
        return $this;
    }

    /**
     * @param $width
     * @return $this
     */
    public function setWidth($width)
    {
        $this->domElement->setAttribute('width', $width);
        return $this;
    }

    /**
     * @param $height
     * @return $this
     */
    public function setHeight($height)
    {
        $this->domElement->setAttribute('height', $height);
        return $this;
    }

    /**
     * @param $attribute
     * @param $value
     * @return $this
     */
    public function setCustom($attribute, $value)
    {
        $this->domElement->setAttribute($attribute, $value);
        return $this;
    }

    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url)
    {
        $cdata = $this->domElement->ownerDocument->createCDATASection($url);

        // update CData
        if ($this->domElement->hasChildNodes()) {
            $this->domElement->replaceChild($cdata, $this->domElement->firstChild);
        } // insert CData
        else {
            $this->domElement->appendChild($cdata);
        }
        return $this;
    }

    /**
     * @param int $bitrate
     * @return MediaFile
     */
    public function setBitrate($bitrate)
    {
        $this->domElement->setAttribute('bitrate', (int)$bitrate);
        return $this;
    }


    /**
     * Get id for Ad element
     *
     * @return string
     */
    public function getId()
    {
        return $this->domElement->getAttribute('id');
    }

    /**
     * Set 'id' attribute of 'ad' element
     *
     * @param string $id
     *
     * @return MediaFile
     */
    public function setId($id)
    {
        $this->domElement->setAttribute('id', $id);

        return $this;
    }

}
