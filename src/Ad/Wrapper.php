<?php

namespace Opiy\Vast\Ad;

class Wrapper extends AbstractAdNode
{
    /**
     * URI of ad tag of downstream Secondary Ad Server
     *
     * @param string $uri
     * @return $this
     */
    public function setVASTAdTagURI($uri)
    {
        $this->setScalarNodeCdata('VASTAdTagURI', $uri);
        return $this;
    }

    /**
     * @inheritdoc
     */
    protected function buildCreativeClassName($type)
    {
        return '\\Opiy\\Vast\\Creative\\Wrapper\\' . $type;
    }

    /**
     * Create Linear creative
     *
     * @return \Opiy\Vast\Creative\Wrapper\Linear
     */
    public function createLinearCreative()
    {
        return $this->buildCreative('Linear');
    }
}
