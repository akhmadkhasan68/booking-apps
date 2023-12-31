<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatusEnum;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Booking::with(['member', 'member.user', 'member.division', 'room'])
            ->orderBy('created_at', 'desc')
            ->simplePaginate(10); // specify the number of items per page

        return view('admin.booking.booking', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = Booking::with(['member', 'member.user', 'member.division', 'room'])->findOrFail($id);

            return view('admin.booking.detail', compact('data'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404);
        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }
    }

    public function approvebooking($id)
    {
        try {
            $data = Booking::findOrFail($id);
            $data->status = BookingStatusEnum::DONE;
            $data->save();

            return redirect()->route('booking')->with('success', 'Booking has been approved!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404);
        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }
    }

    public function approvebookingaction(Request $request)
    {
        $this->validate($request, [
            'attachment' => 'required',
            'id' => 'required',
        ]);

        $data = [];

        //upload image
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $extension = $attachment->getClientOriginalExtension();
            $fileName = time() . rand(0, 100) . "." . $extension;
            $attachment->move(public_path('uploads/file'), $fileName);
            $url = URL::asset('uploads/file/' . $fileName);

            $data['attachment'] = $url;
        }

        try {
            $data['status'] = BookingStatusEnum::DONE;
            $booking = Booking::findOrFail($request->id);
            $booking->update($data);

            return redirect()->route('booking')->with('success', 'Booking has been approved!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404);
        }
    }

    public function cancel($id)
    {
        try {
            $data = Booking::findOrFail($id);
            $data->status = BookingStatusEnum::CANCELED;
            $data->save();

            return redirect()->route('booking')->with('success', 'Booking has been canceled!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404);
        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
