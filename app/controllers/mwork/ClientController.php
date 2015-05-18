<?php

class ClientController extends ParentController {
    /**
     * Client Model
     * @var Client
     */
    protected $client;

    /**
     * Inject the models.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct();

        $this->client = $client;
    }

    /**
     * Show a list of all the clients.
     *
     * @return View
     */
    public function getIndex()
    {
        //$clients = $this->client->paginate(20);

        $clients = Client::leftjoin("companys", 'clients.company_id', '=', 'companys.id')
                ->leftjoin('users as u1', 'u1.id', '=', 'clients.owner_user_id')
                ->leftjoin('users as u2', 'u2.id', '=', 'clients.BD_user_id')
                ->select('clients.*', 'companys.*', 'u1.username as owner_username', 'u2.username as BD_username')
                ->paginate(20);

        $companys = DB::table('companys')->select('id', 'chinesename', 'linkman_chinesename', 'linkman_englishname')->get();
        $users = DB::table('users')->select('id', 'username')->get();


        // Show the page
        return View::make('mwork/client/list', compact('clients', 'companys', 'users'), $this->Titles('id_client', 'id_client_my'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('mwork/client.add');
        $companys = DB::table('companys')->select('id', 'chinesename')->get();
        $users = DB::table('users')->select('id', 'username')->get();
        

        // Show the page
        return View::make('mwork/client/add', compact('companys', 'users'), $this->Titles('id_client', 'id_client_manage'));
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
            'company'   => 'required|min:1'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

       
        // Check if the form validates with success
        if ($validator->passes())
        {

            $comp = Company::find(Input::get('company'));
    
            if(is_null($comp))
            {
                // Redirect to the blog client create page
                return $this->getIndex();
            }

            $exist = Project::where('company_id', '=', Input::get('company'));
            if($exist)
            {
                return $this->getIndex(); 
            }
            
            // Update the blog client data
            $this->client->company_id            = Input::get('company');
            $this->client->owner_user_id         = Input::get('owner_user_id');
            $this->client->BD_user_id            = Input::get('DB_user_id');
            $this->client->contract_start        = new DateTime(Input::get('contract_start'));
            $this->client->contract_end          = new DateTime(Input::get('contract_end'));
            $this->client->contract_filePath     = Input::get('contract_filePath');
            $this->client->fee                   = intval(Input::get('fee'));
            
            // Was the blog client created?
            if($this->client->save())
            {

                // Redirect to the new blog client page
                return $this->getIndex();
            }
            // Redirect to the blog client create page
            return $this->getIndex();
        }

        // Form validation failed
        return $this->getIndex();
	}

    /**
     * Display the specified resource.
     *
     * @param $client
     * @return Response
     */
	public function getShow($client)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $client
     * @return Response
     */
	public function getEdit($client)
	{
        // Title
        $title = Lang::get('manage/blogs/title.blog_update');

        // Show the page
        return View::make('manage/blogs/create_edit', compact('client', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $client
     * @return Response
     */
	public function postEdit($client)
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
            // Update the blog client data
            $client->title            = Input::get('title');
            $client->slug             = Str::slug(Input::get('title'));
            $client->content          = Input::get('content');
            $client->meta_title       = Input::get('meta-title');
            $client->meta_description = Input::get('meta-description');
            $client->meta_keywords    = Input::get('meta-keywords');

            // Was the blog client updated?
            if($client->save())
            {
                // Redirect to the new blog client page
                return Redirect::to('manage/blogs/' . $client->id . '/edit')->with('success', Lang::get('manage/blogs/messages.update.success'));
            }

            // Redirect to the blogs client management page
            return Redirect::to('manage/blogs/' . $client->id . '/edit')->with('error', Lang::get('manage/blogs/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('manage/blogs/' . $client->id . '/edit')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $client
     * @return Response
     */
    public function getDelete($client)
    {
        // Title
        $title = Lang::get('manage/blogs/title.blog_delete');

        // Show the page
        return View::make('manage/blogs/delete', compact('client', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $client
     * @return Response
     */
    public function postDelete($client)
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
            $id = $client->id;
            $client->delete();

            // Was the blog client deleted?
            $client = Client::find($id);
            if(empty($client))
            {
                // Redirect to the blog posts management page
                return Redirect::to('manage/blogs')->with('success', Lang::get('manage/blogs/messages.delete.success'));
            }
        }
        // There was a problem deleting the blog client
        return Redirect::to('manage/blogs')->with('error', Lang::get('manage/blogs/messages.delete.error'));
    }

    /**
     * Show a list of all the blog posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $posts = Client::select(array('posts.id', 'posts.title', 'posts.id as comments', 'posts.created_at'));

        return Datatables::of($posts)

        ->edit_column('comments', '{{ DB::table(\'comments\')->where(\'post_id\', \'=\', $id)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'manage/blogs/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'manage/blogs/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}