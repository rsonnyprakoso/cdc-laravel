<?php

namespace App\Http\Controllers\Api\Playlist;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Requests;

// Models
use App\Song;

class SongController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($playlistId)
    {
        //

        $playlist = Playlist::findOrFail($playlistId);
        $songs = $playlist->songs;
        // return to the edit views
        return response()->json($songs, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($playlistId, Request $request)
    {
        //
        $playlist = Playlist::findOrFail($playlistId);
        $playlist->songs()->attach($request->id);
        $playlist->save();

        return $this->sendMessage('Song added!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($playlistId, $songId)
    {
      //
      $playlist = Playlist::findOrFail($playlistId);
      $playlist->songs()->detach($songId);
      $playlist->save();

      return $this->sendMessage('Song deleted!');
    }


}
