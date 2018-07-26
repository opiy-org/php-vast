<?php

namespace Opiy\Vast\Ad;

use Opiy\Vast\Creative\AbstractLinearCreative;
use Opiy\Vast\Creative\InLine\Linear;

class InLine extends AbstractAdNode
{
    /**
     * Set Ad title
     *
     * @param string $value
     *
     * @return \Opiy\Vast\Ad\InLine
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
        return '\\Opiy\\Vast\\Creative\\InLine\\' . $type;
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
