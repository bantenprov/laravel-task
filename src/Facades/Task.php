<?php namespace Bantenprov\Task\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The Task facade.
 *
 * @package Bantenprov\Task
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class Task extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'task';
    }
}
