<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request)
    {   

        
            // $request = request();
   
            // $new_visit = new Visit();
            // $new_visit->ip_address = $request->IPAddress;
            // $new_visit->date = $request->date;
            // $new_visit->apartment_id = $request->apartmentID;
            // $new_visit->save();
   
        //    return response()->json([
        //        'success' => true
        //    ]);
        // $data = $request->validate([
        //     'subject' => 'required|max:40',
        //     'content' => 'required|max:500',
        //     'sender' => 'required|max:40',
        //     'email' => 'required|max:40'
        // ]);

        $data = $request->validated();

        $new_message = new Message();
        // $new_message->apartment_id = $data['apartment_id'];
        // $new_message->subject = $data['subject'];
        // $new_message->content = $data['content'];
        // $new_message->sender = $data['sender'];
        // $new_message->email = $data['email'];
        $new_message->fill($data);
        $new_message->save();

        // Message::create($query);

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function storeMessage(StoreMessageRequest $request)
    {
        $new_message = new Message();
        $new_message->apartment_id = $request->apartment_id;
        $new_message->subject = $request->subject;
        $new_message->content = $request->message;
        $new_message->sender = $request->sender;
        $new_message->email = $request->email;
        $new_message->save();

        return response()->json([
            'success' => true
        ]);
    }
}
