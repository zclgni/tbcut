<?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPUnit\Framework\Constraint;

use Countable;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\SelfDescribing;
use SebastianBergmann\Comparator\ComparisonFailure;
use SebastianBergmann\Exporter\Exporter;

/**
 * Abstract base class for constraints which can be applied to any value.
 */
abstract class Constraint implements Countable, SelfDescribing
{
    protected $exporter;

    public function __construct()
    {
        $this->exporter = new Exporter;
    }

    /**
     * Evaluates the constraint for parameter $other
     *
     * If $returnResult is set to false (the default), an exception is thrown
     * in case of a failure. null is returned otherwise.
     *
     * If $returnResult is true, the result of the evaluation is returned as
     * a boolean value instead: true in case of success, false in case of a
     * failure.
     *
     * @param mixed  $other        value or object to evaluate
     * @param string $description  Additional information about the test
     * @param bool   $returnResult Whether to return a result or throw an exception
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @return mixed
     */
    public function evaluate($other, $description = '', $returnResult = false)
    {
        $success = false;

        if ($this->matches($other)) {
            $success = true;
        }

        if ($returnResult) {
            return $success;
        }

        if (!$success) {
            $this->fail($other, $description);
        }
    }

    /**
     * Counts the number of constraint elements.
     *
     * @return int
     */
    public function count(): int
    {
        return 1;
    }

    /**
     * Evaluates the constraint for parameter $other. Returns true if the
     * constraint is met, false otherwise.
     *
     * This method can be overridden to implement the evaluation algorithm.
     *
     * @param mixed $other value or object to evaluate
     *
     * @return bool
     */
    protected function matches($other): bool
    {
        return false;
    }

    /**
     * Throws an exception for the given compared value and test description
     *
     * @param mixed             $other             evaluated value or object
     * @param string            $description       Additional information about the test
     * @param ComparisonFailure $comparisonFailure
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    protected function fail($other, $description, ComparisonFailure $comparisonFailure = null): void
    {
        $failureDescription = \sprintf(
            'Failed asserting that %s.',
            $this->failureDescription($other)
        );

        $additionalFailureDescription = $this->additionalFailureDescription($other);

        if ($additionalFailureDescription) {
            $failureDescription .= "\n" . $additionalFailureDescription;
        }

        if (!empty($description)) {
            $failureDescription = $description . "\n" . $failureDescription;
        }

        throw new ExpectationFailedException(
            $failureDescription,
            $comparisonFailure
        );
    }

    /**
     * Return additional failure description where needed
     *
     * The function can be overridden to provide additional failure
     * information like a diff
     *
     * @param mixed $other evaluated value or object
     *
     * @return string
     */
    protected function additionalFailureDescription($other): string
    {
        return '';
    }

    /**
     * Returns the description of the failure
     *
     * The beginning of failure messages is "Failed asserting that" in most
     * cases. This method should return the second part of that sentence.
     *
     * To provide additional failure information additionalFailureDescription
     * can be used.
     *
     * @param mixed $other evaluated value or object
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @return string
     */
    protected function failureDescription($other): string
    {
        return $this->exporter->export($other) . ' ' . $this->toString();
    }
}
