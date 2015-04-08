@extends('mwork.layouts.default')

@section('content')
    <div class="portlet box green">

	<div class="portlet-title">

		<div class="caption"><i class="icon-reorder"></i>公司管理</div>

		<div class="tools">

			<a href="javascript:;" class="collapse"></a>

			<a href="#portlet-config" data-toggle="modal" class="config"></a>

			<a href="javascript:;" class="reload"></a>

			<a href="javascript:;" class="remove"></a>

		</div>

	</div>


	<div class="portlet-body form">

		<!-- BEGIN FORM : company manange-->

		<form action="#" class="form-horizontal">
			<h3 class="form-section">新增</h3>

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">中文名称</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="阿里巴巴">

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">English Name</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="Alibaba">

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

								<option value="1">上海</option>
								<option value="2">北京</option>
								<option value="3">广州</option>
								<option value="4">深圳</option>

							</select>

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">详细地址</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="上海...">

						</div>

					</div>

				</div>

				<!--/span-->

			</div>

			<!--/row-->        

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">行业</label>

						<div class="controls">

							<select class="m-wrap span12">

								<option value="1">互联网/移动互联网</option>
								<option value="2">游戏</option>
								<option value="3">传统IT</option>
								<option value="4">金融互联网</option>

							</select>
						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">是否有合同</label>

						<div class="controls">                                                

							<label class="radio">

							<div class="radio"><span><input type="radio" name="optionsRadios2" value="option1"></span></div>

							是

							</label>

							<label class="radio">

							<div class="radio"><span class="checked"><input type="radio" name="optionsRadios2" value="option2" checked=""></span></div>

							否

							</label>  

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

		<!-- END FORM : company manage-->                

		<!-- BEGIN FORM : company list-->

		<div class="portlet-body">

			<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
				<thead>
					<tr>
						<th>中文名</th>
						<th>英文名</th>
						<th>城市</th>
						<th>详细地址</th>
						<th>行业</th>
						<th>是否有合同</th>
					</tr>
				</thead>
				<tbody>

					@foreach ($companys as $company)
					<tr>
						<td>{{$company['chinesename']}}</td>
						<td>{{$company['englishname']}}</td>
						<td>{{$company['city']}}</td>
						<td>{{$company['location']}}</td>
						<td>{{$company['industry']}}</td>
						<td>{{$company['contract']}}</td>
					</tr>

					@endforeach
					
				</tfoot>

				</tbody>
			</table>
			<ul class="pagination">
			{{$companys->links()}}
			</ul>
			</div>

		<!-- END FORM : company list-->   
	</div>
</div>
@stop