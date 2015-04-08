@extends('mwork.layouts.default')

@section('content')
    <div class="portlet box green">

	<div class="portlet-title">

		<div class="caption"><i class="icon-reorder"></i>客户管理</div>

		<div class="tools">

			<a href="javascript:;" class="collapse"></a>

			<a href="#portlet-config" data-toggle="modal" class="config"></a>

			<a href="javascript:;" class="reload"></a>

			<a href="javascript:;" class="remove"></a>

		</div>

	</div>


	<div class="portlet-body form">

		<!-- BEGIN FORM : client manange-->

		<form action="#" class="form-horizontal">
			<h3 class="form-section">新增</h3>
			<!--/row-->
			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">公司</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="阿里巴巴">

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">联系信息</label>

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

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">Owner</label>

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

						<label class="control-label">合同</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="上海...">

						</div>

					</div>

				</div>

				<!--/span-->

			</div>


			<div class="form-actions">

				<button type="submit" class="btn blue"><i class="icon-ok"></i> 保存</button>

				<button type="button" class="btn">清除</button>

			</div>

		</form>

		<!-- END FORM : client manage-->                

		<!-- BEGIN FORM : client list-->

		<div class="portlet-body">

			<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
				<thead>
					<tr>
						<th>公司</th>
						<th>联系方式</th>
						<th>Owner</th>
						<th>合同</th>
						<th>项目</th>
					</tr>
				</thead>
				<tbody>

					@foreach ($clients as $client)
					<tr>
						<td>{{$client['chinesename']}}</td>
						<td>{{$client['englishname']}}</td>
						<td>{{$client['city']}}</td>
						<td>{{$client['location']}}</td>
						<td>{{$client['industry']}}</td>
					</tr>

					@endforeach
					
				</tfoot>

				</tbody>
			</table>
			<ul class="pagination">
			{{$clients->links()}}
			</ul>
			</div>

		<!-- END FORM : client list-->   
	</div>
</div>
@stop