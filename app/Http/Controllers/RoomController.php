<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = Room::all();
        return view('admin.room.room', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $create = new Room;
        return view('admin.room.addroom', compact('create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required',
            'floor'   => 'required',
            'capacity'   => 'required',
            'facility'   => 'required',
            'image'     => 'required|image|mimes:png,jpg,jpeg'
        ]);
    
        //upload image
        $image = $request->file('image');
        
        $extension = $image->getClientOriginalExtension();
        $fileName = time().rand(0, 100).".".$extension;
        // $image->move(public_path('uploads/images'), $fileName);
        $image->storeAs('public/img', $image());
    
        $create = Room::create([
            'name'     => $request->name,
            'floor'   => $request->floor,
            'capacity'   => $request->capacity,
            'facility'   => $request->facility,
            'image'     => $image->hashName(),
        ]);
    
        if($create){
            //redirect dengan pesan sukses
            return redirect()->route('room')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('addroom')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return view('room.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('room.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required',
            'floor' => 'required',
            'capacity' => 'required',
        ]);

        $room->update($request->all());

        return redirect()->route('room.index')->with('succes','Siswa Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('room.index')->with('succes','room Berhasil di Hapus');
    }
}
