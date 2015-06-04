@if (isset($project))
<div class="tabbable tabbable-custom">

<ul class="nav nav-tabs">

	<li class="active"><a href="#subtab_1_1" data-toggle="tab">项目需求</a></li>

	<li class=""><a href="#subtab_1_2" data-toggle="tab">项目进度</a></li>

	<li class=""><a href="#subtab_1_3" data-toggle="tab">项目后期</a></li>

</ul>

<div class="tab-content">

	<div class="tab-pane active" id="subtab_1_1">

	<div class="portlet ">
	<div class="portlet-title">

	<div class="caption"><i class="icon-cogs"></i>项目信息(优先级)</div>

	<div class="tools">

		<a href="javascript:;" class="collapse"></a>

	</div>

	</div>

	<div class="portlet-body">
		
		@include('mwork.manage.company_detail')
		
		<div class="row-fluid">
			<div class="span6">
				<div class="well">
					<h3>项目内容</h3>
					<div class="row-fluid">

					<div class="span5">
						<address>
						<strong>职位名</strong><br>
						{{$project->position_name}}
					</address>
					</div>
					<div class="span5">

					<address>
						<strong>工作地址</strong><br>
						{{$project->location}}
					</address></div>
					</div>

					<div class="row-fluid">

						<div class="span5">
							<address>
							<strong>工作描述</strong><br>
							{{$project->desc}}
						</address>
						</div>
						<div class="span5">

						<address>
							<strong>需求人数</strong><br>
							{{$project->head_count}}
						</address>
						</div>
					</div>

					<div class="row-fluid">

						<div class="span5">
							<address>
							<strong>年收入</strong><br>
							{{$project->income}}万
						</address>
						</div>
						<div class="span5">

						<address>
							<strong>服务费率</strong><br>
							{{$project->fee}}%
						</address></div>
					</div>
			

					<div class="row-fluid">

						<div class="span5">
							<address>
							<strong>开始时间</strong><br>
							{{$project->starttime}}
						</address>
						</div>
						<div class="span5">

						<address>
							<strong>截止时间</strong><br>
							{{$project->endtime}}
						</address></div>
					</div>
			</div>
		</div>		
		</div>
		
</div>

				<div class="portlet ">
					<div class="portlet-title">

					<div class="caption"><i class="icon-cogs"></i>项目团队</div>

					<div class="tools">

						<a href="javascript:;" class="collapse"></a>

					</div>

					</div>

					<div class="portlet-body">
						
						<div class="well">

						<h4>项目负责人</h4>

						{{$project->team_id}}

						</div>

						<div class="well">

						<h4>团队贡献</h4>

						</div>
						

					</div>
					</div>
					
			</div>
		</div>

				<div class="tab-pane" id="subtab_1_2">

					<div class="portlet ">

					<div class="portlet-title">

						<div class="caption"><i class="icon-cogs"></i>说明</div>

						<div class="tools">

							<a href="javascript:;" class="collapse"></a>

						</div>

					</div>
					

					<div class="portlet-body">
						
						<address>
						<strong>摘要</strong><br>
						{{$project->desc}}
					</address>
					

					</div>
					</div>

					<div class="portlet ">

					<div class="portlet-title">

						<div class="caption"><i class="icon-cogs"></i>候选人筛选
							<button class="btn purple">候选人添加 <i class="m-icon-swapright m-icon-white"></i></button>

						</div>

						<div class="tools">
							

							<a href="javascript:;" class="collapse"></a>

						</div>

					</div>

					<div class="portlet-body">
						
						<ul class="nav nav-tabs">
							<li class="active"><a href="#ctab_1_1" data-toggle="tab">候选人列表</a></li>
							<li><a href="#ctab_1_2" data-toggle="tab">候选人搜索</a></li>
						</ul>

						<div class="tab-content">
							<div class="tab-pane row-fluid active" id="ctab_1_1">
								@include('mwork.project.part_candidate_list')
							</div>

							<div class="tab-pane row-fluid" id="ctab_1_2">
								@include('mwork.candidate.part_search')
							<div id='candidate_list'>
							</div>
							</div>
						</div>
					</div>

				</div>
				</div>

				<div class="tab-pane" id="subtab_1_3">
					<div class="portlet ">

					<div class="portlet-title">

						<div class="caption"><i class="icon-cogs"></i>项目总结</div>

						<div class="tools">

							<a href="javascript:;" class="collapse"></a>

						</div>

					</div>

					<div class="portlet-body">
						xxx
					</div>

				</div>

				<div class="portlet ">

					<div class="portlet-title">

						<div class="caption"><i class="icon-cogs"></i>项目统计</div>

						<div class="tools">

							<a href="javascript:;" class="collapse"></a>

						</div>

					</div>

					<div class="portlet-body">
						
						
						
						xxx

					</div>

				</div>

				<div class="portlet ">

					<div class="portlet-title">

						<div class="caption"><i class="icon-cogs"></i>项目统计</div>

						<div class="tools">

							<a href="javascript:;" class="collapse"></a>

						</div>

					</div>

					<div class="portlet-body">
						付款信息
						项目统计
						后期跟踪
						

					</div>

				</div>
				</div>

				</div>

				


				</div>
				@endif