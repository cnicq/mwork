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

    public function getDetail($caId=0, $projId=0)
    {
    
        $candidate = $this->candidate->where('id', '=', $caId)->first();
        if($candidate == null){
            return error;
        }
        Candidate::dealWithData($candidate);
        
        $cacomments = DB::table('cacomments')->where('ca_id', '=', $caId)->get();
        $castatus = DB::table('datavalues')->where('type', '=', 'castatus')->get();
       
        $projects = DB::table('projects')->paginate(20);
        $tName = time();
        
        $projectinfos = Projectinfo::where('proj_id', '=', $projId)->where('ca_id', '=', $caId)->orderBy('updated_at', 'DESC')->get();
        $curStep  = -1;
        $steps = Datavalue::getValues('step');

        if(empty($projectinfos) == false && count($projectinfos) > 0)
        {
            $curStep =  Datavalue::getValue('step', $projectinfos[0]->step);    
        }

        return Response::json(View::make("mwork/candidate/part_detail",
         compact('candidate', 'castatus', 'cacomments', 'tName', 'projects', 'caId', 'projId', 'curStep', 'steps', 'projectinfos'))->render() );
    }

    public function addOwn($caId)
    {
        if(Candidate::find($caId) == null)
        {
            return 'error';
        }

        if(Candidate::IsOwn($caId, Auth::user()->id))
        {
            return 'error';
        }

        $own = new Candidateown();
        $own->ca_id = $caId;
        $own->owner_id = Auth::user()->id;
        $own->save();

        return 'ok';

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
            $projInfo->step = 0;
            $projInfo->content = '';

            $projInfo->save();
        }

        return $this->getProjectList($caId, $projId);
    }

    public function addComment($caId, $content, $status, $projId=0)
    {
        if($content == '')
        {
            return '';
        }
        
        $user = Auth::user();

        $com = new Cacomment();

        $com->content = $content;
        $com->created_at_old = '';
        $com->ca_id = $caId;
        $com->castatus = $status;
        $com->proj_id = $projId;
        $com->auth_id = $user->id;
        $st = $this->modifyKeywords($content);
        $com->searchtext = Cpa::getInstance()->parse($st);
        
        $com->save();

        $cacomments = DB::table('cacomments')->where('ca_id', '=', $caId)->orderBy('updated_at', 'DESC')->get();

        return Response::json(View::make("mwork/candidate/part_comment", compact('cacomments'))->render() );
    }

    public function postComment()
    {
        $content = Input::get('content_comment');
        $caId = Input::get('ca_id');
        $projId = Input::get('proj_id');
        $status = Input::get('castatus');

        return $this->addComment($caId, $content, $status, $projId);
    }

    /**
     * Returns all the candidates.
     *
     * @return View
     */
    public function getIndex()
    {
        //$candidates = $this->candidate->orderBy('updated_at', 'DESC')->paginate(20);
        
        return $this->showList(null, $mode='candidate', $blade='mwork/candidate/list');
       
    }

   
    public function showList($candidates, $mode='candidate', $blade='mwork/candidate/list', $subTitile='id_candidate_list')
    {
        $companys = DB::table('companys')->orderBy('updated_at', 'DESC')->get();
        $citys = DB::table('datavalues')->where('type', '=', 'city')->get();
        $industrys = DB::table('datavalues')->where('type', '=', 'industry')->get();
        $positions = DB::table('datavalues')->where('type', '=', 'position')->get();
        

        if($candidates != null) Candidate::dealWithDatas($candidates);

         // Show the page
        return  View::make($blade, compact('candidates', 'companys', 'citys', 'industrys', 'positions', 'castatus', 'mode'), 
            $this->Titles("id_candidate", $subTitile));
    }

    public function getMy()
    {
        $candidates = Candidate::join('candidateowns', function($join){
            $join->on('candidates.id', '=', 'candidateowns.ca_id')
            ->where('candidateowns.owner_id', '=', Auth::user()->id);
        })->paginate(20);
         
        
         // Show the page
        return  $this->showList(null, $mode='mycandidate', $blade='mwork/candidate/list', 'id_candidate_my');
    }

    public function getAdd($error = '')
    {
        $this->smallTitle = 'id_candidate_add';

        $companys = DB::table('companys')->orderBy('updated_at', 'DESC')->get();
        $citys = DB::table('datavalues')->where('type', '=', 'city')->get();
        $industrys = DB::table('datavalues')->where('type', '=', 'industry')->get();
        $positions = DB::table('datavalues')->where('type', '=', 'position')->get();
        $cvsites = DB::table('datavalues')->where('type', '=', 'cvsite')->get();
        
        // Show the page
        $v = View::make('mwork/candidate/add', 
            compact('companys', 'citys', 'industrys', 'positions', 'cvsites', 'error'),
            $this->Titles("id_candidate", 'id_candidate_add'));
     
        return $v;
    }

    function modifyKeywords($keywords){
        $keywords = strtolower($keywords);
        $keywords = str_replace('+','p',$keywords);
        $keywords = str_replace('-','m',$keywords);
        $keywords = str_replace('*','s',$keywords);

        return $keywords;
    }

    public function postSearch($mode = 'candidate')
    {
        $candidates = null;

        $my = ($mode == 'mycandidate');
        
        $keywords = Input::get('keywords');
        $keywords = $this->modifyKeywords($keywords);
        
        $company = Input::get('company');
        $city = Input::get('city');
        $position = Input::get('position');
        if($company != '')
        {
            $keywords .=' '.$company;
        }
        if($city != '')
        {
            $keywords .=' '.$city;
        }
        if($position != '')
        {
            $keywords .=' '.$position;
        }
       
        $s = '';
        if($keywords != '')
        {
            $exp = explode(' ', $keywords);
            
            $c = 1;
            foreach ($exp AS $e)
            {
                $s .= "$e*";

                if ($c + 1 == count($exp))
                    $s .= ' ';

                $c++;
            }
        }
           
        if($my)
        {
           if($s != '')
            {
                $candidates = Candidate::whereRaw("MATCH(searchtext) AGAINST('$s' IN BOOLEAN MODE)")->join(
                        'candidateowns', function($join){
                            $join->on('candidates.id', '=', 'candidateowns.ca_id')
                            ->where('candidateowns.owner_id', '=', Auth::user()->id);
                    })->orwhereRaw("candidates.id IN (select ca_id from cacomments WHERE MATCH(searchtext) AGAINST('$s' IN BOOLEAN MODE))")
                    ->select('candidates.*','candidates.id as cid')->paginate(20); 
            }
            else
            {
                $candidates = Candidate::join(
                        'candidateowns', function($join){
                            $join->on('candidates.id', '=', 'candidateowns.ca_id')
                            ->where('candidateowns.owner_id', '=', Auth::user()->id);
                    })->select('candidates.*','candidates.id as cid')->paginate(20); 
            }
        }
        else
        {
            if($s != '')
            {
                $candidates = Candidate::whereRaw("MATCH(searchtext) AGAINST('$s' IN BOOLEAN MODE)")
                    ->orwhereRaw("id IN (select ca_id from cacomments WHERE MATCH(searchtext) AGAINST('$s' IN BOOLEAN MODE))")->paginate(20); 
            }
            else
            {
                $candidates = Candidate::paginate(20); 
            }
        }
        

        Candidate::dealWithDatas($candidates);
        $blade = 'mwork/candidate/part_list_general';
     
        return $this->showList($candidates,$mode, $blade);
    }

    public function postCreate()
    {
        $name = Input::get('englishname').Input::get('chinesename');
        $mobile1 = Input::get('mobile1');
        $mobile2 = Input::get('mobile2');
        if( ($mobile1 == '' && $mobile2 =='') || $name=='')
        {
            return $this->getAdd('名字和手机号码必填');
        }
        if($mobile1 != '' && Candidate::where('mobile1','=',$mobile1)->orWhere('mobile2', '=',$mobile1)->first() != null){
            return $this->getAdd('手机号为:'.$mobile1.'的候选人已经存在');
        }
        if($mobile2 != '' && Candidate::where('mobile1','=',$mobile2)->orWhere('mobile2', '=',$mobile2)->first() != null){
            return $this->getAdd('手机号为:'.$mobile2.'的候选人已经存在');
        }
        
        // check duplicate
     
        if (true)
        {
            $user = Auth::user();
            
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
            $this->candidate->mobile1               = Input::get('mobile1');
            $this->candidate->mobile2               = Input::get('mobile2');
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
