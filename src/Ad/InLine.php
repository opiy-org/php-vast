<?php

namespace OpiyOrg\Vast\Ad;

use OpiyOrg\Vast\Creative\AbstractCreative;
use OpiyOrg\Vast\Creative\InLine\Linear as InLineAdLinearCreative;

class InLine extends AbstractAdNode
{
    /**
     * @private
     */
    const CREATIVE_TYPE_LINEAR = 'Linear';

    /**
     * Set Ad title
     *
     * @param string $value
     *
     * @return InLine
     */
    public function setAdTitle($value)
    {
        $this->setScalarNodeCdata('AdTitle', $value);

        return $this;
    }

    /**
     * @return string[]
     */
    protected function getAvailableCreativeTypes()
    {
        return array(
            self::CREATIVE_TYPE_LINEAR,
        );
    }

    /**
     * @param string $type
     * @param \DOMElement $creativeDomElement
     *
     * @return AbstractCreative|InLineAdLinearCreative
     */
    protected function buildCreativeElement($type, \DOMElement $creativeDomElement)
    {
        switch ($type) {
            case self::CREATIVE_TYPE_LINEAR:
                $creative = $this->vastElementBuilder->createInLineAdLinearCreative($creativeDomElement);
                break;
            default:
                throw new \RuntimeException(sprintf('Unknown Wrapper creative type %s', $type));
        }

        return $creative;
    }

    /**
     * Create Linear creative
     *
     * @throws \Exception
     *
     * @return InLineAdLinearCreative
     */
    public function createLinearCreative()
    {
        /** @var InLineAdLinearCreative $creative */
        $creative = $this->buildCreative(self::CREATIVE_TYPE_LINEAR);

        return $creative;
    }
}
