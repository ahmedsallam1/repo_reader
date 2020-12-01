<?php
namespace App\Adapter\RepositoryProvider\Contract;

interface QueryableInterface
{
    /**
     * Send Http get request
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	self
     */
    public function find(): self;

    /**
     * return array of response data
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @return	array
     */
    public function items(): array;
}