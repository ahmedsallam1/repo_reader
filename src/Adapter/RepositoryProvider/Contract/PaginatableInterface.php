<?php
namespace App\Adapter\RepositoryProvider\Contract;

interface PaginatableInterface
{
    /**
     * return array of paginated content
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	array
     */
    public function paginated(): array;
}