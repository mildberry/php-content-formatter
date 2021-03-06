<?php

namespace Mildberry\JMSFormat\Block;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
abstract class JMSAbstractContentBlock extends JMSAbstractBlock
{
    /**
     * @var string
     */
    protected $content;

    /**
     * @param string $content
     */
    public function __construct($content = '')
    {
        $this->setContent($content);
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
}
