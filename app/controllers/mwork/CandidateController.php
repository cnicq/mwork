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

    public function getProjectList($caId, $projId=0)
    {

        $projects = Project::leftjoin('projectinfos','projects.id', '=', 'projectinfos.proj_id')->where('projectinfos.ca_id', '=', $caId)->select('projects.*')->paginate(20);

        return Response::json(View::make("mwork/project/part_list", compact('projects', 'caId', 'projId'))->render() );
    }

    public function getDetail($caId, $projId=0)
    {
        $candidate = $this->candidate->where('id', '=', $caId)->first();
        $this->dealWithData($candidate);
        
        $cacomments = DB::table('cacomments')->where('ca_id', '=', $caId)->get();
       
        $projects = Project::leftjoin('projectinfos','projects.id', '=', 'projectinfos.proj_id')->where('projectinfos.ca_id', '=', $caId)->select('projects.*')->paginate(20);
        $tName = time();

        return Response::json(View::make("mwork/candidate/part_detail",
         compact('candidate', 'cacomments', 'tName', 'projects', 'caId', 'projId'))->render() );
    }

    public function addProject($projId, $caId)
    {
        $projInfo = Projectinfo::where('proj_id', '=', $projId)->where('ca_id', '=', $caId)->first();

        if(empty($projInfo) || $projInfo == null)
        {
            $user = Auth::user();
            $projInfo = new projectinfo();
            $projInfo->proj_id = $projId;
            $projInfo->ca_id = $caId;
            $projInfo->auth_id = $user->id;
            $projInfo->step = 'choose';

            $projInfo->save();
        }
        return $this->getProjectList($caId, $projId);
    }

    public function addComment($caId, $content, $projId=0)
    {
        $user = Auth::user();

        $com = new Cacomment();
        $com->content = $content;
        $com->ca_id = $caId;
        $com->proj_id = $projId;
        $com->auth_id = $user->id;
        $com->save();

        $cacomments = DB::table('cacomments')->where('ca_id', '=', $caId)->orderBy('updated_at', 'DESC')->get();

        return Response::json(View::make("mwork/candidate/part_comment", compact('cacomments'))->render() );
    }

    /**
     * Returns all the candidates.
     *
     * @return View
     */
    public function getIndex()
    {
       
        $candidates = $this->candidate->orderBy('updated_at', 'DESC')->paginate(20);
        
        return $this->showList($candidates);
       
    }

    public function showList($candidates, $mode='candidate', $blade='mwork/candidate/list')
    {
        $companys = DB::table('companys')->orderBy('updated_at', 'DESC')->get();
        $citys = DB::table('datavalues')->where('type', '=', 'city')->get();
        $industrys = DB::table('datavalues')->where('type', '=', 'industry')->get();
        $positions = DB::table('datavalues')->where('type', '=', 'position')->get();

        $this->dealWithDatas($candidates);

         // Show the page
        return View::make($blade, compact('candidates', 'companys', 'citys', 'industrys', 'positions', 'mode'), 
            $this->Titles("id_candidate", 'id_candidate_list'));
    }

    private function dealWithData(&$candidate)
    {
        $company = DB::table('companys')->where('id','=',$candidate['company'])->first();
        if($company == null)
        {
            $candidate['company'] = '/';
        }
        else 
        {
            $candidate['company'] = $company->chinesename;
        }
        $candidate['position'] = DatavalueUtil::getInstance()->getDataValueText('position', $candidate['position']);
        $candidate['gender'] = DatavalueUtil::getInstance()->getGenderText($candidate['gender']);
    }

    private function dealWithDatas(&$candidates)
    {
        foreach ($candidates as $key1 => $value1) 
        {
            $this->dealWithData($value1);
        }
    }

    public function getAdd()
    {
        $this->smallTitle = 'id_candidate_add';

        $companys = DB::table('companys')->orderBy('updated_at', 'DESC')->get();
        $citys = DB::table('datavalues')->where('type', '=', 'city')->get();
        $industrys = DB::table('datavalues')->where('type', '=', 'industry')->get();
        $positions = DB::table('datavalues')->where('type', '=', 'position')->get();
        $cvsites = DB::table('datavalues')->where('type', '=', 'cvsite')->get();

        // Show the page
        return View::make('mwork/candidate/add', 
            compact('companys', 'citys', 'industrys', 'positions', 'cvsites'),
            $this->Titles("id_candidate", 'id_candidate_add'));
    }

    public function postSearch($mode = 'candidate')
    {
        $candidates = null;
        
        $keywords = Input::get('keywords');
        if($keywords != '')
        {
            $keywordsArr = explode(' ', $keywords);
            $candidates = Candidate::select('*')->whereRaw("MATCH(searchtext) AGAINST(? IN BOOLEAN MODE)", $keywordsArr)->paginate(20);    
        }
        else
        {
            $inputs = Input::except('keywords', '_token', 'projId');
            $whereArr = array();

            foreach ($inputs as $key => $value) {
                if($value != ''){
                    $whereArr[$key] = $value;
                }
            }
          
            if(count($whereArr) > 0)
            {
                $candidates = $this->candidate->where($whereArr)->orderBy('updated_at', 'DESC')->paginate(20);    
            }
            else
            {
                $candidates = $this->candidate->orderBy('updated_at', 'DESC')->paginate(20); 
            }
        }

        $this->dealWithDatas($candidates);
        $blade = 'mwork/candidate/part_list_general';
     
        return $this->showList($candidates,$mode, $blade);
    }

    public function postCreate()
    {
        // Check if the form validates with success
        if (true)
        {
            $user = Auth::user();
            // TODO:check auth
            $forSearch = '';
            $e = Input::all();
            foreach($e as $k=>$v){
                $forSearch = $forSearch.' '.$v;
            }

            // candidate data
            $this->candidate->englishname           = Input::get('englishname');
            $this->candidate->chinesename           = Input::get('chinesename');
            $this->candidate->gender                = Input::get('gender');
            $this->candidate->location              = Input::get('location');
            $this->candidate->city                  = Input::get('city');
            $this->candidate->maritalstatus         = Input::get('maritalstatus');
            $this->candidate->hometown              = Input::get('hometown');
            $this->candidate->label                 = Input::get('label');
            $this->candidate->mobile                = Input::get('mobile');
            $this->candidate->birthday              = Input::get('birthday');
            $this->candidate->tel                   = Input::get('tel');
            $this->candidate->email                 = Input::get('email');
            $this->candidate->company               = Input::get('company');
            $this->candidate->position              = Input::get('position');
            $this->candidate->status                = Input::get('status');
            $this->candidate->resumes               = Input::get('resumes');
            $this->candidate->notes                 = Input::get('notes');
            $this->candidate->creater_id            = Input::get('creater_id');
            $this->candidate->QQ                    = Input::get('QQ');
            $this->candidate->wechat                = Input::get('wechat');
            $this->candidate->cvsite                = Input::get('cvsite');
            $this->candidate->cvNO                  = Input::get('cvNO');
            $this->candidate->resumes                = Input::get('resumes');
            $this->candidate->cvpath                = Input::get('resumes');
            $this->candidate->creater_id                = $user->id;
            $this->candidate->searchtext                = $forSearch;

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

    public function getSearch($keywords = '')
    {
        $keywordsArr = explode(' ', $keywords);
        //return json_encode("{key:" . $keywords . "}");
        $candidates = Candidate::select('*')->whereRaw("MATCH(searchtext) AGAINST(? IN BOOLEAN MODE)", $keywordsArr);
        //$this->dealWithData($candidates);
        return Datatables::of($candidates)
                ->make();
    }
}
