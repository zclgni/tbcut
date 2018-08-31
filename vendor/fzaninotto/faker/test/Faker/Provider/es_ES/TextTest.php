<?php

namespace Faker\Test\Provider\es_ES;

use Faker\Generator;
use Faker\Provider\es_ES\Text;

class TextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Generator
     */
    private $faker;

    public function setUp()
    {
        $faker = new Generator();
        $faker->addProvider(new Text($faker));
        $this->faker = $faker;
    }

    public function testText()
    {
        $this->assertNotSame('', $this->faker->realtext(200, 2));
    }
}
