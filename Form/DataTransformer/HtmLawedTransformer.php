<?php

namespace OpenSky\Bundle\HtmLawedBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

class HtmLawedTransformer implements DataTransformerInterface
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
        return $value;
    }

    /**
     * @see Symfony\Component\Form\ValueTransformer.ValueTransformerInterface::reverseTransform()
     */
    public function reverseTransform($value)
    {
        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        if ('' === $value) {
            return null;
        }

        return htmLawed($value, $this->config, $this->spec);
    }
}
