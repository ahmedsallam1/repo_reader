<?php
namespace App\Adapter\RepositoryProvider\Contract;

interface ScopeableInterface
{
    /**
     * Add query to parameters
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @param	string	$value	
     * @return	self
     */
    public function scopeQuery(string $value): self;

    /**
     * Add language to parameters
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @param	string	$value	
     * @return	self
     */
    public function scopeLanguage(string $value): self;

    /**
     * Add sort to parameters
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @param	string	$value	
     * @return	self
     */
    public function scopeSort(string $value): self;

    /**
     * Add order to parameters
     *
     * @author	Ahmed
     * @since	v0.0.1
     * @version	v1.0.0	Tuesday, December 1st, 2020.
     * @access	public
     * @param	string	$value	
     * @return	self
     */
    public function scopeOrder(string $value): self;
}