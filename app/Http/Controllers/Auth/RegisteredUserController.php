<?php

namespace App\Http\Controllers\Auth;

use App\Enums\ProviderEnum;
use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\AIModel;
use App\Models\Client;
use App\Models\Company;
use App\Models\Sale;
use App\Models\Seller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
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
            'company_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'provider'=> ['required', Rule::enum(ProviderEnum::class)],
            'token'=> ['required', 'string', 'max:255'],
            'model' => ['nullable', 'string', 'max:255'],
        ]);
        try {
            DB::beginTransaction();
            $company = Company::create([ 'name' => $request->company_name, 'commission_rate' => 1 ]);
            $user = User::create([
                'role_id' => RoleEnum::MANAGER,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            Seller::create(['company_id' => $company->id, 'user_id' => $user->id]);
            AIModel::create([
                'provider'=> $request->provider,
                'token'=> $request->token,
                'model'=> $request->model ? $request->model : "",
                'user_id' => $user->id
            ]);

            Seller::factory()->count(30)->create(['company_id' => $company->id]);
            Client::factory()->count(30)->create(['company_id' => $company->id]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Problem create new user');
        }


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
