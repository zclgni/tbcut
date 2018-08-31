<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\CssSelector\Parser;

/**
 * CSS selector token.
 *
 * This component is a port of the Python cssselect library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 *
 * @internal
 */
class Token
{
    const TYPE_FILE_END = 'eof';
    const TYPE_DELIMITER = 'delimiter';
    const TYPE_WHITESPACE = 'whitespace';
    const TYPE_IDENTIFIER = 'identifier';
    const TYPE_HASH = 'hash';
    const TYPE_NUMBER = 'number';
    const TYPE_STRING = 'string';

    private $type;
    private $value;
    private $position;

    public function __construct(?string $type, ?string $value, ?int $position)
    {
        $this->type = $type;
        $this->value = $value;
        $this->position = $position;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function isFileEnd(): bool
    {
        return self::TYPE_FILE_END === $this->type;
    }

    public function isDelimiter(array $values = array()): bool
    {
        if (self::TYPE_DELIMITER !== $this->type) {
            return false;
        }

        if (empty($values)) {
            return true;
        }

        return in_array($this->value, $values);
    }

    public function isWhitespace(): bool
    {
        return self::TYPE_WHITESPACE === $this->type;
    }

    public function isIdentifier(): bool
    {
        return self::TYPE_IDENTIFIER === $this->type;
    }

    public function isHash(): bool
    {
        return self::TYPE_HASH === $this->type;
    }

    public function isNumber(): bool
    {
        return self::TYPE_NUMBER === $this->type;
    }

    public function isString(): bool
    {
        return self::TYPE_STRING === $this->type;
    }

    public function __toString(): string
    {
        if ($this->value) {
            return sprintf('<%s "%s" at %s>', $this->type, $this->value, $this->position);
        }

        return sprintf('<%s at %s>', $this->type, $this->position);
    }
}
