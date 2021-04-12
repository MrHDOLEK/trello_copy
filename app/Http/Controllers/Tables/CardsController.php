<?php

namespace App\Http\Controllers\Tables;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|int|max:255',
            'card_name' => 'required|string|max:255',
            'card_content' => 'required|string|max:255',
        ]);
        $card = new Card();
        $message = $card->createCard($request->id, $request->card_name, $request->card_content, $request->user()->id);
        if (!empty($message)) {
            return response()->json('Card have been successfully created', 200);
        }
        return response()->json(['message' => 'Creation error'], 400);
    }

    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|int|max:255',
            'card_name' => 'required|string|max:255',
            'card_content' => 'required|string|max:255',
        ]);
        $user_id = $request->user()->id;
        $card = new Card();
        $message = $card->updateCard($request->id,$request->card_name,$request->card_content,$user_id);
        if (!empty($message)) {
            return response()->json('Card have been successfully update', 200);
        }
        return response()->json(['message' => 'Update error'], 400);

    }

    public function delete(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|int|max:255',
        ]);
        $user_id = $request->user()->id;
        $card = new Card();
        $message = $card->deleteCard($request->id,$user_id);
        if (!empty($message)) {
            return response()->json('Card have been successfully delete', 200);
        }
        return response()->json(['message' => 'Delete error'], 400);
    }
}
