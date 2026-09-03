<?php

declare(strict_types=1);

namespace Tempcord\Discord\Exceptions\Rest\Helpers\Message;

use Exception;

class TooManyEmbedsException extends Exception
{
    public function __construct(int $limit, int $given)
    {
        parent::__construct(
            'Discord takes ' . $limit . ' embeds in a message and was given ' . $given
            . '. It refuses the whole message over the extra ones rather than dropping them.',
        );
    }
}
