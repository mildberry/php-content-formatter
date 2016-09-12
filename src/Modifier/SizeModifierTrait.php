<?php

namespace Mildberry\Library\ContentFormatter\Modifier;

use Mildberry\Library\ContentFormatter\Exception\WrongModifierValueException;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
trait SizeModifierTrait
{
    /**
     * @var string
     */
    protected $size;

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param string $size
     * @return $this
     * @throws WrongModifierValueException
     */
    public function setSize($size)
    {
        if (!in_array($size, $this->getFloatingAllowedValues())) {
            throw new WrongModifierValueException('Size value: "'.$size.'" not valid, must be ['.implode(',', $this->getSizeAllowedValues()).']');
        }

        $this->size = $size;

        return $this;
    }

    /**
     * @return array
     */
    public function getSizeAllowedValues()
    {
        return ['wide'];
    }
}