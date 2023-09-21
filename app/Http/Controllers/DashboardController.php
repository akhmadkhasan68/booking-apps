<?php

namespace App\Http\Controllers;

use App\Http\Repositories\BookingRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $bookingRepository;

    public function __construct()
    {
        $this->bookingRepository = new BookingRepository();
    }

    function index() {
        $topFiveFrequentlyRoomBooked = $this->bookingRepository->getTopFiveFrequentlyRoomBooked();

        return view('admin/dashboard', compact('topFiveFrequentlyRoomBooked'));
    }
}
