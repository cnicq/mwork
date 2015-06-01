@extends('mwork.layouts.default')

@section('content')
    <div class="portlet box green">

	<div class="portlet-title">

		<div class="caption"><i class="icon-reorder"></i>新增候选人</div>

		<div class="tools">

			<a href="javascript:;" class="collapse"></a>

			<a href="#portlet-config" data-toggle="modal" class="config"></a>

			<a href="javascript:;" class="reload"></a>

			<a href="javascript:;" class="remove"></a>

		</div>

	</div>

	<div class="portlet-body form">

		<!-- BEGIN FORM-->

		<form action="#"  method="POST" class="form-horizontal">
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			<input type="hidden" class="m-wrap span12" placeholder="" id='hometown' name='hometown'>
			<input type="hidden" class="m-wrap span12" placeholder="" id='label' name='label'>
			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">中文名</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="张无忌" id='chinesename' name='chinesename'>

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">英文名</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="Justin Zhang" id='englishname' name='englishname'> 

						</div>

					</div>

				</div>

				<!--/span-->

			</div>

			<!--/row-->

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">性别</label>

						<div class="controls">

							<select class="m-wrap span12" id='gender' name='gender'>

								<option value="male">男</option>

								<option value="female">女</option>

							</select>

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">出生日期</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="1985-06-28" id='birthday' name='birthday'>

						</div>

					</div>

				</div>

				<!--/span-->

			</div>

			<!--/row-->        

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">婚姻状况</label>

						<div class="controls">

							<select class="m-wrap span12" id='maritalstatus' name='maritalstatus'>

								<option value="single">单身</option>

								<option value="married">已婚</option>

							</select>

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">工作状况</label>

						<div class="controls">

							<select class="m-wrap span12" id='status' name='status'>

								<option value="work">在职</option>

								<option value="free">离职</option>

							</select>

						</div>

					</div>

				</div>

				<!--/span-->

			</div>

			<!--/row-->   
			

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">所在城市</label>

						<div class="controls">

							<select class="m-wrap span6" id='city' name='city'>
							<option> 请选择...</option>
							@foreach ($citys as $city)
								<option value='{{$city->name}}'> {{$city->text}} </option>
							@endforeach
							</select>
							<button class="btn purple" onclick="location.href=/companys">新增 <i class="m-icon-swapright m-icon-white"></i></button>
							<button class="btn blue" onclick="location.href=/companys">刷新 <i class="m-icon-swapright m-icon-white"></i></button>

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">详细地址</label>

						<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="" id='location' name='location'>

						</div>

					</div>

				</div>

				<!--/span-->

			</div>
			
			<!--/row-->               

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">当前职位</label>

						<div class="controls">

							<select class="m-wrap span6" id='position' name='position'>
							<option> 请选择...</option>
							@foreach ($positions as $position)
								<option value='{{$position->name}}'> {{$position->text}} </option>
							@endforeach
							</select>
							<button class="btn purple" onclick="location.href=/companys">新增 <i class="m-icon-swapright m-icon-white"></i></button>
							<button class="btn blue" onclick="location.href=/companys">刷新 <i class="m-icon-swapright m-icon-white"></i></button>
						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">所在公司</label>

						<div class="controls">

							<select class="m-wrap " id='company' name='company'>
								<option>请选择...</option>
								@foreach ($companys as $company)
								<option value='{{$company->id}}' linkman='{{$company->linkman_chinesename}}|{{$company->linkman_englishname}}'> {{$company->chinesename}} </option>
								@endforeach
							</select>
							<button class="btn purple" onclick="location.href=/companys">新增 <i class="m-icon-swapright m-icon-white"></i></button>
							<button class="btn blue" onclick="location.href=/companys">刷新 <i class="m-icon-swapright m-icon-white"></i></button>
						</div>

					</div>

				</div>

				<!--/span-->

			</div>

			<!--/row-->

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">移动电话</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="" id='mobile' name='mobile'>

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">固定电话</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="" id='tel' name='tel'>

						</div>

					</div>

				</div>

				<!--/span-->

			</div>

			<!--/row-->   

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">Email</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="" id='email' name='email'>

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">年薪(万)</label>

						<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="" id='income' name='income'>

						</div>

					</div>

				</div>

				<!--/span-->

			</div>
			
			<!--/row-->  

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">QQ</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="" id='QQ' name='QQ'>

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">微信</label>

						<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="" id='wechat' name='wechat'>

						</div>

					</div>

				</div>

				<!--/span-->

			</div>
			
			<!--/row-->  
			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">简历来源</label>

						<div class="controls">

							<select class="m-wrap span6" id='cvsite' name='cvsite'>
							<option> 请选择...</option>
							@foreach ($cvsites as $site)
								<option value='{{$site->name}}'> {{$site->text}} </option>
							@endforeach
							</select>
							<button class="btn purple" onclick="location.href=/companys">新增 <i class="m-icon-swapright m-icon-white"></i></button>
							<button class="btn blue" onclick="location.href=/companys">刷新 <i class="m-icon-swapright m-icon-white"></i></button>

						</div>

					</div>

				</div>


				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">简历编号</label>

						<div class="controls">
								<input type="text" class="m-wrap span12" placeholder="" id='cvNO' name='cvNO'>

						</div>

					</div>

				</div>

				<!--/span-->

			</div>
			
			<!--/row-->  

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">上传简历</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="" id='resumes' name='resumes'>

						</div>

					</div>

				</div>


				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">备注</label>

						<div class="controls">

							<textarea class="span6 m-wrap" rows="3" id='notes' name='notes'></textarea>

						</div>

					</div>

				</div>


				<!--/span-->

			</div>
			
			<!--/row-->  

			<div class="form-actions">

				<button type="submit" class="btn blue"><i class="icon-ok"></i> 提交</button>

			</div>

		</form>

		<!-- END FORM-->                

	</div>
</div>
@stop