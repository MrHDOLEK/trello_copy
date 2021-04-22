<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Packet;
use Illuminate\Http\Request;

class ManagePacketsController extends Controller
{
    public function create(Request $request) {
        $packet = new Packet([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'permission_id' => $request->permission_id
        ]);

        $packet->save();

        return response([
            'message' => 'Success! Packet has been created!',
            200
        ]);
    }

    public function get(Request $request) {
        if(!empty($request->packet_id))
            return Packet::findOrFail($request->packet_id);

        return Packet::all();
    }

    public function update(Request $request) {
        $packet = Packet::findOrFail($request->packet_id);
        $packet->update($request->all());

        return response([
            'message' => 'Success! Packet has been updated!',
            200
        ]);
    }

    public function delete(Request $request) {
        $packet = Packet::findOrFail($request->packet_id);
        $packet->delete();

        return response([
            'message' => 'Success! Packet has been deleted!',
            200
        ]);
    }
}
