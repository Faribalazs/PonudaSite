<?php

namespace App\Http\Controllers\Workerauth;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\UniqueEmail;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('worker.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required','string','email:rfc','max:255', new UniqueEmail],
            'password' => ['required','string','confirmed', Password::min(8)
                ->mixedCase()
                ->numbers()
                // ->uncompromised(10)
            ],
            'phone' => 'nullable|string|max:20|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'cv' => ['nullable','string','max:2048'],
            'user_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
        ]);

        $fileName = null;
        if ($request->hasFile('user_image')) {
            $image = $request->file('user_image');
            $fileName = uniqid().time(). '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(160, 160);
            $img->stream();
            Storage::disk('local')->put('public/workers/avatars/'.$fileName, $img, 'public');
        }

       $user = Worker::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $fileName,
            'phone' => $request->phone,
            'cv' => $request->cv,
        ]);
        $user->attachRole('worker'); 
        event(new Registered($user));
        Auth::guard('worker')->login($user);

        return redirect(route('worker.verification.notice'));
    }
}
