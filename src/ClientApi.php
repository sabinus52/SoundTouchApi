<?php
/**
 * Client d'intérrogation de l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\UriResolver;
use GuzzleHttp\Exception\RequestException;
use Sabinus\SoundTouch\Request\RequestInterface;


class ClientApi
{

    /**
     * Base de l'URI de l'intérrogation l'enceinte
     */
    const BASE_URI = 'http://%s:8090';

    /**
     * Méthodes des requests
     */
    const METHOD_GET  = 'GET';
    const METHOD_POST = 'POST';

    
    /**
     * Client HTTP
     * 
     * @var Client
     */
    private $client;

    /**
     * Message d'erreur éventuel
     * 
     * @var String
     */
    private $msgError;


    /**
     * Constructeur
     * 
     * @param String $host
     */
    public function __construct($host)
    {
        $this->client = new Client(array(
            'base_uri' => sprintf(self::BASE_URI, $host),
            'connect_timeout' => 2.0,
            'timeout' => 2.0,
        ));
    }


    /**
     * Retourne le message d'erreur
     * 
     * @return String
     */
    public function getMessageError()
    {
        return $this->msgError;
    }


    /**
     * Envoi de la requête à l'enceinte
     * 
     * @param RequestInterface $request : Objet de la requête
     * @return Mixed
     */
    public function request(RequestInterface $request)
    {
        $this->msgError = '';
        $uri = new Uri($request->getUri());

        switch ($request->getMethod()) {
            case self::METHOD_GET:
                return $this->get($uri, $request);
            
            case self::METHOD_POST:
                return $this->post($uri, $request->getPayload());
            
            default:
                $this->msgError = 'Bad Method Request';
                return false;
        }
    }


    /**
     * Envoie une requête ave la méthode GET
     * 
     * @param Uri $uri
     * @param RequestInterface $request
     * @return Boolean
     * @throws
     */
    private function get($uri, RequestInterface $request)
    {
        $response = new Response();

        try {
        
            $result = $this->client->get($uri);
        
        } catch (RequestException $e) {
        
            //$this->msgError = Psr7\str($e->getRequest());
            $this->msgError = 'Error on the request : /'.$uri;
            if ($e->hasResponse()) {
                //$this->msgError.= "\nERR:".Psr7\str($e->getResponse());
                $response->parseContent($e->getResponse()->getBody());
                $this->msgError.= "\n".$response->getMessageError();
            }
            return false;
        }

        // Parse la réponse
        $response->parseContent($result->getBody()->getContents());
        if ( ! $response->isSuccess() ) {
            $this->msgError = $response->getMessageError();
            return false;
        }
        // Retourne l'objet et affecte le contenu dans l'objet créer
        $obj = $request->createClass();
        $obj->setResponse($response->getXML());
        return $obj;
    }


    /**
     * Envoie une requête ave la méthode POST
     * 
     * @param Uri $uri
     * @param String $payload
     * @return Boolean
     * @throws
     */
    private function post($uri, $payload)
    {
        $response = new Response();

        try {
        
            $result = $this->client->post($uri, array('body' => $payload));

        } catch (RequestException $e) {

            //$this->msgError = Psr7\str($e->getRequest());
            $this->msgError = 'Error on the request : /'.$uri;
            if ($e->hasResponse()) {
                //$this->msgError.= "\nERR:".Psr7\str($e->getResponse());
                $response->parseContent($e->getResponse()->getBody());
                $this->msgError.= "\n".$response->getMessageError();
            }
            return false;
        }

        // Parse le contenu pour vérifier s'il n'y a pas d'erreur
        $response->parseContent($result->getBody()->getContents());
        return $response->isSuccess();
    }

}