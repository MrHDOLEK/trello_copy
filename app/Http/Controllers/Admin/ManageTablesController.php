<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class ManageTablesController extends Controller
{
    public function create(Request $request){
        $table = new Table([
            'name' => $request->name,
            'users' => json_encode($request->users),
            'creator_id' => $request->creator_id
        ]);

        $table->save();

        return response([
            'message' => 'Success! Table has been created!',
            200
        ]);
    }

    public function get(Request $request) {
        if(!empty($request->table_id))
            return Table::findOrFail($request->table_id);

        return Table::all();
    }

    public function update(Request $request) {
        $table = Table::findOrFail($request->table_id);
        $table->update($request->all());

        return response([
            'message' => 'Success! Table has been updated!',
            200
        ]);
    }

    public function delete(Request $request) {
        $table = Table::findOrFail($request->table_id);
        $table->delete();

        return response([
            'message' => 'Success! Table has been deleted!',
            200
        ]);
    }
}
