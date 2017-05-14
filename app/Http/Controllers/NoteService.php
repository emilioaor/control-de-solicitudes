<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Note;
use Auth;

class NoteService extends MainController
{

    public function getNotes() {

        if ($this->isAdmin()) {
            $notes = Note::orderBy('id','DESC')->limit(5)->get();
        } elseif ($this->isUser()) {
            $notes = Note::orderBy('id','DESC')->where('user_id',Auth::user()->id)->orWhere('to_user',Auth::user()->id)->limit(5)->get();
        }


        if (!$this->hasResults($notes)) {
            return 'Ninguna actividad registrada';
        }

        return $notes;
    }
}
