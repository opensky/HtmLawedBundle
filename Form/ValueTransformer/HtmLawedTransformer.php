<?php

namespace OpenSky\Bundle\HtmLawedBundle\Form\ValueTransformer;

use Symfony\Component\Form\ValueTransformer\ValueTransformerInterface;

class HtmLawedTransformer implements ValueTransformerInterface
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
     * @see Symfony\Component\Form\ValueTransformer.ValueTransformerInterface::transform()
     */
    public function transform($value)
    {
        return htmLawed($value, $this->config, $this->spec);
    }

    /**
     * @see Symfony\Component\Form\ValueTransformer.ValueTransformerInterface::reverseTransform()
     */
    public function reverseTransform($value)
    {
        return $value;
    }
}
