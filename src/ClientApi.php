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
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\UriResolver;
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
     * Envoi de la requête à l'enceinte
     * 
     * @param RequestInterface $request : Objet de la requête
     * @return Response
     * @throws
     */
    public function request(RequestInterface $request)
    {
        $uri = new Uri($request->getUri());

        // TODO : gestion exception
        switch ($request->getMethod()) {
            case self::METHOD_GET:
                $result = $this->client->get($uri);
                break;
            
            case self::METHOD_POST:
                $result = $this->client->post($uri, array('body' => $request->getPayload()));
                break;
            
            default:
                // TODO gestion erreur
                # code...
                break;
        }
        
        $response = new Response($result->getBody()->getContents());

        return $response->getXML();
    }

}