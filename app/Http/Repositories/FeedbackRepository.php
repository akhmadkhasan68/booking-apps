<?php
namespace App\Http\Repositories;

use App\Http\Requests\Feedback\FeedbackRequest;
use App\Models\Feedback;
use App\Models\FeedbackMedia;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class FeedbackRepository {
    public function getAll() {

    }

    public function findOneOrFail(array $where) {
        
    }

    public function create(FeedbackRequest $request) {
        try {
            if(!$request->hasfile('medias')) {
                throw new Exception("Medias not found!", 400);
            }

            DB::beginTransaction();

            $feedbackData = Feedback::create([
                'member_id' => Auth::user()->id,
                'room_id' => $request->room_id,
                'description' => $request->description
            ]);

            $data = [];
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

            DB::commit();

            return $feedbackData;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
