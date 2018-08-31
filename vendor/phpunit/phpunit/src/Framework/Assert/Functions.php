<?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Constraint\ArrayHasKey;
use PHPUnit\Framework\Constraint\Attribute;
use PHPUnit\Framework\Constraint\Callback;
use PHPUnit\Framework\Constraint\ClassHasAttribute;
use PHPUnit\Framework\Constraint\ClassHasStaticAttribute;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\Count;
use PHPUnit\Framework\Constraint\DirectoryExists;
use PHPUnit\Framework\Constraint\FileExists;
use PHPUnit\Framework\Constraint\GreaterThan;
use PHPUnit\Framework\Constraint\IsAnything;
use PHPUnit\Framework\Constraint\IsEmpty;
use PHPUnit\Framework\Constraint\IsEqual;
use PHPUnit\Framework\Constraint\IsFalse;
use PHPUnit\Framework\Constraint\IsFinite;
use PHPUnit\Framework\Constraint\IsIdentical;
use PHPUnit\Framework\Constraint\IsInfinite;
use PHPUnit\Framework\Constraint\IsInstanceOf;
use PHPUnit\Framework\Constraint\IsJson;
use PHPUnit\Framework\Constraint\IsNan;
use PHPUnit\Framework\Constraint\IsNull;
use PHPUnit\Framework\Constraint\IsReadable;
use PHPUnit\Framework\Constraint\IsTrue;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\Constraint\IsWritable;
use PHPUnit\Framework\Constraint\LessThan;
use PHPUnit\Framework\Constraint\LogicalAnd;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\Constraint\LogicalOr;
use PHPUnit\Framework\Constraint\LogicalXor;
use PHPUnit\Framework\Constraint\ObjectHasAttribute;
use PHPUnit\Framework\Constraint\RegularExpression;
use PHPUnit\Framework\Constraint\StringContains;
use PHPUnit\Framework\Constraint\StringEndsWith;
use PHPUnit\Framework\Constraint\StringMatchesFormatDescription;
use PHPUnit\Framework\Constraint\StringStartsWith;
use PHPUnit\Framework\Constraint\TraversableContains;
use PHPUnit\Framework\Constraint\TraversableContainsOnly;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\MockObject\Matcher\AnyInvokedCount as AnyInvokedCountMatcher;
use PHPUnit\Framework\MockObject\Matcher\InvokedAtIndex as InvokedAtIndexMatcher;
use PHPUnit\Framework\MockObject\Matcher\InvokedAtLeastCount as InvokedAtLeastCountMatcher;
use PHPUnit\Framework\MockObject\Matcher\InvokedAtLeastOnce as InvokedAtLeastOnceMatcher;
use PHPUnit\Framework\MockObject\Matcher\InvokedAtMostCount as InvokedAtMostCountMatcher;
use PHPUnit\Framework\MockObject\Matcher\InvokedCount as InvokedCountMatcher;
use PHPUnit\Framework\MockObject\Stub\ConsecutiveCalls as ConsecutiveCallsStub;
use PHPUnit\Framework\MockObject\Stub\Exception as ExceptionStub;
use PHPUnit\Framework\MockObject\Stub\ReturnArgument as ReturnArgumentStub;
use PHPUnit\Framework\MockObject\Stub\ReturnCallback as ReturnCallbackStub;
use PHPUnit\Framework\MockObject\Stub\ReturnSelf as ReturnSelfStub;
use PHPUnit\Framework\MockObject\Stub\ReturnStub;
use PHPUnit\Framework\MockObject\Stub\ReturnValueMap as ReturnValueMapStub;

/**
 * Asserts that an array has a specified key.
 *
 * @param int|string        $key
 * @param array|ArrayAccess $array
 * @param string            $message
 *
 * @throws Exception
 */
function assertArrayHasKey($key, $array, string $message = ''): void
{
    Assert::assertArrayHasKey(...\func_get_args());
}

/**
 * Asserts that an array has a specified subset.
 *
 * @param array|ArrayAccess $subset
 * @param array|ArrayAccess $array
 * @param bool              $strict  Check for object identity
 * @param string            $message
 *
 * @throws Exception
 */
function assertArraySubset($subset, $array, bool $strict = false, string $message = ''): void
{
    Assert::assertArraySubset(...\func_get_args());
}

/**
 * Asserts that an array does not have a specified key.
 *
 * @param int|string        $key
 * @param array|ArrayAccess $array
 * @param string            $message
 *
 * @throws Exception
 */
function assertArrayNotHasKey($key, $array, string $message = ''): void
{
    Assert::assertArrayNotHasKey(...\func_get_args());
}

/**
 * Asserts that a haystack contains a needle.
 *
 * @param mixed  $needle
 * @param mixed  $haystack
 * @param string $message
 * @param bool   $ignoreCase
 * @param bool   $checkForObjectIdentity
 * @param bool   $checkForNonObjectIdentity
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \PHPUnit\Framework\Exception
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertContains($needle, $haystack, string $message = '', bool $ignoreCase = false, bool $checkForObjectIdentity = true, bool $checkForNonObjectIdentity = false): void
{
    Assert::assertContains(...\func_get_args());
}

/**
 * Asserts that a haystack that is stored in a static attribute of a class
 * or an attribute of an object contains a needle.
 *
 * @param mixed         $needle
 * @param string        $haystackAttributeName
 * @param object|string $haystackClassOrObject
 * @param string        $message
 * @param bool          $ignoreCase
 * @param bool          $checkForObjectIdentity
 * @param bool          $checkForNonObjectIdentity
 *
 * @throws Exception
 */
function assertAttributeContains($needle, string $haystackAttributeName, $haystackClassOrObject, string $message = '', bool $ignoreCase = false, bool $checkForObjectIdentity = true, bool $checkForNonObjectIdentity = false): void
{
    Assert::assertAttributeContains(...\func_get_args());
}

/**
 * Asserts that a haystack does not contain a needle.
 *
 * @param mixed  $needle
 * @param mixed  $haystack
 * @param string $message
 * @param bool   $ignoreCase
 * @param bool   $checkForObjectIdentity
 * @param bool   $checkForNonObjectIdentity
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \PHPUnit\Framework\Exception
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotContains($needle, $haystack, string $message = '', bool $ignoreCase = false, bool $checkForObjectIdentity = true, bool $checkForNonObjectIdentity = false): void
{
    Assert::assertNotContains(...\func_get_args());
}

/**
 * Asserts that a haystack that is stored in a static attribute of a class
 * or an attribute of an object does not contain a needle.
 *
 * @param mixed         $needle
 * @param string        $haystackAttributeName
 * @param object|string $haystackClassOrObject
 * @param string        $message
 * @param bool          $ignoreCase
 * @param bool          $checkForObjectIdentity
 * @param bool          $checkForNonObjectIdentity
 *
 * @throws Exception
 */
function assertAttributeNotContains($needle, string $haystackAttributeName, $haystackClassOrObject, string $message = '', bool $ignoreCase = false, bool $checkForObjectIdentity = true, bool $checkForNonObjectIdentity = false): void
{
    Assert::assertAttributeNotContains(...\func_get_args());
}

/**
 * Asserts that a haystack contains only values of a given type.
 *
 * @param string    $type
 * @param iterable  $haystack
 * @param null|bool $isNativeType
 * @param string    $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertContainsOnly(string $type, iterable $haystack, ?bool $isNativeType = null, string $message = ''): void
{
    Assert::assertContainsOnly(...\func_get_args());
}

/**
 * Asserts that a haystack contains only instances of a given class name.
 *
 * @param string   $className
 * @param iterable $haystack
 * @param string   $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertContainsOnlyInstancesOf(string $className, iterable $haystack, string $message = ''): void
{
    Assert::assertContainsOnlyInstancesOf(...\func_get_args());
}

/**
 * Asserts that a haystack that is stored in a static attribute of a class
 * or an attribute of an object contains only values of a given type.
 *
 * @param string        $type
 * @param string        $haystackAttributeName
 * @param object|string $haystackClassOrObject
 * @param bool          $isNativeType
 * @param string        $message
 *
 * @throws Exception
 */
function assertAttributeContainsOnly(string $type, string $haystackAttributeName, $haystackClassOrObject, ?bool $isNativeType = null, string $message = ''): void
{
    Assert::assertAttributeContainsOnly(...\func_get_args());
}

/**
 * Asserts that a haystack does not contain only values of a given type.
 *
 * @param string    $type
 * @param iterable  $haystack
 * @param null|bool $isNativeType
 * @param string    $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotContainsOnly(string $type, iterable $haystack, ?bool $isNativeType = null, string $message = ''): void
{
    Assert::assertNotContainsOnly(...\func_get_args());
}

/**
 * Asserts that a haystack that is stored in a static attribute of a class
 * or an attribute of an object does not contain only values of a given
 * type.
 *
 * @param string        $type
 * @param string        $haystackAttributeName
 * @param object|string $haystackClassOrObject
 * @param bool          $isNativeType
 * @param string        $message
 *
 * @throws Exception
 */
function assertAttributeNotContainsOnly(string $type, string $haystackAttributeName, $haystackClassOrObject, ?bool $isNativeType = null, string $message = ''): void
{
    Assert::assertAttributeNotContainsOnly(...\func_get_args());
}

/**
 * Asserts the number of elements of an array, Countable or Traversable.
 *
 * @param int                $expectedCount
 * @param Countable|iterable $haystack
 * @param string             $message
 *
 * @throws Exception
 */
function assertCount(int $expectedCount, $haystack, string $message = ''): void
{
    Assert::assertCount(...\func_get_args());
}

/**
 * Asserts the number of elements of an array, Countable or Traversable
 * that is stored in an attribute.
 *
 * @param int           $expectedCount
 * @param string        $haystackAttributeName
 * @param object|string $haystackClassOrObject
 * @param string        $message
 *
 * @throws Exception
 */
function assertAttributeCount(int $expectedCount, string $haystackAttributeName, $haystackClassOrObject, string $message = ''): void
{
    Assert::assertAttributeCount(...\func_get_args());
}

/**
 * Asserts the number of elements of an array, Countable or Traversable.
 *
 * @param int                $expectedCount
 * @param Countable|iterable $haystack
 * @param string             $message
 *
 * @throws Exception
 */
function assertNotCount(int $expectedCount, $haystack, string $message = ''): void
{
    Assert::assertNotCount(...\func_get_args());
}

/**
 * Asserts the number of elements of an array, Countable or Traversable
 * that is stored in an attribute.
 *
 * @param int           $expectedCount
 * @param string        $haystackAttributeName
 * @param object|string $haystackClassOrObject
 * @param string        $message
 *
 * @throws Exception
 */
function assertAttributeNotCount(int $expectedCount, string $haystackAttributeName, $haystackClassOrObject, string $message = ''): void
{
    Assert::assertAttributeNotCount(...\func_get_args());
}

/**
 * Asserts that two variables are equal.
 *
 * @param mixed  $expected
 * @param mixed  $actual
 * @param string $message
 * @param float  $delta
 * @param int    $maxDepth
 * @param bool   $canonicalize
 * @param bool   $ignoreCase
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertEquals($expected, $actual, string $message = '', float $delta = 0.0, int $maxDepth = 10, bool $canonicalize = false, bool $ignoreCase = false): void
{
    Assert::assertEquals(...\func_get_args());
}

/**
 * Asserts that a variable is equal to an attribute of an object.
 *
 * @param mixed         $expected
 * @param string        $actualAttributeName
 * @param object|string $actualClassOrObject
 * @param string        $message
 * @param float         $delta
 * @param int           $maxDepth
 * @param bool          $canonicalize
 * @param bool          $ignoreCase
 *
 * @throws Exception
 */
function assertAttributeEquals($expected, string $actualAttributeName, $actualClassOrObject, string $message = '', float $delta = 0.0, int $maxDepth = 10, bool $canonicalize = false, bool $ignoreCase = false): void
{
    Assert::assertAttributeEquals(...\func_get_args());
}

/**
 * Asserts that two variables are not equal.
 *
 * @param mixed  $expected
 * @param mixed  $actual
 * @param string $message
 * @param float  $delta
 * @param int    $maxDepth
 * @param bool   $canonicalize
 * @param bool   $ignoreCase
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotEquals($expected, $actual, string $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false): void
{
    Assert::assertNotEquals(...\func_get_args());
}

/**
 * Asserts that a variable is not equal to an attribute of an object.
 *
 * @param mixed         $expected
 * @param string        $actualAttributeName
 * @param object|string $actualClassOrObject
 * @param string        $message
 * @param float         $delta
 * @param int           $maxDepth
 * @param bool          $canonicalize
 * @param bool          $ignoreCase
 *
 * @throws Exception
 */
function assertAttributeNotEquals($expected, string $actualAttributeName, $actualClassOrObject, string $message = '', float $delta = 0.0, int $maxDepth = 10, bool $canonicalize = false, bool $ignoreCase = false): void
{
    Assert::assertAttributeNotEquals(...\func_get_args());
}

/**
 * Asserts that a variable is empty.
 *
 * @param mixed  $actual
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertEmpty($actual, string $message = ''): void
{
    Assert::assertEmpty(...\func_get_args());
}

/**
 * Asserts that a static attribute of a class or an attribute of an object
 * is empty.
 *
 * @param string        $haystackAttributeName
 * @param object|string $haystackClassOrObject
 * @param string        $message
 *
 * @throws Exception
 */
function assertAttributeEmpty(string $haystackAttributeName, $haystackClassOrObject, string $message = ''): void
{
    Assert::assertAttributeEmpty(...\func_get_args());
}

/**
 * Asserts that a variable is not empty.
 *
 * @param mixed  $actual
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotEmpty($actual, string $message = ''): void
{
    Assert::assertNotEmpty(...\func_get_args());
}

/**
 * Asserts that a static attribute of a class or an attribute of an object
 * is not empty.
 *
 * @param string        $haystackAttributeName
 * @param object|string $haystackClassOrObject
 * @param string        $message
 *
 * @throws Exception
 */
function assertAttributeNotEmpty(string $haystackAttributeName, $haystackClassOrObject, string $message = ''): void
{
    Assert::assertAttributeNotEmpty(...\func_get_args());
}

/**
 * Asserts that a value is greater than another value.
 *
 * @param mixed  $expected
 * @param mixed  $actual
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertGreaterThan($expected, $actual, string $message = ''): void
{
    Assert::assertGreaterThan(...\func_get_args());
}

/**
 * Asserts that an attribute is greater than another value.
 *
 * @param mixed         $expected
 * @param string        $actualAttributeName
 * @param object|string $actualClassOrObject
 * @param string        $message
 *
 * @throws Exception
 */
function assertAttributeGreaterThan($expected, string $actualAttributeName, $actualClassOrObject, string $message = ''): void
{
    Assert::assertAttributeGreaterThan(...\func_get_args());
}

/**
 * Asserts that a value is greater than or equal to another value.
 *
 * @param mixed  $expected
 * @param mixed  $actual
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertGreaterThanOrEqual($expected, $actual, string $message = ''): void
{
    Assert::assertGreaterThanOrEqual(...\func_get_args());
}

/**
 * Asserts that an attribute is greater than or equal to another value.
 *
 * @param mixed         $expected
 * @param string        $actualAttributeName
 * @param object|string $actualClassOrObject
 * @param string        $message
 *
 * @throws Exception
 */
function assertAttributeGreaterThanOrEqual($expected, string $actualAttributeName, $actualClassOrObject, string $message = ''): void
{
    Assert::assertAttributeGreaterThanOrEqual(...\func_get_args());
}

/**
 * Asserts that a value is smaller than another value.
 *
 * @param mixed  $expected
 * @param mixed  $actual
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertLessThan($expected, $actual, string $message = ''): void
{
    Assert::assertLessThan(...\func_get_args());
}

/**
 * Asserts that an attribute is smaller than another value.
 *
 * @param mixed         $expected
 * @param string        $actualAttributeName
 * @param object|string $actualClassOrObject
 * @param string        $message
 *
 * @throws Exception
 */
function assertAttributeLessThan($expected, string $actualAttributeName, $actualClassOrObject, string $message = ''): void
{
    Assert::assertAttributeLessThan(...\func_get_args());
}

/**
 * Asserts that a value is smaller than or equal to another value.
 *
 * @param mixed  $expected
 * @param mixed  $actual
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertLessThanOrEqual($expected, $actual, string $message = ''): void
{
    Assert::assertLessThanOrEqual(...\func_get_args());
}

/**
 * Asserts that an attribute is smaller than or equal to another value.
 *
 * @param mixed         $expected
 * @param string        $actualAttributeName
 * @param object|string $actualClassOrObject
 * @param string        $message
 *
 * @throws Exception
 */
function assertAttributeLessThanOrEqual($expected, string $actualAttributeName, $actualClassOrObject, string $message = ''): void
{
    Assert::assertAttributeLessThanOrEqual(...\func_get_args());
}

/**
 * Asserts that the contents of one file is equal to the contents of another
 * file.
 *
 * @param string $expected
 * @param string $actual
 * @param string $message
 * @param bool   $canonicalize
 * @param bool   $ignoreCase
 *
 * @throws Exception
 */
function assertFileEquals(string $expected, string $actual, string $message = '', bool $canonicalize = false, bool $ignoreCase = false): void
{
    Assert::assertFileEquals(...\func_get_args());
}

/**
 * Asserts that the contents of one file is not equal to the contents of
 * another file.
 *
 * @param string $expected
 * @param string $actual
 * @param string $message
 * @param bool   $canonicalize
 * @param bool   $ignoreCase
 *
 * @throws Exception
 */
function assertFileNotEquals(string $expected, string $actual, string $message = '', bool $canonicalize = false, bool $ignoreCase = false): void
{
    Assert::assertFileNotEquals(...\func_get_args());
}

/**
 * Asserts that the contents of a string is equal
 * to the contents of a file.
 *
 * @param string $expectedFile
 * @param string $actualString
 * @param string $message
 * @param bool   $canonicalize
 * @param bool   $ignoreCase
 *
 * @throws Exception
 */
function assertStringEqualsFile(string $expectedFile, string $actualString, string $message = '', bool $canonicalize = false, bool $ignoreCase = false): void
{
    Assert::assertStringEqualsFile(...\func_get_args());
}

/**
 * Asserts that the contents of a string is not equal
 * to the contents of a file.
 *
 * @param string $expectedFile
 * @param string $actualString
 * @param string $message
 * @param bool   $canonicalize
 * @param bool   $ignoreCase
 *
 * @throws Exception
 */
function assertStringNotEqualsFile(string $expectedFile, string $actualString, string $message = '', bool $canonicalize = false, bool $ignoreCase = false): void
{
    Assert::assertStringNotEqualsFile(...\func_get_args());
}

/**
 * Asserts that a file/dir is readable.
 *
 * @param string $filename
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertIsReadable(string $filename, string $message = ''): void
{
    Assert::assertIsReadable(...\func_get_args());
}

/**
 * Asserts that a file/dir exists and is not readable.
 *
 * @param string $filename
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotIsReadable(string $filename, string $message = ''): void
{
    Assert::assertNotIsReadable(...\func_get_args());
}

/**
 * Asserts that a file/dir exists and is writable.
 *
 * @param string $filename
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertIsWritable(string $filename, string $message = ''): void
{
    Assert::assertIsWritable(...\func_get_args());
}

/**
 * Asserts that a file/dir exists and is not writable.
 *
 * @param string $filename
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotIsWritable(string $filename, string $message = ''): void
{
    Assert::assertNotIsWritable(...\func_get_args());
}

/**
 * Asserts that a directory exists.
 *
 * @param string $directory
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertDirectoryExists(string $directory, string $message = ''): void
{
    Assert::assertDirectoryExists(...\func_get_args());
}

/**
 * Asserts that a directory does not exist.
 *
 * @param string $directory
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertDirectoryNotExists(string $directory, string $message = ''): void
{
    Assert::assertDirectoryNotExists(...\func_get_args());
}

/**
 * Asserts that a directory exists and is readable.
 *
 * @param string $directory
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertDirectoryIsReadable(string $directory, string $message = ''): void
{
    Assert::assertDirectoryIsReadable(...\func_get_args());
}

/**
 * Asserts that a directory exists and is not readable.
 *
 * @param string $directory
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertDirectoryNotIsReadable(string $directory, string $message = ''): void
{
    Assert::assertDirectoryNotIsReadable(...\func_get_args());
}

/**
 * Asserts that a directory exists and is writable.
 *
 * @param string $directory
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertDirectoryIsWritable(string $directory, string $message = ''): void
{
    Assert::assertDirectoryIsWritable(...\func_get_args());
}

/**
 * Asserts that a directory exists and is not writable.
 *
 * @param string $directory
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertDirectoryNotIsWritable(string $directory, string $message = ''): void
{
    Assert::assertDirectoryNotIsWritable(...\func_get_args());
}

/**
 * Asserts that a file exists.
 *
 * @param string $filename
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertFileExists(string $filename, string $message = ''): void
{
    Assert::assertFileExists(...\func_get_args());
}

/**
 * Asserts that a file does not exist.
 *
 * @param string $filename
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertFileNotExists(string $filename, string $message = ''): void
{
    Assert::assertFileNotExists(...\func_get_args());
}

/**
 * Asserts that a file exists and is readable.
 *
 * @param string $file
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertFileIsReadable(string $file, string $message = ''): void
{
    Assert::assertFileIsReadable(...\func_get_args());
}

/**
 * Asserts that a file exists and is not readable.
 *
 * @param string $file
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertFileNotIsReadable(string $file, string $message = ''): void
{
    Assert::assertFileNotIsReadable(...\func_get_args());
}

/**
 * Asserts that a file exists and is writable.
 *
 * @param string $file
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertFileIsWritable(string $file, string $message = ''): void
{
    Assert::assertFileIsWritable(...\func_get_args());
}

/**
 * Asserts that a file exists and is not writable.
 *
 * @param string $file
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertFileNotIsWritable(string $file, string $message = ''): void
{
    Assert::assertFileNotIsWritable(...\func_get_args());
}

/**
 * Asserts that a condition is true.
 *
 * @param mixed  $condition
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertTrue($condition, string $message = ''): void
{
    Assert::assertTrue(...\func_get_args());
}

/**
 * Asserts that a condition is not true.
 *
 * @param mixed  $condition
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotTrue($condition, string $message = ''): void
{
    Assert::assertNotTrue(...\func_get_args());
}

/**
 * Asserts that a condition is false.
 *
 * @param mixed  $condition
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertFalse($condition, string $message = ''): void
{
    Assert::assertFalse(...\func_get_args());
}

/**
 * Asserts that a condition is not false.
 *
 * @param mixed  $condition
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotFalse($condition, string $message = ''): void
{
    Assert::assertNotFalse(...\func_get_args());
}

/**
 * Asserts that a variable is null.
 *
 * @param mixed  $actual
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNull($actual, string $message = ''): void
{
    Assert::assertNull(...\func_get_args());
}

/**
 * Asserts that a variable is not null.
 *
 * @param mixed  $actual
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotNull($actual, string $message = ''): void
{
    Assert::assertNotNull(...\func_get_args());
}

/**
 * Asserts that a variable is finite.
 *
 * @param mixed  $actual
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertFinite($actual, string $message = ''): void
{
    Assert::assertFinite(...\func_get_args());
}

/**
 * Asserts that a variable is infinite.
 *
 * @param mixed  $actual
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertInfinite($actual, string $message = ''): void
{
    Assert::assertInfinite(...\func_get_args());
}

/**
 * Asserts that a variable is nan.
 *
 * @param mixed  $actual
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNan($actual, string $message = ''): void
{
    Assert::assertNan(...\func_get_args());
}

/**
 * Asserts that a class has a specified attribute.
 *
 * @param string $attributeName
 * @param string $className
 * @param string $message
 *
 * @throws Exception
 */
function assertClassHasAttribute(string $attributeName, string $className, string $message = ''): void
{
    Assert::assertClassHasAttribute(...\func_get_args());
}

/**
 * Asserts that a class does not have a specified attribute.
 *
 * @param string $attributeName
 * @param string $className
 * @param string $message
 *
 * @throws Exception
 */
function assertClassNotHasAttribute(string $attributeName, string $className, string $message = ''): void
{
    Assert::assertClassNotHasAttribute(...\func_get_args());
}

/**
 * Asserts that a class has a specified static attribute.
 *
 * @param string $attributeName
 * @param string $className
 * @param string $message
 *
 * @throws Exception
 */
function assertClassHasStaticAttribute(string $attributeName, string $className, string $message = ''): void
{
    Assert::assertClassHasStaticAttribute(...\func_get_args());
}

/**
 * Asserts that a class does not have a specified static attribute.
 *
 * @param string $attributeName
 * @param string $className
 * @param string $message
 *
 * @throws Exception
 */
function assertClassNotHasStaticAttribute(string $attributeName, string $className, string $message = ''): void
{
    Assert::assertClassNotHasStaticAttribute(...\func_get_args());
}

/**
 * Asserts that an object has a specified attribute.
 *
 * @param string $attributeName
 * @param object $object
 * @param string $message
 *
 * @throws Exception
 */
function assertObjectHasAttribute(string $attributeName, $object, string $message = ''): void
{
    Assert::assertObjectHasAttribute(...\func_get_args());
}

/**
 * Asserts that an object does not have a specified attribute.
 *
 * @param string $attributeName
 * @param object $object
 * @param string $message
 *
 * @throws Exception
 */
function assertObjectNotHasAttribute(string $attributeName, $object, string $message = ''): void
{
    Assert::assertObjectNotHasAttribute(...\func_get_args());
}

/**
 * Asserts that two variables have the same type and value.
 * Used on objects, it asserts that two variables reference
 * the same object.
 *
 * @param mixed  $expected
 * @param mixed  $actual
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertSame($expected, $actual, string $message = ''): void
{
    Assert::assertSame(...\func_get_args());
}

/**
 * Asserts that a variable and an attribute of an object have the same type
 * and value.
 *
 * @param mixed         $expected
 * @param string        $actualAttributeName
 * @param object|string $actualClassOrObject
 * @param string        $message
 *
 * @throws Exception
 */
function assertAttributeSame($expected, string $actualAttributeName, $actualClassOrObject, string $message = ''): void
{
    Assert::assertAttributeSame(...\func_get_args());
}

/**
 * Asserts that two variables do not have the same type and value.
 * Used on objects, it asserts that two variables do not reference
 * the same object.
 *
 * @param mixed  $expected
 * @param mixed  $actual
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotSame($expected, $actual, string $message = ''): void
{
    Assert::assertNotSame(...\func_get_args());
}

/**
 * Asserts that a variable and an attribute of an object do not have the
 * same type and value.
 *
 * @param mixed         $expected
 * @param string        $actualAttributeName
 * @param object|string $actualClassOrObject
 * @param string        $message
 *
 * @throws Exception
 */
function assertAttributeNotSame($expected, string $actualAttributeName, $actualClassOrObject, string $message = ''): void
{
    Assert::assertAttributeNotSame(...\func_get_args());
}

/**
 * Asserts that a variable is of a given type.
 *
 * @param string $expected
 * @param mixed  $actual
 * @param string $message
 *
 * @throws Exception
 */
function assertInstanceOf(string $expected, $actual, string $message = ''): void
{
    Assert::assertInstanceOf(...\func_get_args());
}

/**
 * Asserts that an attribute is of a given type.
 *
 * @param string        $expected
 * @param string        $attributeName
 * @param object|string $classOrObject
 * @param string        $message
 *
 * @throws Exception
 */
function assertAttributeInstanceOf(string $expected, string $attributeName, $classOrObject, string $message = ''): void
{
    Assert::assertAttributeInstanceOf(...\func_get_args());
}

/**
 * Asserts that a variable is not of a given type.
 *
 * @param string $expected
 * @param mixed  $actual
 * @param string $message
 *
 * @throws Exception
 */
function assertNotInstanceOf(string $expected, $actual, string $message = ''): void
{
    Assert::assertNotInstanceOf(...\func_get_args());
}

/**
 * Asserts that an attribute is of a given type.
 *
 * @param string        $expected
 * @param string        $attributeName
 * @param object|string $classOrObject
 * @param string        $message
 *
 * @throws Exception
 */
function assertAttributeNotInstanceOf(string $expected, string $attributeName, $classOrObject, string $message = ''): void
{
    Assert::assertAttributeNotInstanceOf(...\func_get_args());
}

/**
 * Asserts that a variable is of a given type.
 *
 * @param string $expected
 * @param mixed  $actual
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertInternalType(string $expected, $actual, string $message = ''): void
{
    Assert::assertInternalType(...\func_get_args());
}

/**
 * Asserts that an attribute is of a given type.
 *
 * @param string        $expected
 * @param string        $attributeName
 * @param object|string $classOrObject
 * @param string        $message
 *
 * @throws Exception
 */
function assertAttributeInternalType(string $expected, string $attributeName, $classOrObject, string $message = ''): void
{
    Assert::assertAttributeInternalType(...\func_get_args());
}

/**
 * Asserts that a variable is not of a given type.
 *
 * @param string $expected
 * @param mixed  $actual
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotInternalType(string $expected, $actual, string $message = ''): void
{
    Assert::assertNotInternalType(...\func_get_args());
}

/**
 * Asserts that an attribute is of a given type.
 *
 * @param string        $expected
 * @param string        $attributeName
 * @param object|string $classOrObject
 * @param string        $message
 *
 * @throws Exception
 */
function assertAttributeNotInternalType(string $expected, string $attributeName, $classOrObject, string $message = ''): void
{
    Assert::assertAttributeNotInternalType(...\func_get_args());
}

/**
 * Asserts that a string matches a given regular expression.
 *
 * @param string $pattern
 * @param string $string
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertRegExp(string $pattern, string $string, string $message = ''): void
{
    Assert::assertRegExp(...\func_get_args());
}

/**
 * Asserts that a string does not match a given regular expression.
 *
 * @param string $pattern
 * @param string $string
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotRegExp(string $pattern, string $string, string $message = ''): void
{
    Assert::assertNotRegExp(...\func_get_args());
}

/**
 * Assert that the size of two arrays (or `Countable` or `Traversable` objects)
 * is the same.
 *
 * @param Countable|iterable $expected
 * @param Countable|iterable $actual
 * @param string             $message
 *
 * @throws Exception
 */
function assertSameSize($expected, $actual, string $message = ''): void
{
    Assert::assertSameSize(...\func_get_args());
}

/**
 * Assert that the size of two arrays (or `Countable` or `Traversable` objects)
 * is not the same.
 *
 * @param Countable|iterable $expected
 * @param Countable|iterable $actual
 * @param string             $message
 *
 * @throws Exception
 */
function assertNotSameSize($expected, $actual, string $message = ''): void
{
    Assert::assertNotSameSize(...\func_get_args());
}

/**
 * Asserts that a string matches a given format string.
 *
 * @param string $format
 * @param string $string
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertStringMatchesFormat(string $format, string $string, string $message = ''): void
{
    Assert::assertStringMatchesFormat(...\func_get_args());
}

/**
 * Asserts that a string does not match a given format string.
 *
 * @param string $format
 * @param string $string
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertStringNotMatchesFormat(string $format, string $string, string $message = ''): void
{
    Assert::assertStringNotMatchesFormat(...\func_get_args());
}

/**
 * Asserts that a string matches a given format file.
 *
 * @param string $formatFile
 * @param string $string
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertStringMatchesFormatFile(string $formatFile, string $string, string $message = ''): void
{
    Assert::assertStringMatchesFormatFile(...\func_get_args());
}

/**
 * Asserts that a string does not match a given format string.
 *
 * @param string $formatFile
 * @param string $string
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertStringNotMatchesFormatFile(string $formatFile, string $string, string $message = ''): void
{
    Assert::assertStringNotMatchesFormatFile(...\func_get_args());
}

/**
 * Asserts that a string starts with a given prefix.
 *
 * @param string $prefix
 * @param string $string
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertStringStartsWith(string $prefix, string $string, string $message = ''): void
{
    Assert::assertStringStartsWith(...\func_get_args());
}

/**
 * Asserts that a string starts not with a given prefix.
 *
 * @param string $prefix
 * @param string $string
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertStringStartsNotWith($prefix, $string, string $message = ''): void
{
    Assert::assertStringStartsNotWith(...\func_get_args());
}

/**
 * Asserts that a string ends with a given suffix.
 *
 * @param string $suffix
 * @param string $string
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertStringEndsWith(string $suffix, string $string, string $message = ''): void
{
    Assert::assertStringEndsWith(...\func_get_args());
}

/**
 * Asserts that a string ends not with a given suffix.
 *
 * @param string $suffix
 * @param string $string
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertStringEndsNotWith(string $suffix, string $string, string $message = ''): void
{
    Assert::assertStringEndsNotWith(...\func_get_args());
}

/**
 * Asserts that two XML files are equal.
 *
 * @param string $expectedFile
 * @param string $actualFile
 * @param string $message
 *
 * @throws Exception
 */
function assertXmlFileEqualsXmlFile(string $expectedFile, string $actualFile, string $message = ''): void
{
    Assert::assertXmlFileEqualsXmlFile(...\func_get_args());
}

/**
 * Asserts that two XML files are not equal.
 *
 * @param string $expectedFile
 * @param string $actualFile
 * @param string $message
 *
 * @throws Exception
 */
function assertXmlFileNotEqualsXmlFile(string $expectedFile, string $actualFile, string $message = ''): void
{
    Assert::assertXmlFileNotEqualsXmlFile(...\func_get_args());
}

/**
 * Asserts that two XML documents are equal.
 *
 * @param string             $expectedFile
 * @param DOMDocument|string $actualXml
 * @param string             $message
 *
 * @throws Exception
 */
function assertXmlStringEqualsXmlFile(string $expectedFile, $actualXml, string $message = ''): void
{
    Assert::assertXmlStringEqualsXmlFile(...\func_get_args());
}

/**
 * Asserts that two XML documents are not equal.
 *
 * @param string             $expectedFile
 * @param DOMDocument|string $actualXml
 * @param string             $message
 *
 * @throws Exception
 */
function assertXmlStringNotEqualsXmlFile(string $expectedFile, $actualXml, string $message = ''): void
{
    Assert::assertXmlStringNotEqualsXmlFile(...\func_get_args());
}

/**
 * Asserts that two XML documents are equal.
 *
 * @param DOMDocument|string $expectedXml
 * @param DOMDocument|string $actualXml
 * @param string             $message
 *
 * @throws Exception
 */
function assertXmlStringEqualsXmlString($expectedXml, $actualXml, string $message = ''): void
{
    Assert::assertXmlStringEqualsXmlString(...\func_get_args());
}

/**
 * Asserts that two XML documents are not equal.
 *
 * @param DOMDocument|string $expectedXml
 * @param DOMDocument|string $actualXml
 * @param string             $message
 *
 * @throws Exception
 */
function assertXmlStringNotEqualsXmlString($expectedXml, $actualXml, string $message = ''): void
{
    Assert::assertXmlStringNotEqualsXmlString(...\func_get_args());
}

/**
 * Asserts that a hierarchy of DOMElements matches.
 *
 * @param DOMElement $expectedElement
 * @param DOMElement $actualElement
 * @param bool       $checkAttributes
 * @param string     $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \PHPUnit\Framework\AssertionFailedError
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertEqualXMLStructure(DOMElement $expectedElement, DOMElement $actualElement, bool $checkAttributes = false, string $message = ''): void
{
    Assert::assertEqualXMLStructure(...\func_get_args());
}

/**
 * Evaluates a PHPUnit\Framework\Constraint matcher object.
 *
 * @param mixed      $value
 * @param Constraint $constraint
 * @param string     $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertThat($value, Constraint $constraint, string $message = ''): void
{
    Assert::assertThat(...\func_get_args());
}

/**
 * Asserts that a string is a valid JSON string.
 *
 * @param string $actualJson
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertJson(string $actualJson, string $message = ''): void
{
    Assert::assertJson(...\func_get_args());
}

/**
 * Asserts that two given JSON encoded objects or arrays are equal.
 *
 * @param string $expectedJson
 * @param string $actualJson
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertJsonStringEqualsJsonString(string $expectedJson, string $actualJson, string $message = ''): void
{
    Assert::assertJsonStringEqualsJsonString(...\func_get_args());
}

/**
 * Asserts that two given JSON encoded objects or arrays are not equal.
 *
 * @param string $expectedJson
 * @param string $actualJson
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertJsonStringNotEqualsJsonString($expectedJson, $actualJson, string $message = ''): void
{
    Assert::assertJsonStringNotEqualsJsonString(...\func_get_args());
}

/**
 * Asserts that the generated JSON encoded object and the content of the given file are equal.
 *
 * @param string $expectedFile
 * @param string $actualJson
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertJsonStringEqualsJsonFile(string $expectedFile, string $actualJson, string $message = ''): void
{
    Assert::assertJsonStringEqualsJsonFile(...\func_get_args());
}

/**
 * Asserts that the generated JSON encoded object and the content of the given file are not equal.
 *
 * @param string $expectedFile
 * @param string $actualJson
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertJsonStringNotEqualsJsonFile(string $expectedFile, string $actualJson, string $message = ''): void
{
    Assert::assertJsonStringNotEqualsJsonFile(...\func_get_args());
}

/**
 * Asserts that two JSON files are equal.
 *
 * @param string $expectedFile
 * @param string $actualFile
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertJsonFileEqualsJsonFile(string $expectedFile, string $actualFile, string $message = ''): void
{
    Assert::assertJsonFileEqualsJsonFile(...\func_get_args());
}

/**
 * Asserts that two JSON files are not equal.
 *
 * @param string $expectedFile
 * @param string $actualFile
 * @param string $message
 *
 * @throws Exception
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertJsonFileNotEqualsJsonFile(string $expectedFile, string $actualFile, string $message = ''): void
{
    Assert::assertJsonFileNotEqualsJsonFile(...\func_get_args());
}

function logicalAnd(): LogicalAnd
{
    return Assert::logicalAnd(...\func_get_args());
}

function logicalOr(): LogicalOr
{
    return Assert::logicalOr(...\func_get_args());
}

function logicalNot(Constraint $constraint): LogicalNot
{
    return Assert::logicalNot(...\func_get_args());
}

function logicalXor(): LogicalXor
{
    return Assert::logicalXor(...\func_get_args());
}

function anything(): IsAnything
{
    return Assert::anything();
}

function isTrue(): IsTrue
{
    return Assert::isTrue();
}

function callback(callable $callback): Callback
{
    return Assert::callback(...\func_get_args());
}

function isFalse(): IsFalse
{
    return Assert::isFalse();
}

function isJson(): IsJson
{
    return Assert::isJson();
}

function isNull(): IsNull
{
    return Assert::isNull();
}

function isFinite(): IsFinite
{
    return Assert::isFinite();
}

function isInfinite(): IsInfinite
{
    return Assert::isInfinite();
}

function isNan(): IsNan
{
    return Assert::isNan();
}

function attribute(Constraint $constraint, string $attributeName): Attribute
{
    return Assert::attribute(...\func_get_args());
}

function contains($value, bool $checkForObjectIdentity = true, bool $checkForNonObjectIdentity = false): TraversableContains
{
    return Assert::contains(...\func_get_args());
}

function containsOnly(string $type): TraversableContainsOnly
{
    return Assert::containsOnly(...\func_get_args());
}

function containsOnlyInstancesOf(string $className): TraversableContainsOnly
{
    return Assert::containsOnlyInstancesOf(...\func_get_args());
}

function arrayHasKey($key): ArrayHasKey
{
    return Assert::arrayHasKey(...\func_get_args());
}

function equalTo($value, float $delta = 0.0, int $maxDepth = 10, bool $canonicalize = false, bool $ignoreCase = false): IsEqual
{
    return Assert::equalTo(...\func_get_args());
}

function attributeEqualTo(string $attributeName, $value, float $delta = 0.0, int $maxDepth = 10, bool $canonicalize = false, bool $ignoreCase = false): Attribute
{
    return Assert::attributeEqualTo(...\func_get_args());
}

function isEmpty(): IsEmpty
{
    return Assert::isEmpty();
}

function isWritable(): IsWritable
{
    return Assert::isWritable();
}

function isReadable(): IsReadable
{
    return Assert::isReadable();
}

function directoryExists(): DirectoryExists
{
    return Assert::directoryExists();
}

function fileExists(): FileExists
{
    return Assert::fileExists();
}

function greaterThan($value): GreaterThan
{
    return Assert::greaterThan(...\func_get_args());
}

function greaterThanOrEqual($value): LogicalOr
{
    return Assert::greaterThanOrEqual(...\func_get_args());
}

function classHasAttribute(string $attributeName): ClassHasAttribute
{
    return Assert::classHasAttribute(...\func_get_args());
}

function classHasStaticAttribute(string $attributeName): ClassHasStaticAttribute
{
    return Assert::classHasStaticAttribute(...\func_get_args());
}

function objectHasAttribute($attributeName): ObjectHasAttribute
{
    return Assert::objectHasAttribute(...\func_get_args());
}

function identicalTo($value): IsIdentical
{
    return Assert::identicalTo(...\func_get_args());
}

function isInstanceOf(string $className): IsInstanceOf
{
    return Assert::isInstanceOf(...\func_get_args());
}

function isType(string $type): IsType
{
    return Assert::isType(...\func_get_args());
}

function lessThan($value): LessThan
{
    return Assert::lessThan(...\func_get_args());
}

function lessThanOrEqual($value): LogicalOr
{
    return Assert::lessThanOrEqual(...\func_get_args());
}

function matchesRegularExpression(string $pattern): RegularExpression
{
    return Assert::matchesRegularExpression(...\func_get_args());
}

function matches(string $string): StringMatchesFormatDescription
{
    return Assert::matches(...\func_get_args());
}

function stringStartsWith($prefix): StringStartsWith
{
    return Assert::stringStartsWith(...\func_get_args());
}

function stringContains(string $string, bool $case = true): StringContains
{
    return Assert::stringContains(...\func_get_args());
}

function stringEndsWith(string $suffix): StringEndsWith
{
    return Assert::stringEndsWith(...\func_get_args());
}

function countOf(int $count): Count
{
    return Assert::countOf(...\func_get_args());
}

/**
 * Returns a matcher that matches when the method is executed
 * zero or more times.
 *
 * @return AnyInvokedCountMatcher
 */
function any(): AnyInvokedCountMatcher
{
    return new AnyInvokedCountMatcher;
}

/**
 * Returns a matcher that matches when the method is never executed.
 *
 * @return InvokedCountMatcher
 */
function never(): InvokedCountMatcher
{
    return new InvokedCountMatcher(0);
}

/**
 * Returns a matcher that matches when the method is executed
 * at least N times.
 *
 * @param int $requiredInvocations
 *
 * @return InvokedAtLeastCountMatcher
 */
function atLeast($requiredInvocations): InvokedAtLeastCountMatcher
{
    return new InvokedAtLeastCountMatcher(
        $requiredInvocations
    );
}

/**
 * Returns a matcher that matches when the method is executed at least once.
 *
 * @return InvokedAtLeastOnceMatcher
 */
function atLeastOnce(): InvokedAtLeastOnceMatcher
{
    return new InvokedAtLeastOnceMatcher;
}

/**
 * Returns a matcher that matches when the method is executed exactly once.
 *
 * @return InvokedCountMatcher
 */
function once(): InvokedCountMatcher
{
    return new InvokedCountMatcher(1);
}

/**
 * Returns a matcher that matches when the method is executed
 * exactly $count times.
 *
 * @param int $count
 *
 * @return InvokedCountMatcher
 */
function exactly($count): InvokedCountMatcher
{
    return new InvokedCountMatcher($count);
}

/**
 * Returns a matcher that matches when the method is executed
 * at most N times.
 *
 * @param int $allowedInvocations
 *
 * @return InvokedAtMostCountMatcher
 */
function atMost($allowedInvocations): InvokedAtMostCountMatcher
{
    return new InvokedAtMostCountMatcher($allowedInvocations);
}

/**
 * Returns a matcher that matches when the method is executed
 * at the given index.
 *
 * @param int $index
 *
 * @return InvokedAtIndexMatcher
 */
function at($index): InvokedAtIndexMatcher
{
    return new InvokedAtIndexMatcher($index);
}

/**
 * @param mixed $value
 *
 * @return ReturnStub
 */
function returnValue($value): ReturnStub
{
    return new ReturnStub($value);
}

/**
 * @param array $valueMap
 *
 * @return ReturnValueMapStub
 */
function returnValueMap(array $valueMap): ReturnValueMapStub
{
    return new ReturnValueMapStub($valueMap);
}

/**
 * @param int $argumentIndex
 *
 * @return ReturnArgumentStub
 */
function returnArgument($argumentIndex): ReturnArgumentStub
{
    return new ReturnArgumentStub($argumentIndex);
}

/**
 * @param mixed $callback
 *
 * @return ReturnCallbackStub
 */
function returnCallback($callback): ReturnCallbackStub
{
    return new ReturnCallbackStub($callback);
}

/**
 * Returns the current object.
 *
 * This method is useful when mocking a fluent interface.
 *
 * @return ReturnSelfStub
 */
function returnSelf(): ReturnSelfStub
{
    return new ReturnSelfStub;
}

/**
 * @param Throwable $exception
 *
 * @return ExceptionStub
 */
function throwException(Throwable $exception): ExceptionStub
{
    return new ExceptionStub($exception);
}

/**
 * @param mixed $value , ...
 *
 * @return ConsecutiveCallsStub
 */
function onConsecutiveCalls(): ConsecutiveCallsStub
{
    $args = \func_get_args();

    return new ConsecutiveCallsStub($args);
}
