@extends('mwork.layouts.default')

@section('content')
  <!-- BEGIN PAGE CONTENT-->

	<div class="row-fluid">

		<div class="span12">

			<!-- BEGIN EXAMPLE TABLE PORTLET-->

			<div class="portlet box green">

				<div class="portlet-title">

					<div class="caption"><i class="icon-globe"></i>候选人列表</div>

					<div class="tools">

						<a href="javascript:;" class="reload"></a>

						<a href="javascript:;" class="remove"></a>

					</div>

				</div>

				<div class="portlet-body">
					@include('mwork.layouts.candidate')
				</div>

			</div>

			<!-- END EXAMPLE TABLE PORTLET-->

		</div>

	</div>

	<!-- END PAGE CONTENT-->
				
@stop