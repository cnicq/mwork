<?php

class TeamController extends ParentController {
    /**
     * Team Model
     * @var Team
     */
    protected $team;

    /**
     * Inject the models.
     * @param Team $team
     */
    public function __construct(Team $team)
    {
        parent::__construct();

        $this->team = $team;
        $this->bigTitle = 'id_team';
    }

    public function getManage()
    {
        $teams = $this->team->orderBy('updated_at', 'DESC')->paginate(20);

        // Show the page
        return View::make('mwork/manage/team', compact('teams'), $this->Titles('id_manage', 'id_manage_team'));
    }
    /**
     * Show a list of all the teams.
     *
     * @return View
     */
    public function getIndex()
    {
        $teams = $this->team->orderBy('updated_at', 'DESC')->paginate(20);

        // Show the page
        return View::make('mwork/team/list', compact('teams'), $this->Titles());
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('mwork/team.add');

        // Show the page
        return View::make('mwork/team', compact('title'));
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
            // Create a new blog team
            $user = Auth::user();

            // Update the blog team data
            $this->team->chinesename            = Input::get('chinesename');
            $this->team->content                = Input::get('englishname');
            $this->team->englishname            = Input::get('city');
            $this->team->location               = Input::get('location');
            $this->team->industry               = Input::get('industry');
            $this->team->contract               = Input::get('contract');
            $this->team->user_id                = $user->id;

            // Was the blog team created?
            if($this->team->save())
            {
                // Redirect to the new blog team page
                return Redirect::to('manage/blogs/' . $this->team->id . '/edit')->with('success', Lang::get('manage/blogs/messages.create.success'));
            }

            // Redirect to the blog team create page
            return Redirect::to('manage/blogs/create')->with('error', Lang::get('manage/blogs/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('manage/blogs/create')->withInput()->withErrors($validator);
	}

    /**
     * Display the specified resource.
     *
     * @param $team
     * @return Response
     */
	public function getShow($team)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $team
     * @return Response
     */
	public function getEdit($team)
	{
        // Title
        $title = Lang::get('manage/blogs/title.blog_update');

        // Show the page
        return View::make('manage/blogs/create_edit', compact('team', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $team
     * @return Response
     */
	public function postEdit($team)
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
            // Update the blog team data
            $team->title            = Input::get('title');
            $team->slug             = Str::slug(Input::get('title'));
            $team->content          = Input::get('content');
            $team->meta_title       = Input::get('meta-title');
            $team->meta_description = Input::get('meta-description');
            $team->meta_keywords    = Input::get('meta-keywords');

            // Was the blog team updated?
            if($team->save())
            {
                // Redirect to the new blog team page
                return Redirect::to('manage/blogs/' . $team->id . '/edit')->with('success', Lang::get('manage/blogs/messages.update.success'));
            }

            // Redirect to the blogs team management page
            return Redirect::to('manage/blogs/' . $team->id . '/edit')->with('error', Lang::get('manage/blogs/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('manage/blogs/' . $team->id . '/edit')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $team
     * @return Response
     */
    public function getDelete($team)
    {
        // Title
        $title = Lang::get('manage/blogs/title.blog_delete');

        // Show the page
        return View::make('manage/blogs/delete', compact('team', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $team
     * @return Response
     */
    public function postDelete($team)
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
            $id = $team->id;
            $team->delete();

            // Was the blog team deleted?
            $team = Team::find($id);
            if(empty($team))
            {
                // Redirect to the blog posts management page
                return Redirect::to('manage/blogs')->with('success', Lang::get('manage/blogs/messages.delete.success'));
            }
        }
        // There was a problem deleting the blog team
        return Redirect::to('manage/blogs')->with('error', Lang::get('manage/blogs/messages.delete.error'));
    }

    /**
     * Show a list of all the blog posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $posts = Team::select(array('posts.id', 'posts.title', 'posts.id as comments', 'posts.created_at'));

        return Datatables::of($posts)

        ->edit_column('comments', '{{ DB::table(\'comments\')->where(\'post_id\', \'=\', $id)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'manage/blogs/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'manage/blogs/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}