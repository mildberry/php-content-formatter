<?php

namespace Mildberry\JMSFormat\Tests\Unit;

use Mildberry\JMSFormat\Block\JMSBlockquoteBlock;
use Mildberry\JMSFormat\Block\JMSCollectionBlock;
use Mildberry\JMSFormat\Block\JMSHeadlineBlock;
use Mildberry\JMSFormat\Block\JMSImageBlock;
use Mildberry\JMSFormat\Block\JMSLinkBlock;
use Mildberry\JMSFormat\Block\JMSParagraphBlock;
use Mildberry\JMSFormat\Block\JMSTextBlock;
use Mildberry\JMSFormat\Block\JMSVideoBlock;
use Mildberry\JMSFormat\Exception\BadBlockTypeForAddToCollection;
use Mildberry\JMSFormat\Tests\TestCase;

/**
 * @author Egor Zyuskin <e.zyuskin@mildberry.com>
 */
class JMSFormatItemsTest extends TestCase
{
    public function testFiledBlockQuoteItem()
    {
        $this->setExpectedException(BadBlockTypeForAddToCollection::class);
        $item = new JMSBlockquoteBlock();
        $item->addBlock(new JMSHeadlineBlock());
    }

    public function testSuccessBlockQuoteItem()
    {
        $item = (new JMSBlockquoteBlock())
            ->addBlock((new JMSLinkBlock())->setHref('http://www.mildberry.com'))
            ->addBlock((new JMSImageBlock()))
            ->addBlock((new JMSTextBlock('c')))
        ;
        $this->assertEquals('{"version":"v1","content":[{"block":"blockquote","modifiers":[],"content":[{"block":"link","modifiers":[],"attributes":{"href":"http://www.mildberry.com"}},{"block":"image","modifiers":[]},{"block":"text","modifiers":[],"content":"c"}]}]}', $this->asJmsText($item));
    }

    public function testFiledHeadLineItem()
    {
        $this->setExpectedException(BadBlockTypeForAddToCollection::class);
        $item = new JMSHeadlineBlock();
        $item->addBlock(new JMSParagraphBlock());
    }

    public function testSuccessHeadLineItem()
    {
        $item = new JMSHeadlineBlock();
        $item->setWeight('xs');
        $item->addBlock((new JMSTextBlock('c')));
        $this->assertEquals('{"version":"v1","content":[{"block":"headline","modifiers":{"weight":"xs"},"content":[{"block":"text","modifiers":[],"content":"c"}]}]}', $this->asJmsText($item));
    }

    public function testSuccessImageItem()
    {
        $item = new JMSImageBlock();
        $item->setFloating('left');
        $item->setSize('wide');
        $item->setSrc('https://www.ya.ru/favicon.ico');
        $this->assertEquals('{"version":"v1","content":[{"block":"image","modifiers":{"floating":"left","size":"wide"},"attributes":{"src":"https://www.ya.ru/favicon.ico"}}]}', $this->asJmsText($item));
    }

    public function testFiledParagraphItem()
    {
        $this->setExpectedException(BadBlockTypeForAddToCollection::class);
        $item = new JMSParagraphBlock();
        $item->addBlock(new JMSHeadlineBlock());
    }

    public function testSuccessParagraphItem()
    {
        $item = (new JMSParagraphBlock())
            ->setAlignment('center')
            ->addBlock((new JMSImageBlock()))
            ->addBlock((new JMSTextBlock('c')))
        ;
        $this->assertTrue(true);

        $collection = (new JMSCollectionBlock())
            ->addBlock(new JMSTextBlock('c'))
            ->addBlock((new JMSLinkBlock())->setHref('http://www.mildberry.com'))
        ;
        $item->addCollection($collection);

        $this->assertEquals('{"version":"v1","content":[{"block":"paragraph","modifiers":{"alignment":"center"},"content":[{"block":"image","modifiers":[]},{"block":"text","modifiers":[],"content":"c"},{"block":"text","modifiers":[],"content":"c"},{"block":"link","modifiers":[],"attributes":{"href":"http://www.mildberry.com"}}]}]}', $this->asJmsText($item));
    }

    public function testSuccessTextItem()
    {
        $item = new JMSTextBlock();
        $item->setContent('content');
        $item->setColor('info');
        $item->setDecoration('bold');
        $this->assertEquals('{"version":"v1","content":[{"block":"text","modifiers":{"color":"info","decoration":["bold"]},"content":"content"}]}', $this->asJmsText($item));
    }

    public function testSuccessVideoBlock()
    {
        $item = (new JMSVideoBlock())
            ->setVideoSrc('http://player.youku.com/player.php/sid/XMzIzNDI5Mzg4/v.swf')
            ->setVideoProvider('youku')
            ->setVideoId('XMzIzNDI5Mzg4')
            ->setSize('wide')
        ;

        $this->assertEquals('{"version":"v1","content":[{"block":"video","modifiers":{"size":"wide"},"attributes":{"videoSrc":"http://player.youku.com/player.php/sid/XMzIzNDI5Mzg4/v.swf","videoId":"XMzIzNDI5Mzg4","videoProvider":"youku"}}]}', $this->asJmsText($item));
    }

    public function testSuccessLinkBlock()
    {
        $item = (new JMSLinkBlock())
            ->setHref('http://www.mildberry.com')
            ->addBlock((new JMSTextBlock('Mildberry')))
            ->setTarget('_blank')
        ;

        $this->assertEquals('{"version":"v1","content":[{"block":"link","modifiers":[],"attributes":{"href":"http://www.mildberry.com","target":"_blank"},"content":[{"block":"text","modifiers":[],"content":"Mildberry"}]}]}', $this->asJmsText($item));
    }
}
