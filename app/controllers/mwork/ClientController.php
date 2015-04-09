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
        $clients = $this->client->orderBy('updated_at', 'DESC')->paginate(20);

        // Show the page
        return View::make('mwork/client', compact('clients'), $this->Titles());
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

        // Show the page
        return View::make('mwork/client', compact('title'));
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
            // Create a new blog client
            $user = Auth::user();

            // Update the blog client data
            $this->client->chinesename            = Input::get('chinesename');
            $this->client->content                = Input::get('englishname');
            $this->client->englishname            = Input::get('city');
            $this->client->location               = Input::get('location');
            $this->client->industry               = Input::get('industry');
            $this->client->contract               = Input::get('contract');
            $this->client->user_id                = $user->id;

            // Was the blog client created?
            if($this->client->save())
            {
                // Redirect to the new blog client page
                return Redirect::to('manage/blogs/' . $this->client->id . '/edit')->with('success', Lang::get('manage/blogs/messages.create.success'));
            }

            // Redirect to the blog client create page
            return Redirect::to('manage/blogs/create')->with('error', Lang::get('manage/blogs/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('manage/blogs/create')->withInput()->withErrors($validator);
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