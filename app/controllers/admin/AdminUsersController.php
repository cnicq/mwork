<?php

class AdminUsersController extends AdminController {


    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Role Model
     * @var Role
     */
    protected $role;

    /**
     * Permission Model
     * @var Permission
     */
    protected $permission;

    /**
     * Inject the models.
     * @param User $user
     * @param Role $role
     * @param Permission $permission
     */
    public function __construct(User $user, Role $role, Permission $permission)
    {
        parent::__construct();
        $this->user = $user;
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/users/title.user_management');

        // Grab all the users
        $users = $this->user;

        // Show the page
        return View::make('admin/users/index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {

        // All roles
        $roles = $this->role->all();

        // Get all the available permissions
        $permissions = $this->permission->all();

        // Selected groups
        $selectedRoles = Input::old('roles', array());

        // Selected permissions
        $selectedPermissions = Input::old('permissions', array());

		// Title
		$title = Lang::get('admin/users/title.create_a_new_user');

		// Mode
		$mode = 'create';

		// Show the page
		return View::make('mwork/manage/user', 
            compact('users', 'roles', 'permissions', 'selectedRoles', 'selectedPermissions', 'title', 'mode'),
            $this->Titles('id_manage', 'id_manage_user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $this->user->username = Input::get( 'username' );
        $this->user->email = Input::get( 'email' );
        $this->user->password = Input::get( 'password' );
        $this->user->englishname = Input::get( 'englishname' );
        $this->user->chinesename = Input::get( 'chinesename' );

        // The password confirmation will be removed from model
        // before saving. This field will be used in Ardent's
        // auto validation.
        $this->user->password_confirmation = Input::get( 'password_confirmation' );

        // Generate a random confirmation code
        $this->user->confirmation_code = md5(uniqid(mt_rand(), true));

        $this->user->confirmed = true;
        if (Input::get('confirm')) {
            //$this->user->confirmed = Input::get('confirm');
        }

        // Save if valid. Password field will be hashed before save
        $this->user->save();
       
        if ( $this->user->id ) {
            // Save roles. Handles updating.
            $this->user->saveRoles(Input::get( 'roles' ));
            /*
            if (Config::get('confide::signup_email')) {
                $user = $this->user;
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
            */
            $this->saveKPI($this->user);

            return "";

        } else {

            // Get validation errors (see Ardent package)
            $error = $this->user->errors()->all();
            return json_encode($error);
        }
    }

    public function saveKPI($user)
    {
        // save kpi
        $kpi = Kpi::where('user_id', '=', $user->id)->first();
        if($kpi == null)
        {
            $kpi = new Kpi();
        }
        
        $recommend = Input::get('recommend');
        $resume = Input::get('resume');
        $coldcall = Input::get('coldcall');
        $note = Input::get('note');
        $kpi->recommend = $recommend == '' ? 0 : $recommend;
        $kpi->resume = $resume == '' ? 0 : $resume;
        $kpi->coldcall = $coldcall == '' ? 0 : $coldcall;
        $kpi->note = $note == '' ? 0 : $note;
        $kpi->user_id = $user->id;

        $kpi->save();
    }

    /**
     * Display the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function getShow($user)
    {
        // redirect to the frontend
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function getEdit($user)
    {
        if ( $user->id )
        {
            $roles = $this->role->all();

            // Title
        	$title = Lang::get('admin/users/title.user_update');
        	// mode
        	$mode = 'edit';

        	return View::make('admin/users/create_edit', compact('user', 'roles', 'title', 'mode'));
        }
        else
        {
            return Redirect::to('admin/users')->with('error', Lang::get('admin/users/messages.does_not_exist'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @return Response
     */
    public function postEdit($user)
    {
        $oldUser = clone $user;
        $user->username = Input::get( 'username' );
        $user->email = Input::get( 'email' );
        $user->englishname = Input::get( 'englishname' );
        $user->chinesename = Input::get( 'chinesename' );
        $user->confirmed = Input::get( 'confirm' );

        $password = Input::get( 'password' );
        $passwordConfirmation = Input::get( 'password_confirmation' );

        if(!empty($password)) {
            if($password === $passwordConfirmation) {
                $user->password = $password;
                // The password confirmation will be removed from model
                // before saving. This field will be used in Ardent's
                // auto validation.
                $user->password_confirmation = $passwordConfirmation;
            } else {
                // Redirect to the new user page
                return Redirect::to('admin/users/' . $user->id . '/edit')->with('error', Lang::get('admin/users/messages.password_does_not_match'));
            }
        }
            
        if($user->confirmed == null) {
            $user->confirmed = $oldUser->confirmed;
        }

        if ($user->save()) {
            // Save roles. Handles updating.
            $user->saveRoles(Input::get( 'roles' ));
        } else {
            return Lang::get('admin/users/messages.edit.error');
        }

        // Get validation errors (see Ardent package)
        $error = $user->errors()->all();

        if(empty($error)) {

             $this->saveKPI($user);
            // Redirect to the new user page
            return Lang::get('admin/users/messages.edit.success');
        } else {
            return Redirect::to('admin/users/' . $user->id . '/edit')->with('error', Lang::get('admin/users/messages.edit.error'));
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @param $user
     * @return Response
     */
    public function getDelete($user)
    {
        return "TODO";

        // Check if we are not trying to delete ourselves
        if ($user->id === Confide::user()->id)
        {
            return Lang::get('admin/users/messages.delete.impossible');
        }

        AssignedRoles::where('user_id', $user->id)->delete();

        $id = $user->id;
        $user->delete();

        // Was the comment post deleted?
        $user = User::find($id);
        if ( empty($user) )
        {
            // TODO needs to delete all of that user's content
            return Lang::get('admin/users/messages.delete.success');
        }
        else
        {
            // There was a problem deleting the user
            return Redirect::to('admin/users')->with('error', Lang::get('admin/users/messages.delete.error'));
        }
    }

    public function getData($id)
    {
        $user = User::find($id);
        $userData = DB::table('users')->where('id','=',$id)->first();
        $kpi = Kpi::where('user_id', '=', $id)->first();
        $roles = $user->currentRoleIds();
        return compact('userData', 'roles', 'kpi');
    }

    /**
     * Show a list of all the users formatted for Datatables.
     *
     * @return Datatables JSON
     */
    /*
    public function getData()
    {
        $users = User::leftjoin('assigned_roles', 'assigned_roles.user_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'assigned_roles.role_id')
                    ->select(array('users.id', 'users.username','users.email', 'roles.name as rolename', 'users.confirmed', 'users.created_at'));

        return Datatables::of($users)

        ->edit_column('confirmed','@if($confirmed)
                            Yes
                        @else
                            No
                        @endif')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/users/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>
                                @if($username == \'admin\')
                                @else
                                    <a href="{{{ URL::to(\'admin/users/\' . $id . \'/delete\' ) }}}" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
                                @endif
            ')

        ->remove_column('id')

        ->make();
    }
    */

     /**
     * Show a list of all the roles formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getDatas()
    {
        $users = User::select(array('users.username', 'users.id'));

        return Datatables::of($users)
        ->add_column('actions', '<a href="#" onClick="editUser({{{$id}}})" class="iframe btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>')

        ->remove_column('id')

        ->make();
    }
}
