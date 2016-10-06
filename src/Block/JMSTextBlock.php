<?php

namespace Mildberry\JMSFormat\Block;

use Mildberry\JMSFormat\Interfaces\ColorModifierInterface;
use Mildberry\JMSFormat\Interfaces\DecorationModifierInterface;
use Mildberry\JMSFormat\Modifier\ColorModifierTrait;
use Mildberry\JMSFormat\Modifier\DecorationModifierTrait;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class JMSTextBlock extends JMSAbstractContentBlock implements ColorModifierInterface, DecorationModifierInterface
{
    use ColorModifierTrait;
    use DecorationModifierTrait;

    /**
     * @var string
     */
    protected $blockName = 'text';

    /**
     * @var string
     */
    protected $tagName = 'span';

    /**
     * @return string
     */
    public function getHTMLText()
    {
        return ($this->tagName == 'span' && empty($this->getModifiersClasses())) ? $this->getContent() : parent::getHTMLText();
    }
}
