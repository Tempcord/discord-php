<?php

declare(strict_types=1);

namespace Tests\CyberWolf\Discord\Rest\Helpers\Channel\Message;

use CyberWolf\Discord\Component\Button\PrimaryButton;
use CyberWolf\Discord\Component\SelectMenu\StringSelectMenu;
use CyberWolf\Discord\Enums\MessageComponentType;
use CyberWolf\Discord\Rest\Helpers\Channel\ComponentBuilder;
use CyberWolf\Discord\Rest\Helpers\Channel\ComponentRowBuilder;
use CyberWolf\Discord\Rest\Helpers\Channel\MessageBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Laying components out on a message.
 *
 * Exercised through MessageBuilder, but the trait is shared with the
 * interaction, edit and webhook builders, so this covers all of them.
 */
class AddComponentTest extends TestCase
{
    private function button(string $id): PrimaryButton
    {
        return new PrimaryButton($id, $id);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function rows(MessageBuilder $message): array
    {
        return $message->getComponents()?->get() ?? [];
    }

    public function testAMessageStartsWithNoComponents(): void
    {
        $message = MessageBuilder::new();

        $this->assertNull($message->getComponents());
        $this->assertFalse($message->hasComponents());
    }

    public function testARowHoldsExactlyWhatItWasGiven(): void
    {
        $message = MessageBuilder::new()->addRow($this->button('a'), $this->button('b'));

        $rows = $this->rows($message);

        $this->assertCount(1, $rows);
        $this->assertEquals(MessageComponentType::ACTION_ROW->value, $rows[0]['type']);
        $this->assertCount(2, $rows[0]['components']);
    }

    public function testSeveralRowsKeepTheirOrder(): void
    {
        $message = MessageBuilder::new()
            ->addRow($this->button('a'))
            ->addRow($this->button('b'));

        $rows = $this->rows($message);

        $this->assertCount(2, $rows);
        $this->assertEquals('a', $rows[0]['components'][0]['custom_id']);
        $this->assertEquals('b', $rows[1]['components'][0]['custom_id']);
    }

    public function testASingleButtonGetsARowOfItsOwn(): void
    {
        $rows = $this->rows(MessageBuilder::new()->addButton($this->button('a')));

        $this->assertCount(1, $rows);
        $this->assertCount(1, $rows[0]['components']);
    }

    /**
     * Laying buttons out by hand is the tedious part, so buttons fill the row
     * being built rather than each starting one.
     */
    public function testButtonsFillTheRowBeingBuilt(): void
    {
        $message = MessageBuilder::new();

        foreach (['a', 'b', 'c'] as $id) {
            $message->addButton($this->button($id));
        }

        $rows = $this->rows($message);

        $this->assertCount(1, $rows);
        $this->assertCount(3, $rows[0]['components']);
    }

    /**
     * Discord fits five buttons across a row, so the sixth starts another.
     */
    public function testTheSixthButtonStartsANewRow(): void
    {
        $message = MessageBuilder::new();

        foreach (['a', 'b', 'c', 'd', 'e', 'f'] as $id) {
            $message->addButton($this->button($id));
        }

        $rows = $this->rows($message);

        $this->assertCount(2, $rows);
        $this->assertCount(5, $rows[0]['components']);
        $this->assertCount(1, $rows[1]['components']);
        $this->assertEquals('f', $rows[1]['components'][0]['custom_id']);
    }

    /**
     * An explicit row is a deliberate grouping, so a button added afterwards
     * joins it rather than being pushed away from it.
     */
    public function testAButtonJoinsAnExplicitRowThatHasRoom(): void
    {
        $message = MessageBuilder::new()
            ->addRow($this->button('a'))
            ->addButton($this->button('b'));

        $rows = $this->rows($message);

        $this->assertCount(1, $rows);
        $this->assertCount(2, $rows[0]['components']);
    }

    public function testARowAndAButtonMayBeMixed(): void
    {
        $menu = new StringSelectMenu('menu')->addOption('One', '1');

        $message = MessageBuilder::new()
            ->addButton($this->button('a'))
            ->addRow($menu);

        $rows = $this->rows($message);

        $this->assertCount(2, $rows);
        $this->assertEquals('a', $rows[0]['components'][0]['custom_id']);
        $this->assertEquals('menu', $rows[1]['components'][0]['custom_id']);
    }

    /**
     * Anything the shorthands do not cover is still built by hand, and has to
     * replace rather than merge with whatever came before.
     */
    public function testABuiltLayoutReplacesWhatWasAddedBefore(): void
    {
        $message = MessageBuilder::new()
            ->addButton($this->button('a'))
            ->setComponents(
                new ComponentBuilder()->addRow(new ComponentRowBuilder()->add($this->button('z')))
            );

        $rows = $this->rows($message);

        $this->assertCount(1, $rows);
        $this->assertEquals('z', $rows[0]['components'][0]['custom_id']);
    }

    public function testARowReportsWhatItHolds(): void
    {
        $row = new ComponentRowBuilder()->add($this->button('a'))->add($this->button('b'));

        $this->assertCount(2, $row->getComponents());
        $this->assertEquals(2, $row->count());
    }
}
