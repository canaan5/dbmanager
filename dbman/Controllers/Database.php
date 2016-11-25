<?php
namespace DBMAN\Controllers;

use Symfony\Component\HttpFoundation\Request;

/**
 *
 * HomeController
 * @package
 * Date: 11/24/16
 */
class HomeController extends BaseController
{
    public function index()
    {
        return $this->view('index');
    }

    public function store(Request $request)
    {
        return $this->json($request->request->all());
    }
}