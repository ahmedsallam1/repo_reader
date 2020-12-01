<?php
namespace App\Tests\Service;

use App\Service\RepositoryService;
use App\Repository\RepositoriesRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RepositoryServiceTest extends WebTestCase
{
    /**
     * @var		mixed	$service
     */
    private $service;

    /**
     * @var		mixed	$result
     */
    private $result;

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
        self::bootKernel();

        $repository = $this->getMockBuilder(RepositoriesRepository::class)->disableOriginalConstructor()->getMock();
        $repository->method('findPaginated')->willReturn([
            'pagination' => [],
            'data' => [],
        ]);

        $this->service = new RepositoryService($repository);

        $this->result = $this->service->findPaginated([]);
    }    

    /**
     * test_find_paginated_should_return_array.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 30th, 2020.
     * @access	public
     * @return	void
     */
    public function test_find_paginated_should_return_array()
    {
        $this->assertIsArray($this->result);
    }

    /**
     * test_find_paginated_should_return_array_with_data.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 30th, 2020.
     * @access	public
     * @return	void
     */
    public function test_find_paginated_should_return_array_with_data()
    {
        $this->assertArrayHasKey('data', $this->result);
    }

    /**
     * test_find_paginated_should_return_array_with_pagination.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 30th, 2020.
     * @access	public
     * @return	void
     */
    public function test_find_paginated_should_return_array_with_pagination()
    {
        $this->assertArrayHasKey('pagination', $this->result);
    }
}