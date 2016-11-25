<?php
namespace DBMAN\Controllers;

use Symfony\Component\HttpFoundation\Request;

/**
 *
 * HomeController
 * @package
 * Date: 11/24/16
 */
class Database extends BaseController
{
    public function index()
    {

    }

    /**
     * show databases
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function all()
    {
        return $this->json($this->manager->getDatabases());
    }

    /**
     * show tables of a selected database.
     *
     * @param $database string
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showTables($database)
    {
        return $this->json($this->manager->getTables($database));
    }
}