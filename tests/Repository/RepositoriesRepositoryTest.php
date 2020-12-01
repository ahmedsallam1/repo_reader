<?php
namespace App\Tests\Repository;

use App\Adapter\RepositoryProvider\Contract\RepositoryProviderInterface;
use App\Adapter\RepositoryProvider\Provider\GithubProvider;
use App\Repository\RepositoriesRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RepositoriesRepositoryTest extends WebTestCase
{
    /**
     * @var		mixed	$repository
     */
    private $repository;

    /**
     * setUp.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	protected
     * @return	void
     */
    protected function setUp(): void
    {
        self::bootKernel();

        $provider = $this->getMockBuilder(GithubProvider::class)->disableOriginalConstructor()->getMock();

        $provider->method('paginated')->willReturn([
                'pagination' => [],
                'data' => [],
        ]);

        $this->repository = new RepositoriesRepository($provider);
    }    

    /**
     * test_find_by_should_return_instance_of_provider_interface.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	void
     */
    public function test_find_by_should_return_instance_of_provider_interface()
    {
        $this->assertInstanceOf(RepositoryProviderInterface::class, $this->repository->findBy([]));
    }
}