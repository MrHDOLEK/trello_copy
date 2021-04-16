<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class ManageTablesController extends Controller
{
    public function createTable(Request $request){
        $table = new Table([
            'name' => $request->name,
            'users' => json_encode($request->users),
            'creator_id' => $request->creator_id
        ]);

        $table->save();

        return response([
            'message' => 'Success! Table has been created!'
        ]);
    }

    public function getTables(Request $request) {
        if(!empty($request->table_id))
            return Table::findOrFail($request->table_id);

        return Table::all();
    }

    public function updateTable(Request $request) {
        $table = Table::findOrFail($request->table_id);
        $table->update($request->all());

        return response([
            'message' => 'Success! Table has been updated!'
        ]);
    }

    public function deleteTable(Request $request) {
        $table = Table::findOrFail($request->table_id);
        $table->delete();

        return response([
            'message' => 'Success! Table has been deleted!'
        ]);
    }
}
