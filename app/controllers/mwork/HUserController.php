<?php

class HUserController extends ParentController {
    /**
     * Huser Model
     * @var Huser
     */
    protected $huser;

    /**
     * Inject the models.
     * @param HUser $huser
     */
    public function __construct(HUser $huser)
    {
        parent::__construct();

        $this->huser = $huser;
        $this->bigTitle = 'id_huser';
    }

    public function getManage()
    {
        $this->bigTitle = 'id_manage';
        $this->smallTitle = 'id_manage_huser';

        $husers = $this->huser->orderBy('updated_at', 'DESC')->paginate(20);

        // Show the page
        return View::make('mwork/manage/user', compact('husers'), $this->Titles('id_manage', 'id_manage_user'));
    }

    /**
     * Show a list of all the husers.
     *
     * @return View
     */
    public function getIndex()
    {
        $husers = $this->huser->orderBy('updated_at', 'DESC')->paginate(20);

        // Show the page
        return View::make('mwork/user/list', compact('husers'), $this->Titles());
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('mwork/huser.add');

        // Show the page
        return View::make('mwork/huser', compact('title'));
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
            // Create a new blog huser
            $user = Auth::user();

            // Update the blog huser data
            $this->huser->chinesename            = Input::get('chinesename');
            $this->huser->content                = Input::get('englishname');
            $this->huser->englishname            = Input::get('city');
            $this->huser->location               = Input::get('location');
            $this->huser->industry               = Input::get('industry');
            $this->huser->contract               = Input::get('contract');
            $this->huser->user_id                = $user->id;

            // Was the blog huser created?
            if($this->huser->save())
            {
                // Redirect to the new blog huser page
                return Redirect::to('manage/blogs/' . $this->huser->id . '/edit')->with('success', Lang::get('manage/blogs/messages.create.success'));
            }

            // Redirect to the blog huser create page
            return Redirect::to('manage/blogs/create')->with('error', Lang::get('manage/blogs/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('manage/blogs/create')->withInput()->withErrors($validator);
	}

    /**
     * Display the specified resource.
     *
     * @param $huser
     * @return Response
     */
	public function getShow($huser)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $huser
     * @return Response
     */
	public function getEdit($huser)
	{
        // Title
        $title = Lang::get('manage/blogs/title.blog_update');

        // Show the page
        return View::make('manage/blogs/create_edit', compact('huser', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $huser
     * @return Response
     */
	public function postEdit($huser)
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
            // Update the blog huser data
            $huser->title            = Input::get('title');
            $huser->slug             = Str::slug(Input::get('title'));
            $huser->content          = Input::get('content');
            $huser->meta_title       = Input::get('meta-title');
            $huser->meta_description = Input::get('meta-description');
            $huser->meta_keywords    = Input::get('meta-keywords');

            // Was the blog huser updated?
            if($huser->save())
            {
                // Redirect to the new blog huser page
                return Redirect::to('manage/blogs/' . $huser->id . '/edit')->with('success', Lang::get('manage/blogs/messages.update.success'));
            }

            // Redirect to the blogs huser management page
            return Redirect::to('manage/blogs/' . $huser->id . '/edit')->with('error', Lang::get('manage/blogs/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('manage/blogs/' . $huser->id . '/edit')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $huser
     * @return Response
     */
    public function getDelete($huser)
    {
        // Title
        $title = Lang::get('manage/blogs/title.blog_delete');

        // Show the page
        return View::make('manage/blogs/delete', compact('huser', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $huser
     * @return Response
     */
    public function postDelete($huser)
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
            $id = $huser->id;
            $huser->delete();

            // Was the blog huser deleted?
            $huser = Huser::find($id);
            if(empty($huser))
            {
                // Redirect to the blog posts management page
                return Redirect::to('manage/blogs')->with('success', Lang::get('manage/blogs/messages.delete.success'));
            }
        }
        // There was a problem deleting the blog huser
        return Redirect::to('manage/blogs')->with('error', Lang::get('manage/blogs/messages.delete.error'));
    }

    /**
     * Show a list of all the blog posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $posts = Huser::select(array('posts.id', 'posts.title', 'posts.id as comments', 'posts.created_at'));

        return Datatables::of($posts)

        ->edit_column('comments', '{{ DB::table(\'comments\')->where(\'post_id\', \'=\', $id)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'manage/blogs/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'manage/blogs/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}