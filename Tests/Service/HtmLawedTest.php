<?php

namespace OpenSky\Bundle\HtmLawedBundle\Tests\Service;

use OpenSky\Bundle\HtmLawedBundle\Service\HtmLawed;

class HtmlLawedTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldProcessInput()
    {
        $htmLawed = new HtmLawed();

        // The bootstrap's htmLawed() declaration is an identity function
        $this->assertEquals('input', $htmLawed->process('input'));
    }
}
