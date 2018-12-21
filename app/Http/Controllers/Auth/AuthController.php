<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';
	protected $redirectRegisteredTo = '/signupdone';
	protected $redirectToPending = '/pending';
	protected $redirectToBlocked = '/blocked';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
	
	
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

		$this->create($request->all());
        //Auth::guard($this->getGuard())->login($this->create($request->all()));
        return redirect($this->redirectToPending);
		//return redirect()->back()->withInput()->withErrors($validator);
    }	
	
    public function postLogin(Request $request)
    {
        return $this->login($request);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        $throttles = $this->isUsingThrottlesLoginsTrait();
        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);
        if ($attempt=Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
				
            //$gotPermissions =  AccessManager::getPermissions();
              //if(!$gotPermissions){
               //   Auth::logout();
                  //return redirect('/login')->withErrors(['username' =>  'You do not have access to this application.']);
			//	  echo "no access";
			//	  return;
             // }	
			//$status = Auth::guard($this->getGuard())->user()->status;			 
			//echo $status;
			
			//return;
            return $this->handleUserWasAuthenticated($request, $throttles);
		
        }
		
        if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }
		
		//Auth::logout();
		//echo "check";
		
        return $this->sendFailedLoginResponse($request);
    }

    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }
		
		//check if status is pending
		$status=Auth::guard($this->getGuard())->user()->status;
		if($status=="pending"){
			Auth::logout();
			//$msg = Lang::has('auth.pending') ? Lang::get('auth.pending') : 'Account is still pending';
			return redirect()->intended($this->redirectToPending);	
		}else if($status=="block"){
			Auth::logout();
			return redirect()->intended($this->redirectToBlocked);	
		}		
		
        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::guard($this->getGuard())->user());
        }
        return redirect()->intended($this->redirectPath());
    }
	
	
	
    protected function getCredentials(Request $request)
    {
		$request = $request->only($this->loginUsername(), 'password');
		//$request['status'] = 'approve';
		return $request;		
		
    }
	
    public function pending()
    {
        return view('auth.pending');
    }	
    public function signupdone()
    {
        return view('auth.signupdone');
    }	
	
    public function blocked()
    {
        return view('auth.blocked');
    }	
}
