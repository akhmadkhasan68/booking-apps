<?php
namespace App\Http\Repositories;

use App\Http\Requests\Feedback\FeedbackRequest;
use App\Http\Requests\PaginateRequest;
use App\Models\Feedback;
use App\Models\FeedbackMedia;
use App\Traits\PaginateTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class FeedbackRepository {
    use PaginateTrait;
    
    public function findOneOrFail(array $where) {
        try {
            return Feedback::with(['medias', 'member', 'room'])->where($where)->firstOrFail();
        } catch(ModelNotFoundException $e) {
            throw new Exception("Data not found!", 404);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function feedbacksPaginate(PaginateRequest $request) {
        try {
            $roomId = $request->room_id;

            $query = Feedback::with(['medias', 'member', 'room'])->when($roomId, function($q) use($roomId) {
                $q->where('room_id', $roomId);
            });

            return PaginateTrait::make([
                'description',
            ], $request, $query);
        } catch(ModelNotFoundException $e) {
            throw new Exception("Data not found!", 404);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function create(FeedbackRequest $request) {
        try {
            DB::beginTransaction();

            $feedbackData = Feedback::create([
                'member_id' => Auth::user()->member->id,
                'room_id' => $request->room_id,
                'description' => $request->description
            ]);

            $data = [];
            // check if request medias is not empty
            if($request->hasfile('medias') && $request->file('medias') != null) {
                foreach($request->file('medias') as $key => $media)
                {
                    $extension = $media->getClientOriginalExtension();
                    $fileName = time().rand(0, 100).".".$extension;
                    $media->move(public_path('uploads/images'), $fileName); 
                    $url = URL::asset('uploads/images/'.$fileName);

                    $data[$key]['feedback_id'] = $feedbackData->id;
                    $data[$key]['attachment'] = $url;
                }

                FeedbackMedia::insert($data);
            }

            DB::commit();

            return $feedbackData;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
