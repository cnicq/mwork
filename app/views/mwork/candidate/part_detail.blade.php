<!--BEGIN TABS-->

<div class="tabbable tabbable-custom tabs-left" id="candidate_detail_tab">
	<div class="alert alert-block alert-info fade in">
		@if (Candidate::InProject($projId, $caId))
			<button class="btn gray" disabled id='addProject'>已加入</button>
		@elseif ($projId != 0)
			<button class="btn blue" onclick='onClickProjectD({{$projId}})' id='addProject'>加入项目</button>
		@else
			<button class="btn blue" onclick='onClickProject()'>加入项目</button>
		@endif
		<button class="btn blue" onclick='onClickComment()'>添加备注</button>
	</div>
	<!-- Only required for left/right tabs -->

	<ul class="nav nav-tabs tabs-left">

		@if (Candidate::InProject($projId, $caId))
			<li class=""><a href="#ca_tab_4_{{$tName}}" data-toggle="tab">推荐状态</a></li>
		@endif
		<li class="active"><a href="#ca_tab_1_{{$tName}}" data-toggle="tab">详细资料</a></li>
		<li class=""><a href="#ca_tab_2_{{$tName}}" data-toggle="tab">参与项目</a></li>
		<li class=""><a href="#ca_tab_3_{{$tName}}" data-toggle="tab">备注记录</a></li>
		<li class=""><a href="#ca_tab_5_{{$tName}}" data-toggle="tab">简历预览</a></li>
		
		<input type="hidden" class="m-wrap span12" placeholder="" id='ca_id' name='ca_id' value='{{$caId}}'>
		<input type="hidden" class="m-wrap span12" placeholder="" id='proj_id' name='proj_id' value='{{$projId}}'>
	</ul>

	<div class="tab-content">
		@if (Candidate::InProject($projId, $caId))
		<div class="tab-pane" id="ca_tab_4_{{$tName}}" style="min-height: 500px;">
			<div class='well profile-classic' id='projInfoList'>
				@include('mwork.project.part_info')
			</div>
		</div>
		@endif
		<div class="tab-pane active" id="ca_tab_1_{{$tName}}" style="min-height: 500px;">
			<div class='profile-classic'>
				<ul class="span10">
				<li><span>中文名:</span> {{$candidate['chinesename']}}</li>
				<li><span>英文名:</span> {{$candidate['englishname']}}</li>
				<li><span>性别:</span> {{$candidate['gender']}}</li>
				<li><span>婚姻状况:</span> {{$candidate['maritalstatus']}}</li>
				<li><span>录入人:</span> {{$candidate['creater_id']}}</li>
				<li><span>所在地:</span> {{$candidate['location']}}</li>
				<li><span>出生日期:</span> {{$candidate['birthday']}}</li>
				<li><span>家乡:</span> {{$candidate['hometown']}}</li>
				<li><span>所在城市:</span> {{$candidate['city']}}</li>
				<li><span>移动电话:</span> {{$candidate['mobile1']}} {{$candidate['mobile2']}} </li>
				<li><span>Email:</span> {{$candidate['email']}}</li>
				<li><span>所在公司:</span> {{$candidate['company']}}</li>
				<li><span>职位:</span> {{$candidate['position']}}</li>
				<li><span>简历:</span> {{$candidate['resumes']}}</li>
				<li><span>简历来源:</span> {{$candidate['cvsite']}}</li>
				<li><span>简历编号:</span> {{$candidate['cvNO']}}</li>
				<li><span>简历地址:</span> {{$candidate['cvPath']}}</li>
				<li><span>QQ:</span> {{$candidate['QQ']}}</li>
				<li><span>微信:</span> {{$candidate['wechat']}}</li>
				<li><span>标签:</span> {{$candidate['label']}}</li>
				<li><span>说明:</span> {{$candidate['notes']}}</li>
				</ul>
			</div>
		</div>

		<div class="tab-pane" id="ca_tab_2_{{$tName}}" style="min-height: 500px;">
			<div id='projList'>
				@include('mwork.project.part_list')
			</div>

		</div>

		<div class="tab-pane" id="ca_tab_3_{{$tName}}" style="min-height: 500px;">

			<div class='well'>
				<input type="input" class="m-wrap span10" placeholder="" id='content_comment' name='content_comment'>
				<button class="btn blue" onclick='submitComment()'>备注</button>
			
			</div>
			<div class='well profile-classic' id='comment'>
				@include('mwork.candidate.part_comment')
			</div>
		</div>

		<div class="tab-pane" id="ca_tab_5_{{$tName}}" style="min-height: 500px;">
			
			
			<div class='well'>
				<button>保存</button>
			</div>

			<div class='well'>
				TODO:预览控件
			</div>
		</div>

	</div>

</div>

<!--END TABS-->

<script type="text/javascript">
function submitComment()
{
	var urlTo = '/candidate/comment/' + $('#ca_id').val() + '/' + $('#content_comment').val() + '/0';
	$.ajax({
			type:'GET',
			url:urlTo,
			data:getFormJson(this),
			success: function(d){
				$('#comment').html(d);
			}
		});
}

function onClickComment()
{
	$('#candidate_detail_tab a[href="#ca_tab_3_{{$tName}}"]').tab('show');  
}

function onClickProject()
{
	$('#candidate_detail_tab a[href="#ca_tab_2_{{$tName}}"]').tab('show');  
}

function onClickUpdateStep()
{
	var urlTo = '/project/step/'+ $('#proj_id').val() + '/'+ $('#ca_id').val() +'/' + $('#step_value').val() + '/' + $('#update_step_input').val() ;
	$.ajax({
			type:'GET',
			url:urlTo,
			success: function(d){
				$('#projInfoList').html(d);
			}
		});
}

function onClickProjectD(projId)
{
	var urlTo = '/candidate/addProject/' + $('#proj_id').val() + '/'+ $('#ca_id').val();
	$.ajax({
			type:'GET',
			url:urlTo,
			success: function(r){
				$('#projList').html(r);
				$('#candidate_detail_tab a[href="#ca_tab_2_{{$tName}}"]').tab('show'); 
				$('#addProject').text('已加入'); 
				$('#addProject').attr('disabled', true);
				$('#addProject').addClass('grey');
			}
	});
}
</script>