<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManageTablesController extends Controller
{
    public function create(Request $request): Response {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $table = new Table();
        $data = $table->createTable(
            $validated['name'],
            $request->user()->name,
            $request->user()->id
        );

        if (empty($data)) {
            return response(
                'Error occurred',
                400
            );
        }

        return response(
            'Success! Table has been created!',
            200
        );
    }

    public function get(Request $request): Response {
        $table = new Table();
        $data = $table->getTables($request->validate([
            'table_id' => 'integer|max:255'
        ]));

        return response(
            $data,
            200
        );
    }

    public function update(Request $request): Response {
        $validated = $request->validate([
            'id' => 'required|int|max:255',
            'is_visible' => 'int|max:255',
            'name' => 'string|max:255',
            'team_id' => 'int|max:255',
        ]);

        $table = new Table();
        $data = $table->updateTableAsAdmin($validated);

        if (empty($data)) {
            return response(
                'Error occurred',
                400
            );
        }

        return response(
            'Success! Table has been updated!',
            200
        );
    }

    public function delete(Request $request): Response {
        $validated = $request->validate([
            'id' => 'required|int|max:255',
        ]);

        $table = new Table();
        $data = $table->deleteTableAsAdmin($validated['id']);

        if (empty($data)) {
            return response(
                'Error occurred',
                400
            );
        }

        return response(
            'Success! Table has been deleted!',
            200
        );
    }
}
