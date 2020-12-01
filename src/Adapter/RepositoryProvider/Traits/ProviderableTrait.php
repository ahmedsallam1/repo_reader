<?php
namespace App\Adapter\RepositoryProvider\Traits;

use Symfony\Contracts\HttpClient\HttpClientInterface;

trait ProviderableTrait
{
    /**
     * @var		array	$parameters
     */
    private $parameters = [];

    /**
     * @var		mixed	$response
     */
    private $response;

    /**
     * __construct.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @param	httpclientinterface	$client	
     * @return	void
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Send Http GET request
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	self
     */
    public function get(): self
    {
        $this->response = $this->client->request(
            'GET',
            $this->getUrl(),
            ['query' => $this->parameters]
        );

        return $this;
    }

    /**
     * return response content
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	array
     */
    public function getContent(): array
    {
        if ($this->response->getStatusCode() !== 200) {
            return [];
        }

        return json_decode($this->response->getContent(), true);
    }

    /**
     * Add to request parameters
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @param string $key
     * @param string $value
     * @return	self
     */
    public function  addToParameters(string $key, string $value): self
    {
        $this->parameters[$key] = $value;

        return $this;
    }

    /**
     * return list of parameters
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	mixed
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}