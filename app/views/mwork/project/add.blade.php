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

		<form action="#" class="form-horizontal">

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">中文名</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="张无忌">

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">英文名</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="Justin Zhang">

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

							<select class="m-wrap span12">

								<option value="">男</option>

								<option value="">女</option>

							</select>

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">出生日期</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="mm/yyyy">

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

							<input type="text" class="m-wrap span12" placeholder="">

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">固定电话</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="">

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

							<select class="m-wrap span12">

								<option value="">上海</option>

								<option value="">北京</option>

							</select>

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">所在城市</label>

						<div class="controls">

							<select class="m-wrap span12">

								<option value="1">上海</option>
								<option value="2">北京</option>
								<option value="3">广州</option>
								<option value="4">深圳</option>

							</select>

						</div>

					</div>

				</div>

				<!--/span-->

			</div>
			
			<!--/row-->  

			<!--/row-->                   

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">当前职位</label>

						<div class="controls">

							<select class="m-wrap span12">

								<option value="1">软件工程师</option>
								<option value="2">高级软件工程师</option>
								<option value="3">技术研究员</option>
								<option value="4">CTO</option>

							</select>

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">所在公司</label>

						<div class="controls">

							<input type="text" class="m-wrap span12"> 

						</div>

					</div>

				</div>

				<!--/span-->

			</div>

			<!--/row-->

			<div class="form-actions">

				<button type="submit" class="btn blue"><i class="icon-ok"></i> 保存</button>

			</div>

		</form>

		<!-- END FORM-->                

	</div>
</div>
@stop