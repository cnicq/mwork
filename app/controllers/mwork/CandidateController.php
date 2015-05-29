<?php

class CandidateController extends ParentController {

    

    /**
     * candidate Model
     * @var candidate
     */
    protected $candidate;


    /**
     * Inject the models.
     * @param Post $post
     * @param User $user
     */
    public function __construct(Candidate $candidate)
    {
        parent::__construct();

        $this->candidate = $candidate;
    }
    
    /**
     * Returns all the candidates.
     *
     * @return View
     */
    public function getIndex()
    {
         
        $candidates = $this->candidate->orderBy('updated_at', 'DESC')->paginate(20);
        
        // Show the page
        return View::make('mwork/candidate/list', compact('candidates'), $this->Titles("id_candidate", 'id_candidate_list'));
    }

    public function getAdd()
    {
        $this->smallTitle = 'id_candidate_add';

        $candidates = $this->candidate->orderBy('updated_at', 'DESC')->paginate(20);

        // Show the page
        return View::make('mwork/candidate/add', compact('candidates'),$this->Titles("id_candidate", 'id_candidate_add'));
    }

    public function postCreate()
    {
        // Check if the form validates with success
        if (true)
        {
            $user = Auth::user();
            // TODO:check auth

 $table->increments('id');
            $table->string('');
            $table->string('');
            $table->string('');
            $table->string('');
            $table->string('location');
            $table->string('hometown');
            $table->string('label'); //tags
            $table->string('mobile');
            $table->string('email');
            $table->string('company');
            $table->string('title');
            $table->string('status');
            $table->string('resumes');
            $table->text('notes');
            $table->string('creater');
            $table->string('QQ');
            $table->string('Wechat');
            $table->text('forSearch'); // for fulltext search
            
            // candidate data
            $this->candidate->englishname           = Input::get('englishname');
            $this->candidate->chinesename             = Input::get('chinesename');
            $this->candidate->gender       = Input::get('gender');
            $this->candidate->head_count          = Input::get('head_count');
            $this->candidate->position_name       = Input::get('position_name');
            $this->candidate->income              = Input::get('income');
            $this->candidate->location            = Input::get('location');
            $this->candidate->desc                = Input::get('desc');
            $this->candidate->starttime           = Input::get('starttime');
            $this->candidate->endtime             = Input::get('endtime');
            

            // Was the blog project created?
            if($this->candidate->save())
            {
                // Redirect to the new candidate page
                return $this->getIndex();
            }

            // Redirect to the candidate create page
            return $this->getIndex();
        }

        // Form validation failed
        return $this->getIndex();
    }

    public function getManage()
    {
        $this->smallTitle = 'id_candidate_manage';

        $candidates = $this->candidate->orderBy('updated_at', 'DESC')->paginate(20);

        // Show the page
        return View::make('mwork/candidate/manage', compact('candidates'), $this->Titles("id_manage", 'id_manage_candidate'));
    }

    /**
     * View a candidate.
     *
     * @param  string  $slug
     * @return View
     * @throws NotFoundHttpException
     */
    public function getView($slug)
    {
        // Get this candidate post data
        $candidate = $this->candidate->where('slug', '=', $slug)->first();

        // Check if the candidate post exists
        if (is_null($candidate))
        {
            return App::abort(404);
        }

        // Show the page
        return View::make('mwork/candidate/view', compact('candidate'));
    }

    /**
     * View a candidate post.
     *
     * @param  string  $slug
     * @return Redirect
     */
    public function postView($slug)
    {

        $candidate = $this->user->currentUser();
        $canComment = $user->can('post_comment');
        if ( ! $canComment)
        {
            return Redirect::to($slug . '#comments')->with('error', 'You need to be logged in to post comments!');
        }

        // Get this blog post data
        $candidate = $this->candidate->where('slug', '=', $slug)->first();

        // Declare the rules for the form validation
        $rules = array(
            'comment' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Save the comment
            $candidate = new Candidate;
            $candidate->user_id = Auth::user()->id;
            $candidate->content = Input::get('comment');

            // Was the comment saved with success?
            if($candidate->save($candidate))
            {
                // Redirect to this blog post page
                return Redirect::to($slug . '#comments')->with('success', 'Your comment was added with success.');
            }

            // Redirect to this blog post page
            return Redirect::to($slug . '#comments')->with('error', 'There was a problem adding your comment, please try again.');
        }

        // Redirect to this blog post page
        return Redirect::to($slug)->withInput()->withErrors($validator);
    }

    public function postSearch()
    {
        $q = Input::get('query');
        $candidates = $this->candidate->whereRaw("MATCH(forSearch) AGAINST(? IN BOOLEAN MODE)", array($q))->get()->paginate(10);

        // Show the page
        return View::make('mwork/candidate/list', compact('candidates'), $this->Titles("id_candidate", 'id_candidate_list'));

    }
}
