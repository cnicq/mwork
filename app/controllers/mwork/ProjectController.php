<?php

class ProjectController extends ParentController {

    /**
     * Company Model
     * @var Company
     */
    protected $project;

    /**
     * Inject the models.
     * @param Company $project
     */
    public function __construct(Project $project)
    {
        parent::__construct();

        $this->project = $project;
    }

    /**
     * Show a list of all the projects.
     *
     * @return View
     */
    public function getIndex()
    {
        //$clients = $this->client->paginate(20);

        $projects = Project::leftjoin("clients", 'clients.id', '=', 'projects.client_id')
                ->select('projects.*', 'clients.*')
                ->paginate(20);

        $positions = DB::table('datavalues')->where('type', '=', 'position')->get();
        $citys = DB::table('datavalues')->where('type', '=', 'city')->get();
        
        // Show the page
        return View::make('mwork/project/list', compact('projects', 'positions', 'citys'), $this->Titles('id_project', 'id_project_my'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        $clients = Client::leftjoin('companys', 'clients.company_id', '=', 'companys.id')
            ->select('clients.*', 'companys.*')->get();
       
        $positions = DB::table('datavalues')->where('type', '=', 'position')->get();
        $citys = DB::table('datavalues')->where('type', '=', 'city')->get();
        $users = DB::table('users')->get();
        // Show the page
        return View::make('mwork/project/add', compact('clients', 'positions', 'citys', 'users'), $this->Titles('id_project', 'id_project_manage'));
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
            'englishname'   => 'required|min:2',
            'chinesename' => 'required|min:2'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new blog project
            $user = Auth::user();

            // Update the blog project data
            $this->project->chinesename            = Input::get('chinesename');
            $this->project->content                = Input::get('englishname');
            $this->project->englishname            = Input::get('city');
            $this->project->location               = Input::get('location');
            $this->project->industry               = Input::get('industry');
            $this->project->contract               = Input::get('contract');
            $this->project->user_id                = $user->id;

            // Was the blog project created?
            if($this->project->save())
            {
                // Redirect to the new blog project page
                return Redirect::to('manage/blogs/' . $this->project->id . '/edit')->with('success', Lang::get('manage/blogs/messages.create.success'));
            }

            // Redirect to the blog project create page
            return Redirect::to('manage/blogs/create')->with('error', Lang::get('manage/blogs/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('manage/blogs/create')->withInput()->withErrors($validator);
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $project
     * @return Response
     */
	public function getEdit($project)
	{
        // Title
        $title = Lang::get('manage/blogs/title.blog_update');

        // Show the page
        return View::make('manage/blogs/create_edit', compact('project', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $project
     * @return Response
     */
	public function postEdit($project)
	{

        // Declare the rules for the form validation
        $rules = array(
            'title'   => 'required|min:3',
            'content' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the blog project data
            $project->title            = Input::get('title');
            $project->slug             = Str::slug(Input::get('title'));
            $project->content          = Input::get('content');
            $project->meta_title       = Input::get('meta-title');
            $project->meta_description = Input::get('meta-description');
            $project->meta_keywords    = Input::get('meta-keywords');

            // Was the blog project updated?
            if($project->save())
            {
                // Redirect to the new blog project page
                return Redirect::to('manage/blogs/' . $project->id . '/edit')->with('success', Lang::get('manage/blogs/messages.update.success'));
            }

            // Redirect to the blogs project management page
            return Redirect::to('manage/blogs/' . $project->id . '/edit')->with('error', Lang::get('manage/blogs/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('manage/blogs/' . $project->id . '/edit')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $project
     * @return Response
     */
    public function getDelete($project)
    {
        // Title
        $title = Lang::get('manage/blogs/title.blog_delete');

        // Show the page
        return View::make('manage/blogs/delete', compact('project', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $project
     * @return Response
     */
    public function postDelete($project)
    {
        // Declare the rules for the form validation
        $rules = array(
            'id' => 'required|integer'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $project->id;
            $project->delete();

            // Was the blog project deleted?
            $project = Company::find($id);
            if(empty($project))
            {
                // Redirect to the blog posts management page
                return Redirect::to('manage/blogs')->with('success', Lang::get('manage/blogs/messages.delete.success'));
            }
        }
        // There was a problem deleting the blog project
        return Redirect::to('manage/blogs')->with('error', Lang::get('manage/blogs/messages.delete.error'));
    }

    /**
     * Show a list of all the blog posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $posts = Company::select(array('posts.id', 'posts.title', 'posts.id as comments', 'posts.created_at'));

        return Datatables::of($posts)

        ->edit_column('comments', '{{ DB::table(\'comments\')->where(\'post_id\', \'=\', $id)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'manage/blogs/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'manage/blogs/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

    public function getDatas()
    {
        
    }

}