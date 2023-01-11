<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Room;
use App\Models\RoomFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

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
        $facilities = Facility::all();

        return view('admin.room.addroom', compact('create', 'facilities'));
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
            'facility_id'   => 'required',
            'quantity'   => 'required',
            'image'     => 'required|image|mimes:png,jpg,jpeg'
        ]);
    
        //upload image
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $fileName = time().rand(0, 100).".".$extension;
        $image->move(public_path('uploads/images'), $fileName); 
        $url = URL::asset('uploads/images/'.$fileName);
    
        $create = Room::create([
            'name'     => $request->name,
            'floor'   => $request->floor,
            'capacity'   => $request->capacity,
            'image'     => $url,
        ]);

        $facilities = [];
        foreach($request->facility_id as $index => $facility) {
            $facilities[$index]['room_id'] = $create->id;
            $facilities[$index]['facility_id'] = $facility;
            $facilities[$index]['quantity'] = $request->quantity[$index];
        }

        RoomFacility::insert($facilities);
    
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
