<?php
namespace App\Service;

use App\Repository\RepositoriesRepository;

/**
 * RepositoryService.
 *
 * @author	Ahmed
 * @since	v0.0.1
 * @version	v1.0.0	Monday, November 30th, 2020.
 * @global
 */
class RepositoryService
{
    /**
     * @var		RepositoriesRepository	$repository
     */
    private $repository;

    /**
     * __construct.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 30th, 2020.
     * @access	public
     * @param	repositoriesrepository	$repository	
     * @return	void
     */
    public function __construct(RepositoriesRepository $repository) 
    {
        $this->repository = $repository;
    }

    /**
     * Returns array of paginated repositories
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Monday, November 30th, 2020.
     * @access	public
     * @param	array	$crieria	
     * @return	array
     */
    public function findPaginated(array $crieria): array
    {
        return $this->repository->findPaginated($crieria);
    }
}