<?php
/*
 * This file is part of PharIo\Manifest.
 *
 * (c) Arne Blankerts <arne@blankerts.de>, Sebastian Heuer <sebastian@phpeople.de>, Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PharIo\Manifest;

use LibXMLError;

class ManifestDocumentLoadingException extends \Exception implements Exception {
    /**
     * @var LibXMLError[]
     */
    private $libxmlErrors;

    /**
     * ManifestDocumentLoadingException constructor.
     *
     * @param LibXMLError[] $libxmlErrors
     */
    public function __construct(array $libxmlErrors) {
        $this->libxmlErrors = $libxmlErrors;
        $first              = $this->libxmlErrors[0];

        parent::__construct(
            sprintf(
                '%s (Line: %d / Column: %d / File: %s)',
                $first->message,
                $first->line,
                $first->column,
                $first->file
            ),
            $first->code
        );
    }

    /**
     * @return LibXMLError[]
     */
    public function getLibxmlErrors() {
        return $this->libxmlErrors;
    }
}
