<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Mapping;

use Carbon\Carbon;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Tempcord\Discord\Discord;
use Tempcord\Discord\Enums\MessageType;
use Tempcord\Discord\Mapping\ArrayMapping;
use Tempcord\Discord\Mapping\Mapper;
use Tempcord\Discord\Parts\EmbedField;
use PHPUnit\Framework\Attributes\DataProvider;

class MapperTest extends TestCase
{
    private Mapper $mapper;

    protected function setUp(): void
    {
        $this->mapper = new Mapper();
    }

    public function testItMapsIntoObjectsUsingConstructor(): void
    {
        $datetime = Carbon::now();
        $source = $datetime->toIso8601String();

        $result = $this->mapper->map($source, Carbon::class);

        $this->assertInstanceOf(Carbon::class, $result->result);
        $this->assertEquals($source, $result->result->toIso8601String());
        $this->assertEmpty($result->errors);
    }

    public function testItCreatesAnObjectAndSetsScalarProperties(): void
    {
        $definition = new class () {
            public bool $boolTest;
            public int $intTest;
            public float $floatTest;
            public string $stringTest;
            public array $arrayTest;
        };

        $result = $this->mapper->map((object) [
            'boolTest' => true,
            'intTest' => 123,
            'floatTest' => 123.456,
            'stringTest' => 'Hello',
            'arrayTest' => ['Hello', 'world'],
        ], $definition::class);

        $this->assertInstanceOf($definition::class, $result->result);
        $this->assertEquals(true, $result->result->boolTest);
        $this->assertEquals(123, $result->result->intTest);
        $this->assertEquals(123.456, $result->result->floatTest);
        $this->assertEquals('Hello', $result->result->stringTest);
        $this->assertEquals(['Hello', 'world'], $result->result->arrayTest);
        $this->assertEmpty($result->errors);
    }

    public function testItNonTypedProperties(): void
    {
        $definition = new class () {
            public $test;
        };

        $result = $this->mapper->map((object) [
            'test' => 'Hello',
        ], $definition::class);

        $this->assertInstanceOf($definition::class, $result->result);
        $this->assertEquals('Hello', $result->result->test);
        $this->assertEmpty($result->errors);

        $result = $this->mapper->map((object) [
            'test' => true,
        ], $definition::class);

        $this->assertInstanceOf($definition::class, $result->result);
        $this->assertTrue($result->result->test);
        $this->assertEmpty($result->errors);
    }

    public function testItSetsUnionTypes(): void
    {
        $definition = new class () {
            public string|bool $test;
        };

        $result = $this->mapper->map((object) [
            'test' => 'Hello',
        ], $definition::class);

        $this->assertInstanceOf($definition::class, $result->result);
        $this->assertEquals('Hello', $result->result->test);
        $this->assertEmpty($result->errors);

        $result = $this->mapper->map((object) [
            'test' => true,
        ], $definition::class);

        $this->assertInstanceOf($definition::class, $result->result);
        $this->assertTrue($result->result->test);
        $this->assertEmpty($result->errors);
    }

    public function testItDoesNotSupportIntersectionTypes(): void
    {
        $definition = new class () {
            public Carbon&MockInterface $test;
        };

        $result = $this->mapper->map((object) [
            'test' => 'Hello',
        ], $definition::class);

        $this->assertInstanceOf($definition::class, $result->result);
        $this->assertFalse(isset($result->result->test));
        $this->assertNotEmpty($result->errors);
    }

    public function testItDoesNotAllowNonArraysToArrayMapping(): void
    {
        $definition = new class () {
            public array $test;
        };

        $result = $this->mapper->map((object) [
            'test' => 'Hello',
        ], $definition::class);

        $this->assertInstanceOf($definition::class, $result->result);
        $this->assertFalse(isset($result->result->test));
        $this->assertNotEmpty($result->errors);
    }

    public function testItAllowsTypedArrays()
    {
        $definition = new class () {
            #[ArrayMapping(EmbedField::class)]
            public array $test;
        };

        $source = (object) [
            'test' => [
                (object) [
                    'name' => '::name::',
                    'value' => '::value::',
                    'inline' => false,
                ],
            ],
        ];

        $result = $this->mapper->map($source, $definition::class);

        $this->assertInstanceOf($definition::class, $result->result);
        $this->assertEmpty($result->errors);

        $this->assertInstanceOf(EmbedField::class, $result->result->test[0]);
        $this->assertEquals('::name::', $result->result->test[0]->name);
        $this->assertEquals('::value::', $result->result->test[0]->value);
        $this->assertFalse($result->result->test[0]->inline);
    }

    public function testItSetsEnums(): void
    {
        $definition = new class () {
            public MessageType $test;
        };

        $result = $this->mapper->map((object) [
            'test' => 0,
        ], $definition::class);

        $this->assertInstanceOf($definition::class, $result->result);
        $this->assertEquals(MessageType::DEFAULT, $result->result->test);
        $this->assertEmpty($result->errors);
    }

    public function testItSetsClassTypedProperties(): void
    {
        $definition = new class () {
            public EmbedField $test;
        };

        $result = $this->mapper->map((object) [
            'test' => (object) [
                'name' => '::name::',
                'value' => '::value::',
                'inline' => false,
            ],
        ], $definition::class);

        $this->assertInstanceOf($definition::class, $result->result);
        $this->assertInstanceOf(EmbedField::class, $result->result->test);
        $this->assertEquals('::name::', $result->result->test->name);
        $this->assertEquals('::value::', $result->result->test->value);
        $this->assertFalse($result->result->test->inline);
        $this->assertEmpty($result->errors);
    }

    #[DataProvider('incorrectAssignmentsProvider')]
    public function testItReturnsErrorsForIncorrectAssignments(string $definition, $source)
    {
        $result = $this->mapper->map($source, $definition);

        $this->assertNotEmpty($result->errors);
    }

    public static function incorrectAssignmentsProvider()
    {
        return [
            'Non existing enum case, resulting on null on non-nullable prop' => (function () {
                $definition = new class () {
                    public MessageType $test;
                };

                return [
                    'definition' => $definition::class,
                    'source' => (object) [
                        'test' => 9001,
                    ],
                ];
            })(),

            'Instantiating class with wrong args' => (function () {
                $definition = new class ([]) {
                    public function __construct(array $test)
                    {
                    }
                };

                return [
                    'definition' => $definition::class,
                    'source' => 'hello world',
                ];
            })(),

            'Instantiating class with wrong args as property, resulting in null on non-nullable prop' => (function () {
                $definition = new class () {
                    public Discord $test;
                };

                return [
                    'definition' => $definition::class,
                    'source' => (object) [
                        'test' => [['hi there']]
                    ],
                ];
            })(),
        ];
    }

    public function testItMapsEnumArrays()
    {
        $definition = new class () {
            #[ArrayMapping(MessageType::class)]
            public array $test;
        };

        $source = (object) [
            'test' => [
                0,
                1,
                2,
            ],
        ];

        $result = $this->mapper->map($source, $definition::class);

        $this->assertInstanceOf($definition::class, $result->result);
        $this->assertEmpty($result->errors);

        $this->assertEquals([
            MessageType::DEFAULT,
            MessageType::RECIPIENT_ADD,
            MessageType::RECIPIENT_REMOVE,
        ], $result->result->test);
    }

    /**
     * Discord adds fields to its objects faster than any library models them,
     * and every element of an array carries the same unmodelled field. Reported
     * once each, a guild's worth of members turns a dozen unknown fields into
     * tens of thousands of exceptions held at once.
     */
    public function testItReportsEachProblemInAnArrayOnceRatherThanPerElement(): void
    {
        $definition = new class () {
            #[ArrayMapping(EmbedField::class)]
            public array $test;
        };

        $element = ['name' => 'a', 'value' => 'b', 'unmodelled' => 1, 'alsoUnmodelled' => 2];

        $result = $this->mapper->map((object) [
            'test' => array_fill(0, 50, (object) $element),
        ], $definition::class);

        $this->assertCount(50, $result->result->test);
        $this->assertCount(2, $result->errors);

        $this->assertEqualsCanonicalizing(
            ['unmodelled', 'alsoUnmodelled'],
            array_map(static fn ($error) => $error->propertyName, $result->errors),
        );
    }

    /**
     * Deduplicating must not swallow a problem that only some elements have.
     */
    public function testItStillReportsAProblemOnlyOneElementHas(): void
    {
        $definition = new class () {
            #[ArrayMapping(EmbedField::class)]
            public array $test;
        };

        $result = $this->mapper->map((object) [
            'test' => [
                (object) ['name' => 'a', 'value' => 'b'],
                (object) ['name' => 'c', 'value' => 'd', 'onlyHere' => 1],
            ],
        ], $definition::class);

        $this->assertCount(2, $result->result->test);
        $this->assertCount(1, $result->errors);
        $this->assertEquals('onlyHere', $result->errors[0]->propertyName);
    }
}
