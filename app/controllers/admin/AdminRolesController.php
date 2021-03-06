<?php

use Prophecy\Util\StringUtil;

class AdminRolesController extends AdminController {


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

    private $util;

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
        $this->util  = new StringUtil();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/roles/title.role_management');

        // Grab all the groups
        $roles = $this->role;

        // Show the page
        return View::make('admin/roles/index', compact('roles', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        // Get all the available permissions
        $permissions = $this->permission->all();

        // Selected permissions
        $selectedPermissions = Input::old('permissions', array());

        // Title
        $title = Lang::get('admin/roles/title.create_a_new_role');
        $mode = "create";
        
        // Show the page
        return View::make('admin/roles/create', 
            compact('permissions', 'selectedPermissions', 'title', 'mode'),
            $this->Titles('id_manage', 'id_manage_role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        // Declare the rules for the form validation
        $rules = array(
            'name' => 'required'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);
        // Check if the form validates with success
        if ($validator->passes())
        {
  	    // Get the inputs, with some exceptions
            $inputs = Input::except('csrf_token');

            $this->role->name = $inputs['name'];
            $r = $this->role->save();
            $ps = $this->permission->preparePermissionsForSave($inputs['permissions']);
            
            // Save permissions
            $this->role->perms()->sync($ps);
            
            // Was the role created?
            if ($this->role->id)
            {
                // Redirect to the new role page
                return "done";
            }

            // Redirect to the new role page
            return Lang::get('admin/roles/messages.create.error');

            // Redirect to the role create page
            return Lang::get('admin/roles/messages.' . $error);
        }

        // Form validation failed
        return "error";
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function getShow($id)
    {
        // redirect to the frontend
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $role
     * @return Response
     */
    public function getEdit($role)
    {
        if(! empty($role))
        {
            $permissions = $this->permission->preparePermissionsForDisplay($role->perms()->get());
        }
        else
        {
            // Redirect to the roles management page
            return Redirect::to('admin/roles')->with('error', Lang::get('admin/roles/messages.does_not_exist'));
        }

        // Title
        $title = Lang::get('admin/roles/title.role_update');

        $mode = "edit";

        // Show the page
        return View::make('admin/roles/edit', compact('role', 'permissions', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $role
     * @return Response
     */
    public function postEdit($role)
    {

        // Declare the rules for the form validation
        $rules = array(
            'name' => 'required'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $mode = Input::get('role_mode_val');

            if($mode == 'create'){
                return $this->postCreate($role);
            }

            // Update the role data
            $role->name        = Input::get('name');
            $role->perms()->sync($this->permission->preparePermissionsForSave(Input::get('permissions')));
            //return Input::get('permissions');
            // Was the role updated?
            if ($role->save())
            {
                // Redirect to the role page
                return Lang::get('admin/roles/messages.update.success');
            }
            else
            {

                // Redirect to the role page
                return Lang::get('admin/roles/messages.update.error');
            }
        }

        // Form validation failed
        return json_encode($validator);
    }


    /**
     * Remove user page.
     *
     * @param $role
     * @return Response
     */
    public function getDelete($role)
    {
        // Was the role deleted?
        if($role->delete()) {
            // Redirect to the role management page
            return "done";
        }

        // There was a problem deleting the role
        return "error";
    }

    /**
     * Remove the specified user from storage.
     *
     * @param $role
     * @internal param $id
     * @return Response
     */
    public function postDelete($role)
    {
        return View::make('admin/roles/delete', compact('role', 'title'));
        // Was the role deleted?
        if($role->delete()) {
            // Redirect to the role management page
            return $this->getData();
        }

        // There was a problem deleting the role
        return $this->getData();
    }

    /**
     * Show a list of all the roles formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getDatas()
    {
        $roles = Role::select(array('roles.id',  'roles.name', 'roles.id as users', 'roles.created_at'));

        return Datatables::of($roles)
        // ->edit_column('created_at','{{{ Carbon::now()->diffForHumans(Carbon::createFromFormat(\'Y-m-d H\', $test)) }}}')
        ->edit_column('users', '{{{ DB::table(\'assigned_roles\')->where(\'role_id\', \'=\', $id)->count()  }}}')
        ->add_column('actions', '<a href="#" onClick="editRole({{{$id}}})" class="iframe btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>
                                 <a href="#" onClick="deleteRole({{{$id}}})" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>')

        ->remove_column('id')

        ->make();
    }

    public function getData($id)
    {
         $name = DB::table('roles')->where('id','=',$id)->pluck('name');
         $permissionIds = DB::table('permission_role')->where('role_id','=',$id)->lists('permission_id');
         $mode = "edit";
         return Response::json(compact('name', 'permissionIds', 'mode'));
    }
}
