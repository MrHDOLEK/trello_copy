<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Packet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManagePacketsController extends Controller
{
    public function create(Request $request): Response {
        $packet = new Packet();
        $packet->createPacket($request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|between:0,999.99',
            'description' => 'string',
            'permission_id' => 'required|integer|max:255'
        ]));

        return response(
            'Success! Packet has been created!',
            200
        );
    }

    public function get(Request $request): Response {
        $packet = new Packet();
        $data = $packet->getPackets($request->validate([
            'packet_id' => 'integer|max:255'
        ]));

        return response(
            $data,
            200
        );
    }

    public function update(Request $request): Response {
        $packet = new Packet();
        $packet->updatePacket($request->validate([
            'packet_id' => 'required|integer|max:255',
            'name' => 'string|max:255',
            'price' => 'float',
            'description' => 'string',
            'permission_id' => 'integer|max:255'
        ]));

        return response(
            'Success! Packet has been updated!',
            200
        );
    }

    public function delete(Request $request): Response {
        $packet = new Packet();
        $packet->deletePacket($request->validate([
            'packet_id' => 'required|integer|max:255'
        ]));

        return response(
            'Success! Packet has been deleted!',
            200
        );
    }
}
