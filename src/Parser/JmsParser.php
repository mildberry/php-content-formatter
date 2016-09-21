<?php

namespace Mildberry\JMSFormat\Parser;

use Mildberry\JMSFormat\Block\JMSCollectionBlock;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class JmsParser implements ParserInterface
{
    /**
     * @param $content
     * @return JMSCollectionBlock
     */
    public function toCollection($content)
    {
        return new JMSCollectionBlock();
    }

    /**
     * @param JMSCollectionBlock $collection
     * @return string
     */
    public function toContent(JMSCollectionBlock $collection)
    {
        $content = [
            'version' => 'v1',
            'content' => $collection->getContentAsJMSArray(),
        ];

        return json_encode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}