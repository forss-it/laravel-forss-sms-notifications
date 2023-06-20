<?php
namespace Forss\Laravel\Notifications\ForssSms\Test;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Mockery;
use Forss\Laravel\Notifications\ForssSms\ForssSmsMessage;
use Forss\Laravel\Notifications\ForssSms\ForssSmsChannel;
use Forss\Laravel\Notifications\ForssSms\ForssSmsApi;
use PHPUnit\Framework\TestCase;

class ForssSmsChannelTest extends TestCase
{
     /**
     * @var ForssSmsApi|Mockery\MockInterface
     */
    protected $forssSmsApi;

    /**
     * @var ForssSmsChannel
     */
    protected $forssSmsChannel;

    /**
     * @var Mockery\MockInterface|Notification
     */
    protected $testNotification;

    protected function setUp(): void
    {
        $this->forssSmsApi = Mockery::mock(ForssSmsApi::class);

        $this->forssApiChannel = new ForssSmsChannel($this->forssSmsApi);
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }

    /** @test */
    public function it_sends_a_notification()
    {
        $this->forssSmsApi
            ->shouldReceive('send')
            ->once();

        $this->forssApiChannel->send(new TestNotifiable(), new TestNotification());
    }
}

class TestNotifiable
{
    use Notifiable;

    public function routeNotificationForSipgate()
    {
        return 'RECIPIENT_SET_IN_NOTIFIABLE';
    }
}

class TestNotification extends Notification
{
    public function toForssSms($notifiable)
    {
        return new ForssSmsMessage('Hello World!');
    }
}