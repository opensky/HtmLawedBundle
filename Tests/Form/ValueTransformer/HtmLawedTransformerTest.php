<?php

namespace OpenSky\Bundle\HtmLawedBundle\Tests\Form\ValueTransformer;

use OpenSky\Bundle\HtmLawedBundle\Form\ValueTransformer\HtmLawedTransformer;

class HtmlLawedTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testTransformShouldFilterInput()
    {
        // The bootstrapped htmLawed() function wraps strip_tags(), but specify
        // an equivalent configuration in case the actual htmLawed() library is
        // used.
        $transformer = new HtmLawedTransformer(array('elements' => '-*'));

        $this->assertEquals('input', $transformer->transform('<b>input</b>'));
    }

    public function testReverseTransformIsAnIdentityFunction()
    {
        $transformer = new HtmLawedTransformer();

        $this->assertEquals('input', $transformer->reverseTransform('input'));
    }
}
