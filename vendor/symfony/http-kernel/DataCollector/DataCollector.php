<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\DataCollector;

use Symfony\Component\VarDumper\Caster\CutStub;
use Symfony\Component\VarDumper\Cloner\ClonerInterface;
use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\VarDumper\Cloner\Stub;
use Symfony\Component\VarDumper\Cloner\VarCloner;

/**
 * DataCollector.
 *
 * Children of this class must store the collected data in the data property.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Bernhard Schussek <bschussek@symfony.com>
 */
abstract class DataCollector implements DataCollectorInterface, \Serializable
{
    protected $data = array();

    /**
     * @var ClonerInterface
     */
    private $cloner;

    public function serialize()
    {
        return serialize($this->data);
    }

    public function unserialize($data)
    {
        $this->data = unserialize($data);
    }

    /**
     * Converts the variable into a serializable Data instance.
     *
     * This array can be displayed in the template using
     * the VarDumper component.
     *
     * @param mixed $var
     *
     * @return Data
     */
    protected function cloneVar($var)
    {
        if ($var instanceof Data) {
            return $var;
        }
        if (null === $this->cloner) {
            if (!class_exists(CutStub::class)) {
                throw new \LogicException(sprintf('The VarDumper component is needed for the %s() method. Install symfony/var-dumper version 3.4 or above.', __METHOD__));
            }
            $this->cloner = new VarCloner();
            $this->cloner->setMaxItems(-1);
            $this->cloner->addCasters($this->getCasters());
        }

        return $this->cloner->cloneVar($var);
    }

    /**
     * @return callable[] The casters to add to the cloner
     */
    protected function getCasters()
    {
        return array(
            '*' => function ($v, array $a, Stub $s, $isNested) {
                if (!$v instanceof Stub) {
                    foreach ($a as $k => $v) {
                        if (is_object($v) && !$v instanceof \DateTimeInterface && !$v instanceof Stub) {
                            $a[$k] = new CutStub($v);
                        }
                    }
                }

                return $a;
            },
        );
    }
}
