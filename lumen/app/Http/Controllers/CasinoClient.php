<?php

namespace App\Http\Controllers;

use Datto\JsonRpc\Http\Client;
use Datto\JsonRpc\Http\Exceptions\HttpException;
use Datto\JsonRpc\Responses\ErrorResponse;
use Datto\JsonRpc\Http\Server;
use Datto\JsonRpc\Exceptions\ArgumentException;
use Datto\JsonRpc\Exceptions\MethodException;
use Datto\JsonRpc\Exceptions\ApplicationException;
class CasinoClient extends Server
{
      /**
       * @var \JsonRPC\Client
       */
      private $_uri;

      /**
       * Client constructor.
       *
       * Config array:
       *  - url              string JSON-RPC 2.0 Server
       *  - ssl_verification boolean Certificate verification of HTTP connection over TLS
       *
       * @param array $config
       * @throws Exception
       */
      public function __construct($config)
      {
        if(!array_key_exists('url', $config))
        {
          throw new ApplicationException("You must specify endpoint url for gameserver API.", '401');
        }
        $this->_uri = $config['url'];
      }

      /**
       * @param string $method
       * @param array $params
       * @return array
       */
      private function execute($method, $params = array())
      {
        $client = new Client($this->_uri);
        $client->query($method, $params, $result); /** @var int $result */
        $client->send();
        return $result;
      }

      /**
       * Returns a list of available games
       *
       * @link https://github.com/betssh/betssh-api-client/wiki/API-Documentation#gamelist
       *
       * @return array
       */
      public function listGames()
      {
        return $this->execute("Game.List");
      }
}
