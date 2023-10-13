<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Room;
use App\Models\RoomFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'floor'   => 'required',
            'capacity'   => 'required',
            'facility_id'   => 'required',
            'quantity'   => 'required',
            'image'     => 'required|image|mimes:png,jpg,jpeg'
        ]);

        if($validator->fails()) {
            // return json
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ], 400);
        }
    
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

        try {
            RoomFacility::insert($facilities);

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Disimpan!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Disimpan!'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datas = Room::find($id);
        $facilities = Facility::all();
        // $roomfacility = RoomFacility::all();
        return view('admin.room.editfacility', compact('datas', 'facilities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'floor'   => 'required',
            'capacity'   => 'required',
            'facility_id'   => 'required',
            'quantity'   => 'required',
            'image'     => 'image|mimes:png,jpg,jpeg'
        ]);

        if($validator->fails()) {
            // return json
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ], 400);
        }

        try {
            DB::beginTransaction();
            
            $data = [];

            //upload image
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $fileName = time().rand(0, 100).".".$extension;
                $image->move(public_path('uploads/images'), $fileName); 
                $url = URL::asset('uploads/images/'.$fileName);

                $data['image'] = $url;
            }
        
            $data['name'] = $request->name;
            $data['floor'] = $request->floor;
            $data['capacity'] = $request->capacity;

            Room::where('id', $id)->update($data);

            //deleted room facility
            RoomFacility::where('room_id', $id)->whereNotIn('facility_id', $request->facility_id)->delete();

            //update or create room facility
            foreach($request->facility_id as $index => $facility) {
                RoomFacility::updateOrCreate([
                    'room_id' => $id,
                    'facility_id' => $facility
                ], [
                    'room_id' => $id,
                    'facility_id' => $facility,
                    'quantity' => $request->quantity[$index]
                ]);
            }
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Disimpan!'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Disimpan!'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datas = Room::findOrFail($id);
        $datas->delete();

    if($datas){
        //redirect dengan pesan sukses
        return redirect()->route('room')->with(['success' => 'Data Berhasil Dihapus!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('room')->with(['error' => 'Data Gagal Dihapus!']);
    }
    }
}
