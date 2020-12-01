<?php
namespace App\Repository;

use App\Adapter\RepositoryProvider\Contract\RepositoryProviderInterface;

class RepositoriesRepository
{
    /**
     * @var		RepositoryProviderInterface	$provider
     */
    private $provider;

    /**
     * __construct.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @param	repositoryproviderinterface	$githubProvider	
     * @return	void
     */
    public function __construct(RepositoryProviderInterface $githubProvider)
    {
        $this->provider = $githubProvider->setEntity('/search/repositories');
    }

    /**
     * Returns array of paginated repositories
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @param	array	$criteria	
     * @return	array
     */
    public function findPaginated(array $criteria): array
    {
        return $this->findBy($criteria)->paginated();
    }

    /**
     * Returns an instance of repositories provider after binding the given criteria
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @param	array	$criteria	
     * @return	RepositoryProviderInterface
     */
    public function findBy(array $criteria): RepositoryProviderInterface
    {
        $provider = $this->provider;

        foreach ($criteria as $key => $value) {
            $method = 'scope' . str_replace('_', '', ucwords($key, '_'));

            if (!method_exists($provider, $method)) {
                continue;
            }

            $provider = $provider->{$method}($value);
        }

        return $provider->find();
    }
}