<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Throwable;

class AuthController extends Controller
{
    // عرض صفحة تسجيل الدخول
    public function login()
    {
        return view('auth.login');
    }

    public function adminLogin()
    {
        return view('auth.admin-login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function account()
    {
        return view('account', ['user' => Auth::user()]);
    }

    public function home()
    {
        return view('web.home', ['user' => Auth::user()]);
    }

    public function registerPost(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:30'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'Student',
            'status' => 'Active',
        ]);

        $request->session()->put('pending_email', $user->email);

        try {
            $this->sendOtpToUser($request, $user, 'verify');
        } catch (Throwable $exception) {
            report($exception);

            return redirect()->route('verification.request')
                ->withErrors(['email' => 'We could not send the verification email. Please check the email settings and try again.']);
        }

        return redirect()->route('verification.code');
    }

    public function showVerificationRequest(Request $request)
    {
        return view('auth.code-request', [
            'purpose' => 'verify',
            'email' => $request->session()->get('pending_email'),
        ]);
    }

    public function showForgotPassword()
    {
        return view('auth.code-request', [
            'purpose' => 'reset',
            'email' => null,
        ]);
    }

    public function sendVerificationCode(Request $request)
    {
        return $this->sendOtp($request, 'verify');
    }

    public function sendPasswordResetCode(Request $request)
    {
        return $this->sendOtp($request, 'reset');
    }

    private function sendOtp(Request $request, string $purpose)
    {
        $validated = $request->validate(['email' => ['required', 'email']]);
        $user = User::where('email', $validated['email'])->first();

        if (! $user) {
            return back()->withErrors(['email' => 'We could not find an account with this email address.'])->withInput();
        }

        if ($purpose === 'verify' && $user->email_verified_at) {
            return redirect()->route('admin.login')->with('success', 'This email address is already verified. Please log in.');
        }

        try {
            $this->sendOtpToUser($request, $user, $purpose);
        } catch (Throwable $exception) {
            report($exception);

            return back()->withErrors(['email' => 'We could not send the verification email. Please try again.'])->withInput();
        }

        return redirect()->route('verification.code');
    }

    private function sendOtpToUser(Request $request, User $user, string $purpose): void
    {
        $code = (string) random_int(1000, 9999);
        $request->session()->put([
            'otp_code' => $code,
            'otp_email' => $user->email,
            'otp_purpose' => $purpose,
            'otp_expires_at' => now()->addMinutes(10)->timestamp,
        ]);

        Mail::raw("Your TCW verification code is {$code}. It expires in 10 minutes.", function ($message) use ($user, $purpose) {
            $message->to($user->email)->subject($purpose === 'verify' ? 'Verify your TCW account' : 'Reset your TCW password');
        });
    }

    public function showOtpForm(Request $request)
    {
        if (! $request->session()->has('otp_email')) {
            return redirect()->route('admin.login');
        }

        return view('auth.otp', [
            'email' => $request->session()->get('otp_email'),
            'purpose' => $request->session()->get('otp_purpose'),
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => ['required', 'array', 'size:4'], 'otp.*' => ['required', 'digits:1']]);
        $code = implode('', $request->input('otp'));

        if (! $request->session()->has('otp_code')
            || now()->timestamp > $request->session()->get('otp_expires_at')
            || ! hash_equals($request->session()->get('otp_code'), $code)) {
            return back()->withErrors(['otp' => 'The verification code is invalid or has expired.']);
        }

        $email = $request->session()->get('otp_email');
        $purpose = $request->session()->get('otp_purpose');
        $request->session()->forget(['otp_code', 'otp_expires_at']);

        if ($purpose === 'verify') {
            User::where('email', $email)->update(['email_verified_at' => now()]);
            $request->session()->forget(['otp_email', 'otp_purpose', 'pending_email']);

            return redirect()->route('admin.login')->with('success', 'Your email has been verified. You can now log in.');
        }

        $request->session()->put('reset_verified_email', $email);
        $request->session()->forget(['otp_email', 'otp_purpose']);

        return redirect()->route('password.reset');
    }

    public function resendOtp(Request $request)
    {
        $email = $request->session()->get('otp_email');
        $purpose = $request->session()->get('otp_purpose');

        if (! $email || ! $purpose) {
            return redirect()->route('admin.login');
        }

        $request->merge(['email' => $email]);

        return $this->sendOtp($request, $purpose);
    }

    public function showResetPassword(Request $request)
    {
        if (! $request->session()->has('reset_verified_email')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate(['password' => ['required', 'confirmed', 'min:8']]);
        $email = $request->session()->get('reset_verified_email');

        if (! $email) {
            return redirect()->route('password.request');
        }

        User::where('email', $email)->update(['password' => Hash::make($request->password)]);
        $request->session()->forget('reset_verified_email');

        return redirect()->route('admin.login')->with('success', 'Your password has been reset. Please log in.');
    }


    // تنفيذ تسجيل الدخول
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        // بيانات الدخول المؤقتة
        $adminEmail = "zyadabdelmaboud@gmail.com";
        $adminPassword = "123456789";

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            if (! Auth::user()->email_verified_at) {
                Auth::logout();
                $request->session()->put('pending_email', $request->email);

                return redirect()->route('verification.request')
                    ->withErrors(['email' => 'Verify your email address before logging in.']);
            }

            $request->session()->regenerate();

            $isAdmin = strcasecmp((string) Auth::user()->role, 'admin') === 0;

            session([
                'user_logged_in' => true,
                'user_name' => Auth::user()->name,
                'user_email' => Auth::user()->email,
            ]);

            if ($isAdmin) {
                $request->session()->put('is_admin', true);

                return redirect()->route('dashboard');
            }

            $request->session()->forget(['admin_logged_in', 'is_admin', 'admin_name', 'admin_email']);

            if (strcasecmp((string) Auth::user()->role, 'Mentor') === 0) {
                return redirect()->route('mentor.dashboard');
            }

            return redirect()->route('user.dashboard');
        }


        if ($request->email == $adminEmail && $request->password == $adminPassword) {

            // حفظ بيانات المستخدم في السيشن
            session([
                'admin_logged_in' => true,
                'is_admin' => true,
                'admin_name' => 'Admin',
                'admin_email' => $adminEmail
            ]);


            return redirect()->route('dashboard');
        }


        return back()->withErrors([
            'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة',
        ]);
    }



    // تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();

        // مسح السيشن
        $request->session()->forget([
            'admin_logged_in',
            'is_admin',
            'admin_name',
            'admin_email',
            'user_logged_in',
            'user_name',
            'user_email'
        ]);


        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect()->route('admin.login');
    }
}
