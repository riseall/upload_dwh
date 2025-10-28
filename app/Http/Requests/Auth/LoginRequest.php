<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use App\Rules\ReCaptcha;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['required', 'string', 'exists:users_dwh,username'],
            'password' => ['required', 'string'],
            'g-recaptcha-response' => ['required', new ReCaptcha],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        $user = User::where('username', $this->username)->first();

        if (! $user) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => trans('auth.failed'),
            ]);
        }

        $inputPassword = $this->password;
        $isValid = false;

        // cek pakai bcrypt
        if ($user->password && Hash::check($inputPassword, $user->password)) {
            $isValid = true;
        }
        // cek pakai MD5
        elseif ($user->password && md5($inputPassword) === $user->password) {
            $isValid = true;

            // update ke bcrypt
            $user->password = Hash::make($inputPassword);
            $user->save();
        }

        if (! $isValid) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => trans('auth.failed'),
            ]);
        }

        // cek status akun
        if (! $user->is_active) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => trans('auth.inactive'),
            ]);
        }

        Auth::login($user, $this->boolean('remember'));

        // Cek apakah user sudah punya role
        if (! $user->roles()->exists()) {

            $defaultRole = 'mi';

            // pastikan role tersebut sudah ada di DB
            if (!Role::where('name', $defaultRole)->exists()) {
                Role::create(['name' => $defaultRole]);
            }

            // assign role default
            $user->assignRole($defaultRole);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('username')) . '|' . $this->ip();
    }
}
