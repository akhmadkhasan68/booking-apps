<?php
namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use App\Http\Requests\Auth\UpdatePhotoProfileRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class UserService {
    protected $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function updatePhotoProfile(UpdatePhotoProfileRequest $request) {
        try {
            if(!$request->hasfile('photo')) {
                throw new Exception("Photo not found!", 400);
            }

            DB::beginTransaction();

            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension();
            $fileName = time().rand(0, 100).".".$extension;
            $photo->move(public_path('uploads/images'), $fileName); 
            $url = URL::asset('uploads/images/'.$fileName);

            // $data[$key]['attachment'] = $url;
            $data['photo'] = $url;

            $update = $this->userRepository->update([
                'id' => auth()->user()->id,
            ], $data);

            DB::commit();

            return $update;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
