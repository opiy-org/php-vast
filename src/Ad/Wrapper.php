<?php

namespace Sokil\Vast\Ad;

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
        return '\\Sokil\\Vast\\Creative\\Wrapper\\' . $type;
    }

    /**
     * Create Linear creative
     *
     * @return \Sokil\Vast\Creative\Wrapper\Linear
     */
    public function createLinearCreative()
    {
        return $this->buildCreative('Linear');
    }
}
