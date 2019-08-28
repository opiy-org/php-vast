<?php

namespace OpiyOrg\Vast\Creative\InLine;

use OpiyOrg\Vast\Creative\AbstractLinearCreative;
use OpiyOrg\Vast\Creative\InLine\Linear\MediaFile;
use OpiyOrg\Vast\Creative\InLine\Linear\AdParameters;

class Linear extends AbstractLinearCreative
{
    /**
     * @var \DOMElement
     */
    private $mediaFilesDomElement;

    /**
     * @var \DOMElement
     */
    private $adParametersDomElement;

    /**
     * Set duration value
     *
     * @param int|string $duration seconds or time in format "H:m:i"
     *
     * @return $this
     */
    public function setDuration($duration)
    {
        // get dom element
        $durationDomElement = $this->getDomElement()->getElementsByTagName('Duration')->item(0);
        if (!$durationDomElement) {
            $durationDomElement = $this->getDomElement()->ownerDocument->createElement('Duration');
            $this->getDomElement()->getElementsByTagName('Linear')->item(0)->appendChild($durationDomElement);
        }

        // set value
        if (is_numeric($duration)) { // in seconds
            $msDuration = $duration - (int)$duration;

            $duration = $this->secondsToString($duration);
            if ($msDuration > 0) {
                $msDuration = explode('.', $msDuration);
                $msDuration = str_pad($msDuration[1], 3, '0', STR_PAD_RIGHT);
                $duration .= '.' . substr($msDuration, 0, 3);
            }
        }

        $durationDomElement->nodeValue = $duration;

        return $this;
    }

    /**
     * @return MediaFile
     */
    public function createMediaFile()
    {
        if (empty($this->mediaFilesDomElement)) {
            $this->mediaFilesDomElement = $this->getDomElement()->getElementsByTagName('MediaFiles')->item(0);
            if (!$this->mediaFilesDomElement) {
                $this->mediaFilesDomElement = $this->getDomElement()->ownerDocument->createElement('MediaFiles');
                $this->getDomElement()
                    ->getElementsByTagName('Linear')
                    ->item(0)
                    ->appendChild($this->mediaFilesDomElement);
            }
        }

        // dom
        $mediaFileDomElement = $this->mediaFilesDomElement->ownerDocument->createElement('MediaFile');
        $this->mediaFilesDomElement->appendChild($mediaFileDomElement);

        // object
        return $this->vastElementBuilder->createInLineAdLinearCreativeMediaFile($mediaFileDomElement);
    }

    /**
     * @param array|string $params
     *
     * @return self
     */
    public function setAdParameters($params)
    {
        $this->adParametersDomElement = $this->getDomElement()->getElementsByTagName('AdParameters')->item(0);
        if (!$this->adParametersDomElement) {
            $this->adParametersDomElement = $this->getDomElement()->ownerDocument->createElement('AdParameters');
            $this->getDomElement()->getElementsByTagName('Linear')->item(0)->appendChild($this->adParametersDomElement);
        }

        if (is_array($params)) {
            $params = json_encode($params);
        }

        $cdata = $this->adParametersDomElement->ownerDocument->createCDATASection($params);

        // update CData
        if ($this->adParametersDomElement->hasChildNodes()) {
            $this->adParametersDomElement->replaceChild($cdata, $this->adParametersDomElement->firstChild);
        } // insert CData
        else {
            $this->adParametersDomElement->appendChild($cdata);
        }

        return $this;
    }

    /**
     * @param int|string $time seconds or time in format "H:m:i"
     * @return $this
     */
    public function skipAfter($time)
    {
        if (is_numeric($time)) {
            $time = $this->secondsToString($time);
        }

        $this->getDomElement()->getElementsByTagName('Linear')->item(0)->setAttribute('skipoffset', $time);

        return $this;
    }


    /**
     * <UniversalAdId> required element for the purpose of tracking ad creative, he added in VAST 4.0 spec.
     * Paragraph 3.7.1
     * https://iabtechlab.com/wp-content/uploads/2018/11/VAST4.1-final-Nov-8-2018.pdf
     *
     * @param int|string $idRegistry
     * @param int|string $universalAdId
     * @return $this
     */
    public function setUniversalAdId($idRegistry, $universalAdId)
    {
        $universalAdIdDomElement = $this->getDomElement()->ownerDocument->createElement('UniversalAdId');
        $universalAdIdDomElement->nodeValue = $universalAdId;
        $universalAdIdDomElement->setAttribute("idRegistry", $idRegistry);
        $this->getDomElement()->insertBefore($universalAdIdDomElement, $this->getDomElement()->firstChild);

        return $this;
    }
}
