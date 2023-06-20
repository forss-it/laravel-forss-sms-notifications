<?php
namespace Forss\Laravel\Notifications\ForssSms;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Arr;
use Forss\Laravel\Notifications\ForssSms\Exceptions\CouldNotSendNotification;
class ForssSmsApi
{
    /** @var HttpClient */
    protected $client;

     /** @var string */
     protected $username;

     /** @var string */
     protected $password;
 
     /** @var string */
     protected $sender;

     /** @var string */
     protected $endpoint;

    public function __construct(array $config)
    {
        $this->username = Arr::get($config, 'username');
        $this->password = Arr::get($config, 'password');
        $this->sender = Arr::get($config, 'sender');
        $this->endpoint = Arr::get($config, 'host', 'http://sms.forss.net').'/new/send.php';

        $this->client = new HttpClient([
            'timeout' => 5,
            'connect_timeout' => 5,
        ]);
    }

    public function overrideClient($client) {
        $this->client = $client;
    }

    public function send($to, $message)
    {
        $query = [
            'username'   => $this->username,
            'password'   => $this->password,
            'sender'     => $this->sender,
            'recipient' => $to,
            'data'  => utf8_decode($message),
        ];
        
        try {
            $response = $this->client->request('get', $this->endpoint, ['query' => $query]);

            $responseMessage = $response->getBody();
           
            if(str_contains($responseMessage, 'ERROR')) {
                throw CouldNotSendNotification::errorResponseFromServer($responseMessage);
            }

            return $response;
        } catch (CouldNotSendNotification $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            throw CouldNotSendNotification::connectionFailed($exception);
        }
    }

    
}
