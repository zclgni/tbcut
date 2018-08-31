<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\EventDispatcher;

/**
 * Event encapsulation class.
 *
 * Encapsulates events thus decoupling the observer from the subject they encapsulate.
 *
 * @author Drak <drak@zikula.org>
 */
class GenericEvent extends Event implements \ArrayAccess, \IteratorAggregate
{
    protected $subject;
    protected $arguments;

    /**
     * Encapsulate an event with $subject and $args.
     *
     * @param mixed $subject   The subject of the event, usually an object or a callable
     * @param array $arguments Arguments to store in the event
     */
    public function __construct($subject = null, array $arguments = array())
    {
        $this->subject = $subject;
        $this->arguments = $arguments;
    }

    /**
     * Getter for subject property.
     *
     * @return mixed $subject The observer subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Get argument by key.
     *
     * @param string $key Key
     *
     * @return mixed Contents of array key
     *
     * @throws \InvalidArgumentException if key is not found
     */
    public function getArgument($key)
    {
        if ($this->hasArgument($key)) {
            return $this->arguments[$key];
        }

        throw new \InvalidArgumentException(sprintf('Argument "%s" not found.', $key));
    }

    /**
     * Add argument to event.
     *
     * @param string $key   Argument name
     * @param mixed  $value Value
     *
     * @return $this
     */
    public function setArgument($key, $value)
    {
        $this->arguments[$key] = $value;

        return $this;
    }

    /**
     * Getter for all arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Set args property.
     *
     * @param array $args Arguments
     *
     * @return $this
     */
    public function setArguments(array $args = array())
    {
        $this->arguments = $args;

        return $this;
    }

    /**
     * Has argument.
     *
     * @param string $key Key of arguments array
     *
     * @return bool
     */
    public function hasArgument($key)
    {
        return array_key_exists($key, $this->arguments);
    }

    /**
     * ArrayAccess for argument getter.
     *
     * @param string $key Array key
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException if key does not exist in $this->args
     */
    public function offsetGet($key)
    {
        return $this->getArgument($key);
    }

    /**
     * ArrayAccess for argument setter.
     *
     * @param string $key   Array key to set
     * @param mixed  $value Value
     */
    public function offsetSet($key, $value)
    {
        $this->setArgument($key, $value);
    }

    /**
     * ArrayAccess for unset argument.
     *
     * @param string $key Array key
     */
    public function offsetUnset($key)
    {
        if ($this->hasArgument($key)) {
            unset($this->arguments[$key]);
        }
    }

    /**
     * ArrayAccess has argument.
     *
     * @param string $key Array key
     *
     * @return bool
     */
    public function offsetExists($key)
    {
        return $this->hasArgument($key);
    }

    /**
     * IteratorAggregate for iterating over the object like an array.
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->arguments);
    }
}
