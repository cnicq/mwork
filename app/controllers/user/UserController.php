<?php

class UserController extends BaseController {

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * @var UserRepository
     */
    protected $userRepo;

    /**
     * Inject the models.
     * @param User $user
     * @param UserRepository $userRepo
     */
    public function __construct(User $user, UserRepository $userRepo)
    {
        parent::__construct();
        $this->user = $user;
        $this->userRepo = $userRepo;
    }

    /**
     * Users settings page
     *
     * @return View
     */
    public function getIndex()
    {
        list($user,$redirect) = $this->user->checkAuthAndRedirect('user');
        if($redirect){return $redirect;}

        // Show the page
        return View::make('site/user/index', compact('user'));
    }

     /**
     * Get user's profile
     * @param $username
     * @return mixed
     */
    public function getProfile($userId)
    {
        $user = User::find($userId);
        $roles = Role::all();

        // Check if the user exists
        if (is_null($user))
        {
            return App::abort(404);
        }
        $mode = 'read';

        // if user is self, edit mode
        if(Auth::user()->id == $userId)
        {
            $mode = 'edit';
        }

        $kpi = Kpi::where('user_id', '=', $userId)->first();
        if($kpi == null)
        {
            $kpi = new Kpi();
        }
        $tab = 'profile';
        $error = Session::get('error');

        return View::make('mwork/user/info', compact('user', 'tab', 'mode', 'roles', 'kpi', 'error'),$this->Titles('id_user', ''));
    }

     public function postProfile()
    {
        $user = Auth::user();

        $user->email = Input::get('email');
        $user->englishname = Input::get('englishname');
        $user->chinesename = Input::get('chinesename');

        $password = Input::get('password');
        $passwordConfirmation = Input::get('password_confirmation');

        if (!empty($password)) {
            if ($password != $passwordConfirmation) {
                // Redirect to the new user page
                $error = '密码不一致';
                return Redirect::to('/user/profile/'.$user->id)
                    ->with('error', $error);
            } else {
                $user->password = $password;
                $user->password_confirmation = $passwordConfirmation;
            }
        }

        if ($this->userRepo->save($user)) {
            return Redirect::to('/user/profile/'.$user->id)->with('error', '修改成功');
        } else {
            $error = $user->errors()->all(':message');
            return Redirect::to('/user/profile/'.$user->id)
                    ->with('error', $error);
        }
    }

    public function getProject($userId)
    {
        $user = User::find($userId);
        $tab = 'project';

        $projectInfos = Projectinfo::where('auth_id', '=', $userId)
        ->leftjoin('projects', 'projects.id', '=', 'Projectinfos.proj_id')
        ->select('Projectinfos.*','projects.id as proj_id', 'projects.*')->paginate(20);

        return View::make('mwork/user/info', compact('projectInfos', 'tab', 'user'),$this->Titles('id_user', ''));
    }
    public function getKPI($userId, $year = 0, $month = 0)
    {
        if($year == 0)
        {
            $year = date('Y');
            $month = date('m');
        }

        $user = User::find($userId);
        $tab = 'kpi';
        
        $days = cal_days_in_month(CAL_GREGORIAN, intval($month), intval($year));
        $starting_time = strtotime($year . '-' . $month . '-1');
        $ending_time = strtotime($year . '-' . $month . '-' . $days);
        $projInfos = Projectinfo::where('auth_id', '=', $userId)
                    ->whereBetween('created_at', array($starting_time, $ending_time))->select("*")->get();

        $weekday = date("w", $starting_time);
        $kpis = array();
        $types = array('recommend', 'interview', 'comment', 'cv', 'cc', 'day', 'weekday');
        $weekdays = array('日','一','二','三','四','五','六');

        for($i = 1; $i <= $days; $i++)
        {
            $values = array('recommend'=>0, 'interview'=>0, 'comment'=>0, 'cv'=>0, 'cc'=>0, 'day'=>$i, 'weekday'=>'');
            
            $values['weekday'] = $weekdays[$weekday];
            $dayTime = strtotime($year . '-' . $month . '-' . $i);
            
            for($j = 0; $j < count($projInfos); $j++)
            {
                if(date('Ymd', $projInfos[i]['created_at']) == date('Ymd', $dayTime )) 
                {
                    for($k = 0; $k < count($types); ++$k)
                    {
                        if($projInfos[i]['type'] == $types[k])
                        {
                            $values[$types[k]] += 1;
                        }
                    }
                }
                
            }

            if($weekday >= 6 )
            {
                $weekday = 0;
            }
            else
            {
                $weekday += 1;
            }

            $kpis[] = $values;
        }

        return View::make('mwork/user/info', compact('user', 'tab', 'kpis', 'year', 'month'),$this->Titles('id_user', ''));
    }

    /**
     * Stores new user
     *
     */
    public function postIndex()
    {
        $user = $this->userRepo->signup(Input::all());

        if ($user->id) {
            if (Config::get('confide::signup_email')) {
                Mail::queueOn(
                    Config::get('confide::email_queue'),
                    Config::get('confide::email_account_confirmation'),
                    compact('user'),
                    function ($message) use ($user) {
                        $message
                            ->to($user->email, $user->username)
                            ->subject(Lang::get('confide::confide.email.account_confirmation.subject'));
                    }
                );
            }

            return Redirect::to('user/login')
                ->with('success', Lang::get('user/user.user_account_created'));
        } else {
            $error = $user->errors()->all(':message');

            return Redirect::to('user/create')
                ->withInput(Input::except('password'))
                ->with('error', $error);
        }

    }

    /**
     * Edits a user
     * @var User
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(User $user)
    {
        $oldUser = clone $user;

        $user->username = Input::get('username');
        $user->email = Input::get('email');

        $password = Input::get('password');
        $passwordConfirmation = Input::get('password_confirmation');

        if (!empty($password)) {
            if ($password != $passwordConfirmation) {
                // Redirect to the new user page
                $error = Lang::get('admin/users/messages.password_does_not_match');
                return Redirect::to('user')
                    ->with('error', $error);
            } else {
                $user->password = $password;
                $user->password_confirmation = $passwordConfirmation;
            }
        }

        if ($this->userRepo->save($user)) {
            return 'succeed';
        } else {
            $error = $user->errors()->all(':message');
            return $error;
        }

    }

    /**
     * Displays the form for user creation
     *
     */
    public function getCreate()
    {
        return View::make('site/user/create');
    }


    /**
     * Displays the login form
     *
     */
    public function getLogin()
    {
        $user = Auth::user();
        if(!empty($user->id)){
            return Redirect::to('/');
        }

        return View::make('site/user/login');
    }

    /**
     * Attempt to do login
     *
     */
    public function postLogin()
    {

        $repo = App::make('UserRepository');
        $input = Input::all();
        
        if ($this->userRepo->login($input)) {
            return Redirect::intended('/');
        } else {
            if ($this->userRepo->isThrottled($input)) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ($this->userRepo->existsButNotConfirmed($input)) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            return Redirect::to('/')
                ->withInput(Input::except('password'))
                ->with('error', $err_msg);
        }

    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string $code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getConfirm($code)
    {
        if ( Confide::confirm( $code ) )
        {
            return Redirect::to('user/login')
                ->with( 'notice', Lang::get('confide::confide.alerts.confirmation') );
        }
        else
        {
            return Redirect::to('user/login')
                ->with( 'error', Lang::get('confide::confide.alerts.wrong_confirmation') );
        }
    }

    /**
     * Displays the forgot password form
     *
     */
    public function getForgot()
    {
        return View::make('site/user/forgot');
    }

    /**
     * Attempt to reset password with given email
     *
     */
    public function postForgotPassword()
    {
        if (Confide::forgotPassword(Input::get('email'))) {
            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
            return Redirect::to('user/forgot')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
            return Redirect::to('user/login')
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Shows the change password form with the given token
     *
     */
    public function getReset( $token )
    {

        return View::make('site/user/reset')
            ->with('token',$token);
    }


    /**
     * Attempt change password of the user
     *
     */
    public function postReset()
    {

        $input = array(
            'token'                 =>Input::get('token'),
            'password'              =>Input::get('password'),
            'password_confirmation' =>Input::get('password_confirmation'),
        );

        // By passing an array with the token, password and confirmation
        if ($this->userRepo->resetPassword($input)) {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
            return Redirect::to('user/login')
                ->with('notice', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
            return Redirect::to('user/reset', array('token'=>$input['token']))
                ->withInput()
                ->with('error', $error_msg);
        }

    }

    /**
     * Log the user out of the application.
     *
     */
    public function getLogout()
    {
        Confide::logout();

        return Redirect::to('/');
    }

   

    public function getSettings()
    {
        list($user,$redirect) = User::checkAuthAndRedirect('user/settings');
        if($redirect){return $redirect;}

        return View::make('site/user/profile', compact('user'));
    }

    /**
     * Process a dumb redirect.
     * @param $url1
     * @param $url2
     * @param $url3
     * @return string
     */
    public function processRedirect($url1,$url2,$url3)
    {
        $redirect = '';
        if( ! empty( $url1 ) )
        {
            $redirect = $url1;
            $redirect .= (empty($url2)? '' : '/' . $url2);
            $redirect .= (empty($url3)? '' : '/' . $url3);
        }
        return $redirect;
    }
}
