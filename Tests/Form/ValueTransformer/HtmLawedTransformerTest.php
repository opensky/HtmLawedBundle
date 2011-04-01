<?php

namespace OpenSky\Bundle\HtmLawedBundle\Tests\Form\ValueTransformer;

use OpenSky\Bundle\HtmLawedBundle\Form\ValueTransformer\HtmLawedTransformer;

class HtmlLawedTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testTransformShouldFilterInput()
    {
        $transformer = new HtmLawedTransformer();

        // The bootstrapped htmLawed() function wraps strip_tags()
        $this->assertEquals('input', $transformer->transform('<b>input</b>'));
    }

    public function testReverseTransformIsAnIdentityFunction()
    {
        $transformer = new HtmLawedTransformer();

        $this->assertEquals('input', $transformer->reverseTransform('input'));
    }
}
