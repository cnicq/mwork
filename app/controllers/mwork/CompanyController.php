<?php

class CompanyController extends ParentController {

    /**
     * Company Model
     * @var Company
     */
    protected $company;

    /**
     * Inject the models.
     * @param Company $company
     */
    public function __construct(Company $company)
    {
        parent::__construct();

        $this->company = $company;
    }

    public function getManage()
    {
        $companys = $this->company->orderBy('updated_at', 'DESC')->paginate(20);

        // Show the page
        return View::make('mwork/manage/company', compact('companys'), $this->Titles('id_manage', 'id_manage_company'));
    }


    /**
     * Show a list of all the companys.
     *
     * @return View
     */
    public function getIndex()
    {
        $companys = $this->company->orderBy('updated_at', 'DESC')->paginate(20);
        // Show the page
        return View::make('mwork/manage/company', compact('companys'), $this->Titles($this->Titles('id_company', 'id_company_list')));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('mwork/manage.company_add');

        // Show the page
        return View::make('mwork/manage/company', compact('title'));
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
            // Create a new blog company
            $user = Auth::user();

            // Update the blog company data
            $this->company->chinesename            = Input::get('chinesename');
            $this->company->content                = Input::get('englishname');
            $this->company->englishname            = Input::get('city');
            $this->company->location               = Input::get('location');
            $this->company->industry               = Input::get('industry');
            $this->company->contract               = Input::get('contract');
            $this->company->user_id                = $user->id;

            // Was the blog company created?
            if($this->company->save())
            {
                // Redirect to the new blog company page
                return Redirect::to('manage/blogs/' . $this->company->id . '/edit')->with('success', Lang::get('manage/blogs/messages.create.success'));
            }

            // Redirect to the blog company create page
            return Redirect::to('manage/blogs/create')->with('error', Lang::get('manage/blogs/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('manage/blogs/create')->withInput()->withErrors($validator);
	}

    /**
     * Display the specified resource.
     *
     * @param $company
     * @return Response
     */
	public function getShow($company)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $company
     * @return Response
     */
	public function getEdit($company)
	{
        // Title
        $title = Lang::get('manage/blogs/title.blog_update');

        // Show the page
        return View::make('manage/blogs/create_edit', compact('company', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $company
     * @return Response
     */
	public function postEdit($company)
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
            // Update the blog company data
            $company->title            = Input::get('title');
            $company->slug             = Str::slug(Input::get('title'));
            $company->content          = Input::get('content');
            $company->meta_title       = Input::get('meta-title');
            $company->meta_description = Input::get('meta-description');
            $company->meta_keywords    = Input::get('meta-keywords');

            // Was the blog company updated?
            if($company->save())
            {
                // Redirect to the new blog company page
                return Redirect::to('manage/blogs/' . $company->id . '/edit')->with('success', Lang::get('manage/blogs/messages.update.success'));
            }

            // Redirect to the blogs company management page
            return Redirect::to('manage/blogs/' . $company->id . '/edit')->with('error', Lang::get('manage/blogs/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('manage/blogs/' . $company->id . '/edit')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $company
     * @return Response
     */
    public function getDelete($company)
    {
        // Title
        $title = Lang::get('manage/blogs/title.blog_delete');

        // Show the page
        return View::make('manage/blogs/delete', compact('company', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $company
     * @return Response
     */
    public function postDelete($company)
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
            $id = $company->id;
            $company->delete();

            // Was the blog company deleted?
            $company = Company::find($id);
            if(empty($company))
            {
                // Redirect to the blog posts management page
                return Redirect::to('manage/blogs')->with('success', Lang::get('manage/blogs/messages.delete.success'));
            }
        }
        // There was a problem deleting the blog company
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

}