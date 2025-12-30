<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\User\updateProfileInterface;
use App\Models\City;
use App\Models\Governorate;
use App\Models\UpdateUser;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

class updateProfileRepository implements updateProfileInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function methodUpdateProfileInterface($validationUpdateProfileRequest, $updateProfileRequest, $profile_id)
    {
        try {

            $user = User::findOrFail($profile_id);

            $user->update([
                'name'  => $validationUpdateProfileRequest['name']  ?? $user->name,
                'email' => $validationUpdateProfileRequest['email'] ?? $user->email,
                'phone' => $validationUpdateProfileRequest['phone'] ?? $user->phone,
            ]);

            $update_user = UpdateUser::where('user_id', $profile_id)->first();
            if ($updateProfileRequest->hasFile('image')) {

                if ($update_user->image && Storage::disk('public')->exists($update_user->image)) {
                    Storage::disk('public')->delete($update_user->image);
                }

                $image = $updateProfileRequest->file('image');
                $name  = uniqid('profile_') . '.' . $image->extension();
                $path  = $image->storeAs('upload/profileImage', $name, 'public');
                $update_user->update(['image' => $path]);
            }
            UpdateUser::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'job_title'  => $validationUpdateProfileRequest['job_title'] ?? null,
                    'image' => $path,
                ]
            );

            $governorate = Governorate::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'name_governorate' => $validationUpdateProfileRequest['name_governorate'] ?? null,
                ]
            );

            City::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'name_city'      => $validationUpdateProfileRequest['city'] ?? null,
                    'governorate_id' => $governorate->id,
                ]
            );

            return __('updateProfile.update_successfully');
        } catch (Exception $e) {
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'data'    => null,
                    'errors'  => $e->getMessage(),
                ], 422)
            );
        }
    }
}
