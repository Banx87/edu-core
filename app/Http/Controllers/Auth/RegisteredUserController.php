<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Fileupload;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    use Fileupload;
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($request->type === 'instructor') {
            $approve_status = 'pending';
            $request->validate(['document' => ['required', 'max:12000', 'mimes:pdf,doc,docx,jpg,png']]);
            $filePath = $this->uploadFile($request->file('document'));
        } elseif ($request->type === 'student') {
            $approve_status = 'approved';
        } else {
            abort(403, 'Invalid user type');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
            'approve_status' => $approve_status,
            'document' => $filePath,
        ]);

        event(new Registered($user));

        Auth::login($user);

        switch ($user->role) {
            case 'instructor':
                return redirect(route('instructor.dashboard', absolute: false));
                break;
            default:
                return redirect(route('student.dashboard', absolute: false));
                break;
        }
    }
}
