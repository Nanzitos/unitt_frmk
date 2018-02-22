<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
	/**
     * Dashboard de apresentação dos resumos
     *
     * @param  null
     * @return View
     */

    public function getIndex()
    {
        return view('dashboard.dashboard')
            ->with('ConfigFile', $this->getConfigFile())
            ->with('title','Dashboard');
    }
}