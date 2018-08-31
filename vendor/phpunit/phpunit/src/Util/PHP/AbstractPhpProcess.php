<?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPUnit\Util\PHP;

use __PHP_Incomplete_Class;
use ErrorException;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\SyntheticError;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestFailure;
use PHPUnit\Framework\TestResult;
use SebastianBergmann\Environment\Runtime;

/**
 * Utility methods for PHP sub-processes.
 */
abstract class AbstractPhpProcess
{
    /**
     * @var Runtime
     */
    protected $runtime;

    /**
     * @var bool
     */
    protected $stderrRedirection = false;

    /**
     * @var string
     */
    protected $stdin = '';

    /**
     * @var string
     */
    protected $args = '';

    /**
     * @var array<string, string>
     */
    protected $env = [];

    /**
     * @var int
     */
    protected $timeout = 0;

    /**
     * Creates internal Runtime instance.
     */
    public function __construct()
    {
        $this->runtime = new Runtime();
    }

    /**
     * Defines if should use STDERR redirection or not.
     *
     * Then $stderrRedirection is TRUE, STDERR is redirected to STDOUT.
     *
     *
     * @param bool $stderrRedirection
     */
    public function setUseStderrRedirection(bool $stderrRedirection): void
    {
        $this->stderrRedirection = $stderrRedirection;
    }

    /**
     * Returns TRUE if uses STDERR redirection or FALSE if not.
     *
     * @return bool
     */
    public function useStderrRedirection(): bool
    {
        return $this->stderrRedirection;
    }

    /**
     * Sets the input string to be sent via STDIN
     *
     * @param string $stdin
     */
    public function setStdin($stdin): void
    {
        $this->stdin = (string) $stdin;
    }

    /**
     * Returns the input string to be sent via STDIN
     *
     * @return string
     */
    public function getStdin(): string
    {
        return $this->stdin;
    }

    /**
     * Sets the string of arguments to pass to the php job
     *
     * @param string $args
     */
    public function setArgs($args): void
    {
        $this->args = (string) $args;
    }

    /**
     * Returns the string of arguments to pass to the php job
     *
     * @retrun string
     */
    public function getArgs(): string
    {
        return $this->args;
    }

    /**
     * Sets the array of environment variables to start the child process with
     *
     * @param array<string, string> $env
     */
    public function setEnv(array $env): void
    {
        $this->env = $env;
    }

    /**
     * Returns the array of environment variables to start the child process with
     *
     * @return array<string, string>
     */
    public function getEnv(): array
    {
        return $this->env;
    }

    /**
     * Sets the amount of seconds to wait before timing out
     *
     * @param int $timeout
     */
    public function setTimeout($timeout): void
    {
        $this->timeout = (int) $timeout;
    }

    /**
     * Returns the amount of seconds to wait before timing out
     *
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * @return AbstractPhpProcess
     */
    public static function factory(): self
    {
        if (DIRECTORY_SEPARATOR === '\\') {
            return new WindowsPhpProcess;
        }

        return new DefaultPhpProcess;
    }

    /**
     * Runs a single test in a separate PHP process.
     *
     * @param string     $job
     * @param Test       $test
     * @param TestResult $result
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function runTestJob($job, Test $test, TestResult $result): void
    {
        $result->startTest($test);

        $_result = $this->runJob($job);

        $this->processChildResult(
            $test,
            $result,
            $_result['stdout'],
            $_result['stderr']
        );
    }

    /**
     * Returns the command based into the configurations.
     *
     * @param array       $settings
     * @param null|string $file
     *
     * @return string
     */
    public function getCommand(array $settings, $file = null): string
    {
        $command = $this->runtime->getBinary();
        $command .= $this->settingsToParameters($settings);

        if (PHP_SAPI === 'phpdbg') {
            $command .= ' -qrr ';

            if ($file) {
                $command .= '-e ' . \escapeshellarg($file);
            } else {
                $command .= \escapeshellarg(__DIR__ . '/eval-stdin.php');
            }
        } elseif ($file) {
            $command .= ' -f ' . \escapeshellarg($file);
        }

        if ($this->args) {
            $command .= ' -- ' . $this->args;
        }

        if ($this->stderrRedirection === true) {
            $command .= ' 2>&1';
        }

        return $command;
    }

    /**
     * Runs a single job (PHP code) using a separate PHP process.
     *
     * @param string $job
     * @param array  $settings
     *
     * @return array
     */
    abstract public function runJob($job, array $settings = []): array;

    /**
     * @param array $settings
     *
     * @return string
     */
    protected function settingsToParameters(array $settings): string
    {
        $buffer = '';

        foreach ($settings as $setting) {
            $buffer .= ' -d ' . \escapeshellarg($setting);
        }

        return $buffer;
    }

    /**
     * Processes the TestResult object from an isolated process.
     *
     * @param Test       $test
     * @param TestResult $result
     * @param string     $stdout
     * @param string     $stderr
     *
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    private function processChildResult(Test $test, TestResult $result, $stdout, $stderr): void
    {
        $time = 0;

        if (!empty($stderr)) {
            $result->addError(
                $test,
                new Exception(\trim($stderr)),
                $time
            );
        } else {
            \set_error_handler(function ($errno, $errstr, $errfile, $errline): void {
                throw new ErrorException($errstr, $errno, $errno, $errfile, $errline);
            });

            try {
                if (\strpos($stdout, "#!/usr/bin/env php\n") === 0) {
                    $stdout = \substr($stdout, 19);
                }

                $childResult = \unserialize(\str_replace("#!/usr/bin/env php\n", '', $stdout));
                \restore_error_handler();
            } catch (ErrorException $e) {
                \restore_error_handler();
                $childResult = false;

                $result->addError(
                    $test,
                    new Exception(\trim($stdout), 0, $e),
                    $time
                );
            }

            if ($childResult !== false) {
                if (!empty($childResult['output'])) {
                    $output = $childResult['output'];
                }

                /* @var TestCase $test */

                $test->setResult($childResult['testResult']);
                $test->addToAssertionCount($childResult['numAssertions']);

                /** @var TestResult $childResult */
                $childResult = $childResult['result'];

                if ($result->getCollectCodeCoverageInformation()) {
                    $result->getCodeCoverage()->merge(
                        $childResult->getCodeCoverage()
                    );
                }

                $time           = $childResult->time();
                $notImplemented = $childResult->notImplemented();
                $risky          = $childResult->risky();
                $skipped        = $childResult->skipped();
                $errors         = $childResult->errors();
                $warnings       = $childResult->warnings();
                $failures       = $childResult->failures();

                if (!empty($notImplemented)) {
                    $result->addError(
                        $test,
                        $this->getException($notImplemented[0]),
                        $time
                    );
                } elseif (!empty($risky)) {
                    $result->addError(
                        $test,
                        $this->getException($risky[0]),
                        $time
                    );
                } elseif (!empty($skipped)) {
                    $result->addError(
                        $test,
                        $this->getException($skipped[0]),
                        $time
                    );
                } elseif (!empty($errors)) {
                    $result->addError(
                        $test,
                        $this->getException($errors[0]),
                        $time
                    );
                } elseif (!empty($warnings)) {
                    $result->addWarning(
                        $test,
                        $this->getException($warnings[0]),
                        $time
                    );
                } elseif (!empty($failures)) {
                    $result->addFailure(
                        $test,
                        $this->getException($failures[0]),
                        $time
                    );
                }
            }
        }

        $result->endTest($test, $time);

        if (!empty($output)) {
            print $output;
        }
    }

    /**
     * Gets the thrown exception from a PHPUnit\Framework\TestFailure.
     *
     * @param TestFailure $error
     *
     * @return Exception
     *
     * @see https://github.com/sebastianbergmann/phpunit/issues/74
     */
    private function getException(TestFailure $error): Exception
    {
        $exception = $error->thrownException();

        if ($exception instanceof __PHP_Incomplete_Class) {
            $exceptionArray = [];
            foreach ((array) $exception as $key => $value) {
                $key                  = \substr($key, \strrpos($key, "\0") + 1);
                $exceptionArray[$key] = $value;
            }

            $exception = new SyntheticError(
                \sprintf(
                    '%s: %s',
                    $exceptionArray['_PHP_Incomplete_Class_Name'],
                    $exceptionArray['message']
                ),
                $exceptionArray['code'],
                $exceptionArray['file'],
                $exceptionArray['line'],
                $exceptionArray['trace']
            );
        }

        return $exception;
    }
}
