<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
// use Symfony\Component\Intl\Locales;

class ProfileController extends Controller
{
    public function edit(){
        $user= Auth::user();
        $countries= Countries::getNames();
        $locales= Languages::getNames();
       // $profile= Profile::where('user_id', $user->id)->get();
        return view('back.profile.edit', compact('user','countries','locales'));
    }

    public function update(Request $request){
        $data=  $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'birthday' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female',
            'country' => 'required|string|size:2'
        ]);

        $user= $request->user();

       // $user->profile->fill($request->all())->save();

       $profile= $user->profile;

       $old_image= $profile->image;

       if($request->hasFile('image')){
        $image= $request->file('image');
        $path= $image->store('admins', 'uploads');
        $data['image']= $path;
       }

        if($profile->first_name){
            $profile->update($data);
        }else{
            $user->profile()->create($data);
            // $data['user_id']=$user->id;
            // Profile::create($data);
        }

        if($old_image && isset($data['image'])){
            Storage::disk('uploads')->delete($old_image);
        }
    
    return redirect()->route('dashboard.profile.edit')->with('success', 'profile-updated successfully!');

    }
}
