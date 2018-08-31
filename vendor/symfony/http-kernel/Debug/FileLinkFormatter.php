<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Debug;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Formats debug file links.
 *
 * @author Jérémy Romey <jeremy@free-agent.fr>
 */
class FileLinkFormatter implements \Serializable
{
    private $fileLinkFormat;
    private $requestStack;
    private $baseDir;
    private $urlFormat;

    public function __construct($fileLinkFormat = null, RequestStack $requestStack = null, string $baseDir = null, string $urlFormat = null)
    {
        $fileLinkFormat = $fileLinkFormat ?: ini_get('xdebug.file_link_format') ?: get_cfg_var('xdebug.file_link_format');
        if ($fileLinkFormat && !is_array($fileLinkFormat)) {
            $i = strpos($f = $fileLinkFormat, '&', max(strrpos($f, '%f'), strrpos($f, '%l'))) ?: strlen($f);
            $fileLinkFormat = array(substr($f, 0, $i)) + preg_split('/&([^>]++)>/', substr($f, $i), -1, PREG_SPLIT_DELIM_CAPTURE);
        }

        $this->fileLinkFormat = $fileLinkFormat;
        $this->requestStack = $requestStack;
        $this->baseDir = $baseDir;
        $this->urlFormat = $urlFormat;
    }

    public function format($file, $line)
    {
        if ($fmt = $this->getFileLinkFormat()) {
            for ($i = 1; isset($fmt[$i]); ++$i) {
                if (0 === strpos($file, $k = $fmt[$i++])) {
                    $file = substr_replace($file, $fmt[$i], 0, strlen($k));
                    break;
                }
            }

            return strtr($fmt[0], array('%f' => $file, '%l' => $line));
        }

        return false;
    }

    public function serialize()
    {
        return serialize($this->getFileLinkFormat());
    }

    public function unserialize($serialized)
    {
        $this->fileLinkFormat = unserialize($serialized, array('allowed_classes' => false));
    }

    private function getFileLinkFormat()
    {
        if ($this->fileLinkFormat) {
            return $this->fileLinkFormat;
        }
        if ($this->requestStack && $this->baseDir && $this->urlFormat) {
            $request = $this->requestStack->getMasterRequest();
            if ($request instanceof Request) {
                return array(
                    $request->getSchemeAndHttpHost().$request->getBaseUrl().$this->urlFormat,
                    $this->baseDir.DIRECTORY_SEPARATOR, '',
                );
            }
        }
    }
}
