<?php

namespace App\Http\Controllers\Api\Song;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Requests;

// Models
use App\Song;

class FileController extends ApiController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($songid, Request $request)
    {
        //
        $song = Song::findOrFail($songid);
        
        $this->validate($request, [
            'file' => 'required|max:20000|mimes:mp3,m4a',
        ]);
        
        $extension = $request->file->extension();
        
        if (isset($song->url))
            \Storage::delete(str_replace('/storage/', '', $song->url));
        
        $path = $request->file('file')->store('songs');
                
        $song->url = '/storage/'.$path;
        $song->save();
                
        return response()->json(['success' => 'File added!', 'url' => '/storage/'.$path], 200);
    }

}
