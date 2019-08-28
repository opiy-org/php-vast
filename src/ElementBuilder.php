<?php

namespace OpiyOrg\Vast;

use OpiyOrg\Vast\Ad\InLine;
use OpiyOrg\Vast\Ad\Wrapper;
use OpiyOrg\Vast\Creative\InLine\Linear as InLineAdLinearCreative;
use OpiyOrg\Vast\Creative\Wrapper\Linear as WrapperAdLinearCreative;
use OpiyOrg\Vast\Creative\InLine\Linear\MediaFile;

/**
 * Builder of VAST document elements, useful for overriding element classes
 */
class ElementBuilder
{
    /**
     * <?xml> with <VAST> inside
     *
     * @param \DomDocument $xmlDocument
     *
     * @return Document
     */
    public function createDocument(\DomDocument $xmlDocument)
    {
        return new Document(
            $xmlDocument,
            $this
        );
    }

    /**
     * <Ad> with <InLine> inside
     *
     * @param \DomElement $adElement
     *
     * @return InLine
     */
    public function createInLineAdNode(\DomElement $adElement)
    {
        return new InLine($adElement, $this);
    }

    /**
     * <Ad> with <Wrapper> inside
     *
     * @param \DomElement $adElement
     *
     * @return Wrapper
     */
    public function createWrapperAdNode(\DomElement $adElement)
    {
        return new Wrapper($adElement, $this);
    }

    /**
     * <Ad><InLine><Creatives><Creative> with <Linear> inside
     *
     * @param \DOMElement $creativeDomElement
     *
     * @return InLineAdLinearCreative
     */
    public function createInLineAdLinearCreative(\DOMElement $creativeDomElement)
    {
        return new InLineAdLinearCreative($creativeDomElement, $this);
    }

    /**
     * <Ad><Wrapper><Creatives><Creative> with <Linear> inside
     *
     * @param \DOMElement $creativeDomElement
     *
     * @return WrapperAdLinearCreative
     */
    public function createWrapperAdLinearCreative(\DOMElement $creativeDomElement)
    {
        return new WrapperAdLinearCreative($creativeDomElement, $this);
    }

    /**
     * <Ad><InLine><Creatives><Creative><Linear><MediaFile>
     *
     * @param \DOMElement $mediaFileDomElement
     *
     * @return MediaFile
     */
    public function createInLineAdLinearCreativeMediaFile(\DOMElement $mediaFileDomElement)
    {
        return new MediaFile($mediaFileDomElement);
    }
}