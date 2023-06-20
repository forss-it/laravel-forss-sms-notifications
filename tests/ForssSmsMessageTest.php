<?php
namespace Forss\Laravel\Notifications\ForssSms\Test;

use Forss\Laravel\Notifications\ForssSms\ForssSmsMessage;
use PHPUnit\Framework\TestCase;

class ForssSmsMessageTest extends TestCase
{
    /** @test */
    public function it_can_instantiate_with_message(): void
    {
        $message = new ForssSmsMessage('test');

        $this->assertEquals('test', $message->message);
    }

    /** @test */
    public function it_can_set_to(): void
    {
        $message = new ForssSmsMessage('test');
        $message->to('123');
        $this->assertEquals('123', $message->to);
    }

}