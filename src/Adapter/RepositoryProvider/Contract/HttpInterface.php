<?php
namespace App\Adapter\RepositoryProvider\Contract;

interface HttpInterface
{
    /**
     * return request url
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	void
     */
    public function getUrl(): string;
}