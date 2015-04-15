@extends('mwork.layouts.default')

@section('content')


<div class="portlet box green">

	<div class="portlet-title">

		<div class="caption"><i class="icon-reorder"></i>职位管理</div>

		<div class="tools">

			<a href="javascript:;" class="collapse"></a>

			<a href="#portlet-config" data-toggle="modal" class="config"></a>

			<a href="javascript:;" class="reload"></a>

			<a href="javascript:;" class="remove"></a>

		</div>

	</div>

	<div class="portlet-body form">

		<!-- BEGIN FORM : position manange-->

		<form action="#" class="form-horizontal">

			<h3 class="form-section">新增</h3>

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">中文名称</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="软件工程师">

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">English Name</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="Software Engineer">

						</div>

					</div>

				</div>

				<!--/span-->

			</div>

			<!--/row-->

			<div class="form-actions">

				<button type="submit" class="btn blue"><i class="icon-ok"></i> 保存</button>

				<button type="button" class="btn">清除</button>

			</div>

		</form>

		<!-- END FORM : position manage-->   
	</div>
</div>
@stop