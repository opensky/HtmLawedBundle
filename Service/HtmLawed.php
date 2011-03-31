<?php

namespace OpenSky\Bundle\HtmLawedBundle\Service;

class HtmLawed
{
    private $config;
    private $spec;

    /**
     * Constructor.
     *
     * @param array  $config Configuration parameter for htmLawed()
     * @param string $spec   HTML specification parameter for htmLawed()
     */
    public function __construct(array $config = array(), $spec = null)
    {
        $this->config = $config;
        $this->spec = (string) $spec;
    }

    /**
     * Processes input through htmLawed().
     *
     * @param string $input
     */
    public function process($input)
    {
        return htmLawed($input, $this->config, $this->spec);
    }
}
