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
        $teams = $this->team->paginate(20);
       

        // Show the page
        return View::make('mwork/manage/team', compact('teams'), $this->Titles('id_team', 'id_team_my'));
    }
    /**
     * Show a list of all the teams.
     *
     * @return View
     */
    public function getIndex()
    {
        //$teams = $this->team->paginate(20);
        
        $teams = DB::table('teams')->leftjoin(DB::raw('(select COUNT(*) as cnt, team_id from projects) p'), 'teams.id', '=', 'p.team_id')
                    ->select('teams.id', 'teams.name', 'teams.lead_name', 'teams.member_names', DB::raw('IFNULL(p.cnt, 0) as project_count'))
                    ->paginate(10, array(''));
       
        return View::make('mwork/team/list', compact('teams'), $this->Titles('id_team', 'id_team_my'));
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
        $users = User::select("username", "id")->get();


        // Show the page
        return View::make('mwork/team/add', compact('users'), $this->Titles('id_team', 'id_team_manage'));
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
            'team_name'   => 'required|min:1',
            'lead_name'     => 'required|min:1'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {

            $team = new Team;

            // Update the blog team data
            $team->name            = Input::get('team_name');
            $team->lead_name       = Input::get('lead_name');
            $team->member_names    = Input::get('member_names');

            // Was the blog team created?
            if($team->save())
            {
                // Redirect to the new blog team page
                return $this->getIndex();
            }

            // Redirect to the blog team create page
            return Redirect::to('mwork/team/add')->with('error', Lang::get('manage/blogs/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('mwork/team/add')->withInput()->withErrors($validator);
	}

    /**
     * Display the specified resource.
     *
     * @param $team
     * @return Response
     */
	public function getShow($teamId)
	{
        $teams = DB::table('teams')->leftjoin(DB::raw('(select COUNT(*) as cnt, team_id from projects) p'), 'teams.id', '=', 'p.team_id')
                    ->select('teams.id', 'teams.name', 'teams.lead_name', 'teams.member_names', DB::raw('IFNULL(p.cnt, 0) as project_count'))
                    ->paginate(10, array(''));

        $members = Team::where('id', '=', $teamId)->select('member_names as names')->get();

        $users = [];
        for($i = 0; $i < count($members); $i++)
        {
            $userNames = explode(',', $members[$i]->names);
            for($j = 0; $j < count($userNames); $j++)
            {
                $user = User::where('username', '=', $userNames[$i])->first();
                $user->chinesename = "123";
                $user->recommend = "123";
                $user->interview = "123";
                $user->comment = "123";
                $user->resume = "123";
                $user->coldcall = "123";
                $users[] = $user;
            }
        }
        

        // Show the page
        return View::make('mwork/team/list', compact('users', 'teams'), $this->Titles('id_team', 'id_team_my'));
	}

    public function getUser($userId)
    {
        $teams = DB::table('teams')->leftjoin(DB::raw('(select COUNT(*) as cnt, team_id from projects) p'), 'teams.id', '=', 'p.team_id')
                    ->select('teams.id', 'teams.name', 'teams.lead_name', 'teams.member_names', DB::raw('IFNULL(p.cnt, 0) as project_count'))
                    ->paginate(10, array(''));

        $members = Team::where('id', '=', $teamId)->select('member_names as names')->get();

        $users = [];
        for($i = 0; $i < count($members); $i++)
        {
            $userNames = explode(',', $members[$i]->names);
            for($j = 0; $j < count($userNames); $j++)
            {
                $user = User::where('username', '=', $userNames[$i])->first();
                $user->chinesename = "123";
                $user->recommend = "123";
                $user->interview = "123";
                $user->comment = "123";
                $user->resume = "123";
                $user->coldcall = "123";
                $users[] = $user;
            }
        }
        
        // Show the page
        return View::make('mwork/team/list', compact('users', 'teams', 'user'), $this->Titles('id_team', 'id_team_my'));
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