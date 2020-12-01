<?php
namespace App\Tests\Controller\APi;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * RepositoryControllerTest.
 *
 * @author	Ahmed
 * @since	v0.0.1
 * @version	v1.0.0	Monday, November 30th, 2020.
 * @see		WebTestCase
 * @global
 */
class RepositoryControllerTest extends WebTestCase
{
    /**
     * @var		mixed	$client
     */
    private $client;

    /**
     * @var		mixed	$response
     */
    private $response;

    private $content;
    
    /**
     * setUp.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 30th, 2020.
     * @access	protected
     * @return	void
     */
    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->response = $this->invoke([
            'sort' => 'stars',
            'order' => 'desc',
            'limit' => 10,
            'start_date' => '2019-08-09',
            'language' => 'php',
        ]);

        $this->content = $this->response->getContent();
    }    

    /**
     * test_get_repositories_should_return_success.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 30th, 2020.
     * @access	public
     * @return	void
     */
    public function test_get_repositories_should_return_success()
    {
        $this->assertEquals(200, $this->response->getStatusCode());
    }

    /**
     * test_get_repositories_should_return_json.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 30th, 2020.
     * @access	public
     * @return	void
     */
    public function test_get_repositories_should_return_json()
    {
        $this->assertJson($this->content);
    }

    /**
     * test_get_repositories_should_return_data.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 30th, 2020.
     * @access	public
     * @return	void
     */
    public function test_get_repositories_should_return_data()
    {
        $result = json_decode($this->content, true);

        $this->assertArrayHasKey('data', $result);
    }

    /**
     * test_get_most_popular_repositories_should_return_sorted_by_stars_desc.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 30th, 2020.
     * @access	public
     * @return	void
     */
    public function test_get_most_popular_repositories_should_return_sorted_by_stars_desc()
    {

        $result = json_decode($this->content, true)['data'];

        $this->assertPopulareResult($result);
    }

    /**
     * test_get_top_10_popular_repositories_should_return_10_sorted_by_stars_desc.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 30th, 2020.
     * @access	public
     * @return	void
     */
    public function test_get_top_10_popular_repositories_should_return_10_sorted_by_stars_desc()
    {
        $result = json_decode($this->content, true)['data'];

        $this->assertPopulareResult($result);
        $this->assertEquals(count($result), 10);
    }

    /**
     * test_get_popular_repositories_from_2019_08_09_should_return_sorted_by_stars_desc_from_2019_08_09_and_onwards.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 30th, 2020.
     * @access	public
     * @return	void
     */
    public function test_get_popular_repositories_from_2019_08_09_should_return_sorted_by_stars_desc_from_2019_08_09_and_onwards()
    {
        $result = json_decode($this->content, true)['data'];

        $this->assertPopulareResult($result);
        
        $expectedDate = new \DateTime('2019-08-09 00:00:00');

        foreach ($result as $repo) {
            $actualDate = new \DateTime($repo['created_at']);

            $this->assertTrue(($actualDate >= $expectedDate));
        }
    }

    /**
     * test_get_popular_repositories_with_php_language_should_return_sorted_by_stars_desc_with_php_language.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 30th, 2020.
     * @access	public
     * @return	void
     */
    public function test_get_popular_repositories_with_php_language_should_return_sorted_by_stars_desc_with_php_language()
    {
        $result = json_decode($this->content, true)['data'];

        $this->assertPopulareResult($result);

        foreach ($result as $repo) {
            $this->assertEquals('php', strtolower($repo['language']));
        }
    }

    /**
     * invoke.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 30th, 2020.
     * @access	private
     * @param	array	$parameters	Default: []
     * @return	mixed
     */
    private function invoke(array $parameters = [])
    {
        $this->client->request('GET', '/api/repositories', $parameters);

        return $this->client->getResponse();
    }

    /**
     * assertPopulareResult.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 30th, 2020.
     * @access	private
     * @param	array	$result	
     * @return	void
     */
    private function assertPopulareResult(array $result)
    {
        $prevStars = array_shift($result);
        $prevStars = $prevStars ? $prevStars['stargazers_count'] : 0;

        foreach ($result as $repo) {
            $current = $repo['stargazers_count'];
            $this->assertLessThanOrEqual($prevStars, $current);
            $prevStars = $current;
        }
    }
}