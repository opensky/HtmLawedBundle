<?php

namespace OpenSky\Bundle\HtmLawedBundle\Tests\Form\DataTransformer;

use OpenSky\Bundle\HtmLawedBundle\Form\DataTransformer\HtmLawedTransformer;

class HtmLawedTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testTransformIsAnIdentityFunction()
    {
        $transformer = new HtmLawedTransformer();

        $this->assertEquals('input', $transformer->transform('input'));
    }

    public function testReverseTransformShouldFilterInput()
    {
        // The bootstrapped htmLawed() function wraps strip_tags(), but specify
        // an equivalent configuration in case the actual htmLawed() library is
        // used.
        $transformer = new HtmLawedTransformer(array('elements' => '-*'));

        $this->assertEquals('input', $transformer->reverseTransform('<b>input</b>'));
    }
}
