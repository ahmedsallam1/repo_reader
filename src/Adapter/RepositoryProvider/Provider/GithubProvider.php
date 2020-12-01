<?php
namespace App\Adapter\RepositoryProvider\Provider;

use App\Adapter\RepositoryProvider\Traits\ProviderableTrait;
use App\Adapter\RepositoryProvider\Contract\HttpInterface;
use App\Adapter\RepositoryProvider\Contract\QueryableInterface;
use App\Adapter\RepositoryProvider\Contract\ScopeableInterface;
use App\Adapter\RepositoryProvider\Contract\PaginatableInterface;
use App\Adapter\RepositoryProvider\Contract\RepositoryProviderInterface;

class GithubProvider implements RepositoryProviderInterface, QueryableInterface, ScopeableInterface, HttpInterface, PaginatableInterface
{
    use ProviderableTrait;

    /**
     * @var		string	$entity
     */
    private $entity;

    /**
     * find.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	self
     */
    public function find(): self
    {
        if (!isset($this->parameters['q'])) {
            $this->parameters['q'] = 'a';
        }

        $this->get();

        return $this;
    }

    /**
     * items.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	array
     */
    public function items(): array
    {
        return $this->getContent()['items'] ?? [];
    }

    /**
     * totalCount.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	int
     */
    public function totalCount(): int
    {
        return $this->getContent()['total_count'] ?? 0;
    }

    /**
     * paginated.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	array
     */
    public function paginated(): array
    {
        return [
            'pagination' => [
                'total_count' => $this->totalCount(), 
            ],
            'data' => $this->items(),
        ];
    }

    /**
     * scopeQuery.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @param	string	$value	
     * @return	self
     */
    public function scopeQuery(string $value): self
    {
        $this->addToParameters('q', $value);

        return $this;
    }

    /**
     * scopeLanguage.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @param	string	$value	
     * @return	self
     */
    public function scopeLanguage(string $value): self
    {
        $parameter = "language:{$value}";

        if (isset($this->parameters['q'])) {
            $parameter = $this->parameters['q'] . " $parameter";
        }

        $this->addToParameters('q', $parameter);

        return $this;
    }

    /**
     * scopeStartDate.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @param	string	$date	
     * @return	self
     */
    public function scopeStartDate(string $date): self
    {
        $parameter = "created:>{$date}";

        if (isset($this->parameters['q'])) {
            $parameter = $this->parameters['q'] . " $parameter";
        }

        $this->addToParameters('q', $parameter);

        return $this;
    }

    /**
     * scopeSort.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @param	string	$value	
     * @return	self
     */
    public function scopeSort(string $value): self
    {
        $this->addToParameters('sort', $value);

        return $this;
    }

    /**
     * scopeOrder.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @param	string	$value	
     * @return	self
     */
    public function scopeOrder(string $value): self
    {
        $this->addToParameters('order', $value);

        return $this;
    }

    /**
     * scopeLimit.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @param	int	$limit	
     * @return	self
     */
    public function scopeLimit(int $limit): self
    {
        $this->addToParameters('per_page', $limit);

        return $this;
    }

    /**
     * setEntity.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @param	string	$entity	
     * @return	self
     */
    public function setEntity(string $entity): self
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * getUrl.
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	string
     */
    public function getUrl(): string
    {
        return $_ENV['GITHUB_PROVIDER_BASE_URL'] . $this->entity;
    }
}