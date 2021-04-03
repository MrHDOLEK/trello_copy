<?php

namespace App\Http\Controllers\Tables;

use App\Http\Controllers\Controller;
use App\Models\Table;

class  TablesController extends Controller
{
    public function showAll()
    {
        $table = new Table();
        dump($table->getPublic());
    }
    public function showPrivate()
    {
        return 0;
    }
    public function create()
    {
        return 0;
    }
    public function update()
    {
        return 0;
    }
    public function delete()
    {
        return 0;
    }
}
