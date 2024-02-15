<?php

namespace App\Http\Controllers\Admin;

use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $current_user = Auth::id();
        $messages = [];

        // Se l'utente è l'amministratore, recupera tutti i messaggi
        if ($current_user == '1') {
            $messages = Message::all();
        } else {
            // Altrimenti, recupera solo i messaggi associati agli appartamenti dell'utente
            $apartments = Apartment::where('user_id', $current_user)->get();
            $apartment_ids = $apartments->pluck('id')->toArray();
             


            $messages = Message::whereIn('apartment_id', $apartment_ids)->orderBy('created_at', 'DESC')->get();
            

            $message_ids = $messages->pluck('apartment_id')->toArray();

            $apartments_with_messages = Apartment::whereIn('id', $message_ids)->get();
        }
        
        return view('admin.messages', compact('messages', 'apartments_with_messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
