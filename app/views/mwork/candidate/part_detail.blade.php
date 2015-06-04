<!--BEGIN TABS-->

<div class="tabbable tabbable-custom tabs-left" id="candidate_detail_tab">

	<div class="alert alert-block alert-info fade in">
		@if (Candidate::InProject($projId, $caId))
			<button class="btn gray" disabled>已加入</button>
		@elseif ($projId != 0)
			<button class="btn blue" onclick='onClickProjectD({{$projId}})'>加入项目</button>
		@else
			<button class="btn blue" onclick='onClickProject()'>加入项目</button>
		@endif
		<button class="btn blue" onclick='onClickComment()'>添加备注</button>
	</div>
	<!-- Only required for left/right tabs -->

	<ul class="nav nav-tabs tabs-left">

		<li class="active"><a href="#ca_tab_1" data-toggle="tab">详细资料</a></li>
		<li class=""><a href="#ca_tab_2" data-toggle="tab">参与项目</a></li>
		<li class=""><a href="#ca_tab_3" data-toggle="tab">备注记录</a></li>
		<input type="hidden" class="m-wrap span12" placeholder="" id='ca_id' name='ca_id' value='{{$caId}}'>
		<input type="hidden" class="m-wrap span12" placeholder="" id='proj_id' name='proj_id' value='{{$projId}}'>
	</ul>

	<div class="tab-content">

		<div class="tab-pane active" id="ca_tab_1" style="min-height: 500px;">
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
				<li><span>移动电话:</span> {{$candidate['mobile']}}</li>
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

		<div class="tab-pane" id="ca_tab_2" style="min-height: 500px;">
			<div class='well profile-classic' id='projList'>
				@include('mwork.project.part_list')
			</div>

		</div>

		<div class="tab-pane" id="ca_tab_3" style="min-height: 500px;">

			<div class='well'>
				<input type="input" class="m-wrap span10" placeholder="" id='content' name='content'>
				<button class="btn blue" onclick='submitComment()'>备注</button>
			
			</div>
			<div class='well profile-classic' id='comment'>
				@include('mwork.candidate.part_comment')
			</div>
		</div>

	</div>

</div>

<!--END TABS-->

<script type="text/javascript">
function submitComment()
{
	var urlTo = '/candidate/comment/' + $('#ca_id').val() + '/' + $('#content').val() + '/0';
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
	$('#candidate_detail_tab a[href="#ca_tab_3"]').tab('show');  
}

function onClickProject()
{
	$('#candidate_detail_tab a[href="#ca_tab_2"]').tab('show');  
}

function onClickProjectD(projId)
{
	var urlTo = '/candidate/addProject/' + $('#proj_id').val() + '/'+ $('#ca_id').val();
	$.ajax({
			type:'GET',
			url:urlTo,
			data:getFormJson(this),
			success: function(r){
				if(r =='error'){
					alert('错误');
				}
				else{
					$('#projList').html(r);
					$('#candidate_detail_tab a[href="#ca_tab_2"]').tab('show');  	
				}
			}
	});
}
</script>