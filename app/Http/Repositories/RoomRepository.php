<?php
namespace App\Http\Repositories;

use App\Enums\BookingStatusEnum;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\Room\SearchAvailableRequest;
use App\Http\Requests\Room\SearchUnavailableRequest;
use App\Models\Room;
use App\Traits\PaginateTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoomRepository {
  use PaginateTrait;

  protected $roomModel;

  public function __construct()
  {
    $this->roomModel = new Room();
  }

  public function paginate(PaginateRequest $request) {
    try {
      $data = $this->roomModel->with(['room_facilities', 'room_facilities.facility']);
  
      return PaginateTrait::make([
          'name',
          'floor',
          'capacity',
      ], $request, $data);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  public function searchAvailable(SearchAvailableRequest $request) {
    try {
      $startDate = $request->start_date;
      $endDate = $request->end_date;

      return $this->getAvailableRoom($startDate, $endDate);
    } catch (\Exception $e) {
      throw $e;
    }
  }
  
  public function searchUnvailable(SearchUnavailableRequest $request) {
    try {
      $search = $request->search ?? null;

      // last 7 days util now
      $startDate = Carbon::now()->subDays(7)->startOfDay();
      $endDate = Carbon::now()->endOfDay();

      return $this->getUnavailableRoom($search, $startDate, $endDate);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  public function schedules(PaginateRequest $request) {
    try {
      $date = Carbon::now();

      $startDate = $date->copy()->startOfDay();
      $endDate = $date->copy()->endOfDay();

      $query = $this->roomModel->with(['room_facilities', 'room_facilities.facility', 'bookings', 'bookings.member'])->whereHas('bookings', function($q) use($startDate, $endDate) {
        return $q->whereBetween('booking_start_date', [$startDate, $endDate])
        ->orWhereBetween('booking_end_date', [$startDate, $endDate]);
      });

      return PaginateTrait::make([
        'name',
        'floor',
        'capacity',
    ], $request, $query);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  public function scheduleDetail($id) {
    try {
      $date = Carbon::now();

      $startDate = $date->copy()->startOfDay();
      $endDate = $date->copy()->endOfDay();

      return $this->roomModel->with(['feedbacks', 'room_facilities', 'room_facilities.facility', 'bookings', 'bookings.member'])->whereHas('bookings', function($q) use($startDate, $endDate) {
        return $q->whereBetween('booking_start_date', [$startDate, $endDate])
        ->orWhereBetween('booking_end_date', [$startDate, $endDate]);
      })->where('id', $id)->firstOrFail();
    } catch(ModelNotFoundException $e) {
      throw new \Exception('Data not found!', 404);
    } catch (\Exception $e) {
      throw $e;
    }
  }

  public function getAvailableRoom($startDate, $endDate) {
    try {
      return $this->roomModel->with(['room_facilities', 'room_facilities.facility'])->whereDoesntHave('bookings', function($q) use($startDate, $endDate) {
        return $q->where(function($sub) use($startDate, $endDate) {
          return $sub->whereBetween('booking_start_date', [$startDate, $endDate])
          ->orWhereBetween('booking_end_date', [$startDate, $endDate]);
        })->where('status', '!=', BookingStatusEnum::CANCELED);
      })->get();
    } catch (\Exception $e) {
      throw $e;
    }
  }
  
  public function getUnavailableRoom($search = null, $startDate, $endDate) {
    try {
      return $this->roomModel->with(['feedbacks', 'room_facilities', 'room_facilities.facility', 'bookings', 'bookings.member'])
        ->whereHas('bookings', function($q) use($search, $startDate, $endDate) {
          return $q->where('description', 'like', "%$search%")
          ->whereBetween('booking_start_date', [$startDate, $endDate])
          ->orWhereBetween('booking_end_date', [$startDate, $endDate]);
      })
      ->when($search, function($q) use($search) {
        return $q->where('name', 'like', "%$search%");
      })
      ->get();
    } catch (\Exception $e) {
      throw $e;
    }
  }

  public function findOneOrFail(array $where) {
    try {
      return $this->roomModel->with(['feedbacks', 'room_facilities', 'room_facilities.facility', 'bookings', 'bookings.member'])->where($where)->firstOrFail();
    } catch(ModelNotFoundException $e) {
      throw new \Exception('Data not found!', 404);
    } catch (\Exception $e) {
      throw $e;
    }
  }
}
