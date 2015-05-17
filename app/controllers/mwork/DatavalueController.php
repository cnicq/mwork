<?php

class DatavalueController extends ParentController {
    /**
     * Datatype Model
     * @var Datatype
     */
    protected $datatype;
    protected $datavalue;

    /**
     * Inject the models.
     * @param Datatype $datatype
     */
    public function __construct(Datatype $datatype, Datavalue $datavalue)
    {
        parent::__construct();

        $this->datatype = $datatype;
        $this->datavalue = $datavalue;
    }

    /**
     * Show a list of all the datatypes.
     *
     * @return View
     */
    public function getList($type=null)
    {   
        $datatypes = $this->datatype->paginate(20);
        if(is_null($type)){
            $type = $datatypes[0]['name'];
        }
        $datavalues = DB::table('datavalues')->where('type', '=', $type)->get();
        
        //return compact('datavalues');
        // Show the page
        return View::make('mwork/manage/datatype', 
                compact('datatypes', 'datavalues', 'type'), 
                $this->Titles('id_manage', 'id_manage_datavalue'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('mwork/datatype.add');

        // Show the page
        return View::make('mwork/datatype/add', 
            compact('datatypes'), 
            $this->Titles('id_datavalue', 'id_datavalue_manage'));
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
            // Create a new blog datatype
            $user = Auth::user();

            // Update the blog datatype data
            $this->datatype->chinesename            = Input::get('chinesename');
            $this->datatype->content                = Input::get('englishname');
            $this->datatype->englishname            = Input::get('city');
            $this->datatype->location               = Input::get('location');
            $this->datatype->industry               = Input::get('industry');
            $this->datatype->contract               = Input::get('contract');
            $this->datatype->user_id                = $user->id;

            // Was the blog datatype created?
            if($this->datatype->save())
            {
                // Redirect to the new blog datatype page
                return Redirect::to('manage/blogs/' . $this->datatype->id . '/edit')->with('success', Lang::get('manage/blogs/messages.create.success'));
            }

            // Redirect to the blog datatype create page
            return Redirect::to('manage/blogs/create')->with('error', Lang::get('manage/blogs/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('manage/blogs/create')->withInput()->withErrors($validator);
	}

    /**
     * Display the specified resource.
     *
     * @param $datatype
     * @return Response
     */
	public function getShow($datatype)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $datatype
     * @return Response
     */
	public function getEdit($datatype)
	{
        // Title
        $title = Lang::get('manage/blogs/title.blog_update');

        // Show the page
        return View::make('manage/blogs/create_edit', compact('datatype', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $datatype
     * @return Response
     */
	public function postEdit()
	{
        // Declare the rules for the form validation
        $rules = array(
            'name'   => 'required|min:1',
            'text' => 'required|min:1',
            'type' => 'required|min:1'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);
     
        // Check if the form validates with success
        if ($validator->passes())
        {
             $dv = Datavalue::where('name', '=', Input::get('name'))->first();

            if(is_null($dv))
            {
                $dv = new Datavalue();
            }

            // Update the datavalue data
            $dv->name          = Input::get('name');
            $dv->text          = Input::get('text');
            $dv->type          = Input::get('type');

            // Was the blog datatype updated?
            if($dv->save())
            {
                // Redirect to the new blog datatype page
                return Lang::get('manage/blogs/messages.update.success');
            }

            // Redirect to the blogs datatype management page
            return Lang::get('manage/blogs/messages.update.error');
        }

        // Form validation failed
        return Lang::get('manage/blogs/messages.update.error');
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $datatype
     * @return Response
     */
    public function getDelete($datatype)
    {
        // Title
        $title = Lang::get('manage/blogs/title.blog_delete');

        // Show the page
        return View::make('manage/blogs/delete', compact('datatype', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $datatype
     * @return Response
     */
    public function postDelete()
    {
        // Declare the rules for the form validation
        $rules = array(
            'name' => 'required|min:1'
        );
        
        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);
        // Check if the form validates with success
        if ($validator->passes())
        {
            // Was the blog datatype deleted?
            $datavalue = Datavalue::where('name', '=', Input::get('name'))->first();
            $datavalue->delete();
            $datavalue = Datavalue::where('name', '=', Input::get('name'))->first();
            if(empty($datavalue))
            {
                // Redirect to the blog posts management page
                return Lang::get('manage/blogs/messages.delete.success');
            }
        }
        // There was a problem deleting the blog datatype
        return Lang::get('manage/blogs/messages.delete.error');
    }

    /**
     * Show a list of all the blog posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $posts = Datatype::select(array('posts.id', 'posts.title', 'posts.id as comments', 'posts.created_at'));

        return Datatables::of($posts)

        ->edit_column('comments', '{{ DB::table(\'comments\')->where(\'post_id\', \'=\', $id)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'manage/blogs/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'manage/blogs/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}