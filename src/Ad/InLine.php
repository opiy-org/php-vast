<?php

namespace OpiyOrg\Vast\Ad;

use OpiyOrg\Vast\Creative\AbstractLinearCreative;
use OpiyOrg\Vast\Creative\InLine\Linear;

class InLine extends AbstractAdNode
{
    /**
     * Set Ad title
     *
     * @param string $value
     *
     * @return \OpiyOrg\Vast\Ad\InLine
     */
    public function setAdTitle($value)
    {
        $this->setScalarNodeCdata('AdTitle', $value);

        return $this;
    }

    /**
     * @inheritdoc
     */
    protected function buildCreativeClassName($type)
    {
        return '\\OpiyOrg\\Vast\\Creative\\InLine\\' . $type;
    }

    /**
     * Create Linear creative
     *
     * @throws \Exception
     * @return AbstractLinearCreative
     */
    public function createLinearCreative()
    {
        return $this->buildCreative('Linear');
    }
}
