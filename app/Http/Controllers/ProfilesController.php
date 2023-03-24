<?php

namespace App\Http\Controllers;

use App\Models\User;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;   
  
class ProfilesController extends Controller   
{
    public function index(User $user)
    {  
        return view('profiles.index', compact('user'));    
        
    }

        public function edit(User $user)
        {
            $this->authorize('update', $user->profile);

            return view('profiles.edit', compact('user'));

        }

        public function update(User $user)
        {
            $this->authorize('update', $user->profile);

            $data = request()->validate([
                'title' => 'required',
                'description' => 'required',
                'url' => 'url',
                'image' => '',  

            ]);

            if (request('image')){
                $imagePath = (request('image')->store('uploads', 'public'));

                // dd(request('image')->store('uploads', 'public'));

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(800, 800);
        $image->save();

            }

            auth()->user()->profile->update(array_merge($data, [
                'image' => $imagePath,
            ]));

            return redirect("/profile/{$user->id}");
        }
        
}
