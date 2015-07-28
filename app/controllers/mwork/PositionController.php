<?php

class PositionController extends ParentController {
    /**
     * Position Model
     */
    protected $position;
    protected $title;

    /**
     * Inject the models.
     * @param Datatype $position
     */
    public function __construct(Position $position, Title $title)
    {
        parent::__construct();

        $this->position = $position;
        $this->title = $title;
    }

    /**
     * Show a list of all the positions.
     *
     * @return View
     */
    public function getList($posGUID=null)
    {   
        $positions = $this->position->paginate(10);
        $titles = DB::table('titles')->where('posGUID', '=', $posGUID)->get();
        
        // Show the page
        return View::make('mwork/manage/position', 
                compact('positions', 'titles', 'posGUID'), 
                $this->Titles('id_manage', 'id_manage_position'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        // Title
        $title = Lang::get('mwork/position.add');

        // Show the page
        return View::make('mwork/position/add', 
            compact('datatypes'), 
            $this->Titles('id_position', 'id_position_manage'));
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
            'name'   => 'required|min:2'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new position
            $user = Auth::user();

            // Update the position data
            $this->position->name            = Input::get('name');

            // Was the position created?
            if($this->position->save())
            {
                // Redirect to the new position page
                return Redirect::to('manage/position/' . $this->datatype->id . '/edit')->with('success', Lang::get('manage/position/messages.create.success'));
            }

            // Redirect to the position create page
            return Redirect::to('manage/position/create')->with('error', Lang::get('manage/position/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('manage/position/create')->withInput()->withErrors($validator);
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
            'name'   => 'required|min:1'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);
     
        // Check if the form validates with success
        if ($validator->passes())
        {
             $pos = Position::where('name', '=', Input::get('name'))->first();

            if(is_null($pos))
            {
                $pos = new Position();
                $pos->GUID   = DB::raw('UUID()');
            }

            // Update the datavalue data
            $pos->name          = Input::get('name');

            // Was the blog datatype updated?
            if($pos->save())
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
            $position = Datavalue::where('name', '=', Input::get('name'))->first();
            $position->delete();
            $position = Datavalue::where('name', '=', Input::get('name'))->first();
            if(empty($position))
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
        $posts = Position::select(array('positions.id', 'positions.name', 'positions.GUID'));

        return Position::of($posts)

        ->edit_column('comments', '{{ DB::table(\'comments\')->where(\'post_id\', \'=\', $id)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'manage/blogs/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'manage/blogs/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}