<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Rest\Helpers\Command;

use PHPUnit\Framework\TestCase;
use Tempcord\Discord\Bitwise\Bitwise;
use Tempcord\Discord\Enums\ApplicationCommandOptionType;
use Tempcord\Discord\Enums\ApplicationCommandTypes;
use Tempcord\Discord\Enums\ApplicationIntegrationType;
use Tempcord\Discord\Enums\InteractionContextType;
use Tempcord\Discord\Exceptions\Rest\Helpers\Command\InvalidCommandNameException;
use Tempcord\Discord\Rest\Helpers\Command\CommandBuilder;
use PHPUnit\Framework\Attributes\DataProvider;
use Tempcord\Discord\Rest\Helpers\Command\CommandOptionBuilder;

class CommandBuilderTest extends TestCase
{
    public function testSetName(): void
    {
        $commandBuilder = new CommandBuilder();
        $commandBuilder->setName('test_name');
        $this->assertEquals('test_name', $commandBuilder->getName());
        $this->assertEquals('test_name', $commandBuilder->get()['name']);
    }

    public function testSetNameLocalizations(): void
    {
        $commandBuilder = new CommandBuilder();
        $localizations = ['en_US' => 'test_name', 'fr_FR' => 'test_name_hon_hon'];
        $commandBuilder->setNameLocalizations($localizations);
        $this->assertEquals($localizations, $commandBuilder->getNameLocalizations());
        $this->assertEquals($localizations, $commandBuilder->get()['name_localizations']);
    }

    public function testItValidatesNames(): void
    {
        $commandBuilder = new CommandBuilder();

        $this->expectException(InvalidCommandNameException::class);

        $commandBuilder->setName('::colons arent allowed woo::');
    }

    public function testItValidatesLocalizationNames(): void
    {
        $commandBuilder = new CommandBuilder();

        $this->expectException(InvalidCommandNameException::class);

        $commandBuilder->setNameLocalizations(['en' => '::colons arent allowed woo::']);
    }

    /**
     * Discord allows a command to be named in any script, and a bot serving a
     * community that does not write in English will be. The names below are all
     * legal; each character of them is two or three bytes.
     */
    #[DataProvider('nonAsciiNames')]
    public function testItAllowsNamesOutsideAscii(string $name): void
    {
        $commandBuilder = new CommandBuilder();
        $commandBuilder->setName($name);

        $this->assertEquals($name, $commandBuilder->getName());
    }

    public static function nonAsciiNames(): array
    {
        return [
            'cyrillic' => ['Нікнейм'],
            'greek' => ['λέξη'],
            'japanese' => ['名前'],
            'devanagari' => ['नाम'],
            'thai' => ['ชื่อ'],
        ];
    }

    public function testItStillRejectsNamesOutsideAsciiThatBreakTheRule(): void
    {
        $commandBuilder = new CommandBuilder();

        $this->expectException(InvalidCommandNameException::class);

        // A legal script, but a space is not allowed in a name.
        $commandBuilder->setName('Нік нейм');
    }

    public function testSetDescription(): void
    {
        $commandBuilder = new CommandBuilder();
        $commandBuilder->setDescription('::description::');
        $this->assertEquals('::description::', $commandBuilder->getDescription());
        $this->assertEquals('::description::', $commandBuilder->get()['description']);
    }

    public function testSetDescriptionLocalizations(): void
    {
        $commandBuilder = new CommandBuilder();
        $localizations = ['en_US' => '::description::', 'fr_FR' => '::baguette::'];
        $commandBuilder->setDescriptionLocalizations($localizations);
        $this->assertEquals($localizations, $commandBuilder->getDescriptionLocalizations());
        $this->assertEquals($localizations, $commandBuilder->get()['description_localizations']);
    }

    public function testAddOption(): void
    {
        $commandBuilder = new CommandBuilder();

        $optionBuilder = new CommandOptionBuilder();
        $optionBuilder->setType(ApplicationCommandOptionType::ATTACHMENT);

        $commandBuilder->addOption($optionBuilder);

        $this->assertEquals([$optionBuilder], $commandBuilder->getOptions());
        $this->assertEquals($optionBuilder->get(), $commandBuilder->get()['options'][0]);
    }

    public function testSetDefaultMemberPermissions(): void
    {
        $commandBuilder = new CommandBuilder();
        $permissions = Bitwise::from(
            1 << 1,
            1 << 2
        );

        $commandBuilder->setDefaultMemberPermissions($permissions);

        $this->assertEquals($permissions->get(), $commandBuilder->getDefaultMemberPermissions()->get());

        /*
         * Discord reads this as a decimal bit field. Sending the binary
         * representation would be read back as an entirely different, and
         * much larger, set of permissions.
         */
        $this->assertSame('6', $commandBuilder->get()['default_member_permissions']);
    }

    public function testSetDmPermission(): void
    {
        $commandBuilder = new CommandBuilder();
        $commandBuilder->setDmPermission(true);
        $this->assertTrue($commandBuilder->getDmPermission());
        $this->assertTrue($commandBuilder->get()['dm_permissions']);
    }

    public function testSetType(): void
    {
        $commandBuilder = new CommandBuilder();
        $type = ApplicationCommandTypes::CHAT_INPUT;
        $commandBuilder->setType($type);

        $this->assertEquals($type, $commandBuilder->getType());
        $this->assertEquals($type->value, $commandBuilder->get()['type']);
    }

    public function testSetNsfw(): void
    {
        $commandBuilder = new CommandBuilder();
        $commandBuilder->setNsfw(true);
        $this->assertTrue($commandBuilder->getNsfw());
        $this->assertTrue($commandBuilder->get()['nsfw']);
    }

    public function testSetIntegrationTypes()
    {
        $types = [ApplicationIntegrationType::GUILD_INSTALL, ApplicationIntegrationType::USER_INSTALL];
        $commandBuilder = new CommandBuilder();
        $commandBuilder->setIntegrationTypes(...$types);
        $this->assertEquals($types, $commandBuilder->getIntegrationTypes());
        $this->assertEquals([0, 1], $commandBuilder->get()['integration_types']);
    }

    public function testSetContexts()
    {
        $types = [InteractionContextType::GUILD, InteractionContextType::PRIVATE_CHANNEL];
        $commandBuilder = new CommandBuilder();
        $commandBuilder->setContexts(...$types);
        $this->assertEquals($types, $commandBuilder->getContexts());
        $this->assertEquals([0, 2], $commandBuilder->get()['contexts']);
    }
}
