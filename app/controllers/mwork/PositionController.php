<?php

class PositionController extends ParentController {

    /**
     * Position Model
     * @var Position
     */
    protected $position;

    /**
     * Inject the models.
     * @param Post $position
     */
    public function __construct(Position $position)
    {
        parent::__construct();
        $this->position = $position;
    }

    /**
     * Show a list of all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('mwork/admin/title.blog_management');

        // Grab all the blog posts
        $posts = $this->position;

        // Show the page
        return View::make('mwork/position/index', compact('position', 'title'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('admin/position/title.create_a_new_blog');

        // Show the page
        return View::make('admin/position/create_edit', compact('title'));
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
            'title'   => 'required|min:3',
            'content' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new blog position
            $user = Auth::user();

            // Update the blog position data
            $this->position->title            = Input::get('title');
            $this->position->slug             = Str::slug(Input::get('title'));
            $this->position->content          = Input::get('content');
            $this->position->meta_title       = Input::get('meta-title');
            $this->position->meta_description = Input::get('meta-description');
            $this->position->meta_keywords    = Input::get('meta-keywords');
            $this->position->user_id          = $user->id;

            // Was the blog position created?
            if($this->position->save())
            {
                // Redirect to the new blog position page
                return Redirect::to('admin/position/' . $this->position->id . '/edit')->with('success', Lang::get('admin/blogs/messages.create.success'));
            }

            // Redirect to the blog position create page
            return Redirect::to('admin/position/create')->with('error', Lang::get('admin/blogs/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('admin/position/create')->withInput()->withErrors($validator);
	}

    /**
     * Display the specified resource.
     *
     * @param $position
     * @return Response
     */
	public function getShow($position)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $position
     * @return Response
     */
	public function getEdit($position)
	{
        // Title
        $title = Lang::get('admin/position/title.blog_update');

        // Show the page
        return View::make('admin/position/create_edit', compact('position', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $position
     * @return Response
     */
	public function postEdit($position)
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
            // Update the blog position data
            $position->title            = Input::get('title');
            $position->slug             = Str::slug(Input::get('title'));
            $position->content          = Input::get('content');
            $position->meta_title       = Input::get('meta-title');
            $position->meta_description = Input::get('meta-description');
            $position->meta_keywords    = Input::get('meta-keywords');

            // Was the blog position updated?
            if($position->save())
            {
                // Redirect to the new blog position page
                return Redirect::to('admin/position/' . $position->id . '/edit')->with('success', Lang::get('admin/blogs/messages.update.success'));
            }

            // Redirect to the blogs position management page
            return Redirect::to('admin/position/' . $position->id . '/edit')->with('error', Lang::get('admin/blogs/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/position/' . $position->id . '/edit')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $position
     * @return Response
     */
    public function getDelete($position)
    {
        // Title
        $title = Lang::get('admin/position/title.blog_delete');

        // Show the page
        return View::make('admin/position/delete', compact('position', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $position
     * @return Response
     */
    public function postDelete($position)
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
            $id = $position->id;
            $position->delete();

            // Was the blog position deleted?
            $position = Post::find($id);
            if(empty($position))
            {
                // Redirect to the blog posts management page
                return Redirect::to('admin/position')->with('success', Lang::get('admin/position/messages.delete.success'));
            }
        }
        // There was a problem deleting the blog position
        return Redirect::to('admin/position')->with('error', Lang::get('admin/position/messages.delete.error'));
    }

    /**
     * Show a list of all the blog posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $posts = Post::select(array('posts.id', 'posts.title', 'posts.id as comments', 'posts.created_at'));

        return Datatables::of($posts)

        ->edit_column('comments', '{{ DB::table(\'comments\')->where(\'post_id\', \'=\', $id)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/position/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/position/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}