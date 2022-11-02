<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    protected $providers = [
        'github','facebook','google','twitter'
    ];


    public function show()
    {
        return view('auth.login');
    }

    public function redirectToProvider($driver)
    {
        if( ! $this->isProviderAllowed($driver) ) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }

        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            // You should show something simple fail message
            return $this->sendFailedResponse($e->getMessage());
        }
    }

    
    public function handleProviderCallback( $driver )
    {

        // dd($driver);
        try {
            $user = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }


        return empty( $user->email )
        ? 
            // $this->sendFailedResponse("No email id returned from {$driver} provider.")
        $this->callbackDefaultEmail($user, $driver)
        : $this->loginOrCreateAccount($user, $driver);
    }

    protected function sendSuccessResponse()
    {
        return redirect()->intended('home');
    }

    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('login')
        ->withErrors(['msg' => $msg ?: 'Unable to login, try with another provider to login.']);
    }

    protected function loginOrCreateAccount($providerUser, $driver)
    {



       $user = User::where('email', $providerUser->getEmail())->first();



       if( $user ) {
        $user->update([
            'avatar' => $providerUser->avatar,
            'provider' => $driver,
            'provider_id' => $providerUser->id,
            'access_token' => $providerUser->token
        ]);
    } else {
      if($providerUser->getEmail()){ 
         $user = User::create([
          'name' => $providerUser->getName(),
          'email' => $providerUser->getEmail(),
          'avatar' => $providerUser->getAvatar(),
          'provider' => $driver,
          'provider_id' => $providerUser->getId(),
          'access_token' => $providerUser->token,
          'password' => '' 
      ]);

     }else{
        
        
     }
 }

 Auth::login($user, true);
 return $this->sendSuccessResponse();
}

private function isProviderAllowed($driver)
{
    return in_array($driver, $this->providers) && config()->has("services.{$driver}");
}



public function callbackDefaultEmail($providerUser, $driver)
{
  try {
     

    $email=$providerUser->getEmail();

    if (!$email) {
        $email="alifitsolutionsaits@gmail.com";
    }
    $saveUser = User::updateOrCreate([
     'provider_id' => $providerUser->getId(),
 ],[
     
    'name' => $providerUser->getName(),
    'email' => $email,
    'avatar' => $providerUser->getAvatar(),
    'provider' => $driver,
    'provider_id' => $providerUser->getId(),
    'access_token' => $providerUser->token,
                  'password' => '' // user can use reset password to create a password


              ]);

    Auth::login($saveUser, true);

    return redirect()->route('home');
} catch (\Throwable $th) {
  throw $th;
}
}




}
