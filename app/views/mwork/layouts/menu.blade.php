<!-- BEGIN SIDEBAR -->

	<div class="page-sidebar nav-collapse collapse">

		<!-- BEGIN SIDEBAR MENU -->        

		<ul class="page-sidebar-menu">

			<li>

				<!-- BEGIN SIDEBAR TOGGLER BUTTON -->

				<div class="sidebar-toggler hidden-phone"></div>

				<!-- BEGIN SIDEBAR TOGGLER BUTTON -->

			</li>

			<li>

				<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->

				<form class="sidebar-search">

					<div class="input-box">

						<a href="/bootstrap2/javascript:;" class="remove"></a>

						<input type="text" placeholder="Search..." />

						<input type="button" class="submit" value=" " />

					</div>

				</form>

				<!-- END RESPONSIVE QUICK SEARCH FORM -->

			</li>

			<li class="start ">

				<a href="/">

				<i class="icon-home"></i> 

				<span class="title">桌面</span>

				<span class="selected"></span>

				</a>

			</li>

			<li id="id_candidate">

				<a href="javascript;">

				<i class="icon-cogs"></i> 

				<span class="title active">候选人</span>

				<span class="arrow "></span>

				</a>

				<ul class="sub-menu">

					<li id="id_candidate_list">

						<a href="/candidate">

						列表</a>

					</li>

					<li id="id_candidate_add">

						<a href="/candidate/add">

						新增</a>

					</li>

					<li id="id_candidate_manage">

						<a href="/candidate/manage">

						管理</a>

					</li>

				</ul>


			</li>

			
			<li id="id_project">

				<a href="/bootstrap2/javascript:;">

				<i class="icon-bookmark-empty"></i> 

				<span class="title">项目</span>

				<span class="arrow "></span>

				</a>

				<ul class="sub-menu">

					<li id="id_project_my">

						<a href="/project">

						我的项目</a>

					</li>

					<li id="id_project_manage">

						<a href="/project/manage">

						项目管理</a>

					</li>

				</ul>

			</li>

			<li id="id_client">

				<a href="/bootstrap2/javascript:;">

				<i class="icon-table"></i> 

				<span class="title">客户</span>

				<span class="arrow "></span>

				</a>

				<ul class="sub-menu">

					<li id="id_client_my">

						<a href="/client">

						我的客户</a>

					</li>

					<li id="id_client_manage">

						<a href="/client/manage">

						客户管理</a>

					</li>

				</ul>

			</li>

			<li id="id_plane">

				<a href="/bootstrap2/javascript:;">

				<i class="icon-briefcase"></i> 

				<span class="title">计划</span>

				<span class="arrow "></span>

				</a>

				<ul class="sub-menu">

				</ul>

			</li>

			<li id="id_team">

				<a href="/bootstrap2/javascript:;">

				<i class="icon-gift"></i> 

				<span class="title">团队</span>

				<span class="arrow "></span>

				</a>

				<ul class="sub-menu">

					<li id="id_team_my">

						<a href="/team">

						我的团队</a>

					</li>

					<li id="id_team_manage">

						<a href="/team/manage">

						团队管理</a>

					</li>
				</ul>

			</li>

			<li id="id_manage">

				<a href="javascript;">

				<i class="icon-cogs"></i> 

				<span class="title">管理</span>

				<span class="arrow "></span>

				</a>

				<ul class="sub-menu">

					<li id="id_manage_company">

						<a href="/manage/company">

						公司</a>

					</li>

					<li id="id_manage_position">

						<a href="/manage/position">

						职位</a>

					</li>
					<li id="id_manage_user">
						<a href="/manage/user">

						用户</a>

					</li>

					<li id="id_manage_role">
						<a href="/manage/role">

						权限</a>

					</li>
					

				</ul>


			</li>

		</ul>

		<!-- END SIDEBAR MENU -->

	</div>
	@section('menuScripts')
	<script type="text/javascript">
		$(document).ready(function() {
				$("#{{$BigTitle}}").addClass("active");
		  		$("#{{$SmallTitle}}").addClass("active");
		});
	</script>
	@stop