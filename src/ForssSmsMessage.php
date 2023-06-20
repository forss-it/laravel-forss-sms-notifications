<?php
namespace Forss\Laravel\Notifications\ForssSms;

class ForssSmsMessage
{
    /**
     * The phone number the message should be sent to.
     *
     * @var string
     */
    public $to = '';

    /**
     * The message message.
     *
     * @var string
     */
    public $message = '';

    /**
     * Time of sending a message.
     *
     * @var \DateTimeInterface
     */
    public $sendAt;

    /**
     * Create a new message instance.
     *
     * @param  string $message
     *
     * @return static
     */
    public static function create($message = '')
    {
        return new static($message);
    }

    /**
     * @param  string  $message
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }

    /**
     * Set the message message.
     *
     * @param  string  $message
     *
     * @return $this
     */
    public function message($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set the phone number the message should be sent to.
     *
     * @param  string  $from
     *
     * @return $this
     */
    public function to($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Set the time the message should be sent.
     *
     * @param  \DateTimeInterface|null  $sendAt
     *
     * @return $this
     */
    public function sendAt(\DateTimeInterface $sendAt = null)
    {
        $this->sendAt = $sendAt;

        return $this;
    }
}