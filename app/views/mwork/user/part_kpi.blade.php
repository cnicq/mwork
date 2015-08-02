@if ($tab == 'kpi')
<div class="row-fluid">
				<div class="span12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->

					<div class="portlet box purple">

						<div class="portlet-title">

							<div class="caption"><i class="icon-comments"></i>月报 {{$year}} - {{$month}}</div>

							<div class="tools">
								<button class="btn" id="curMonth"> 本月</button>
								<button  class="btn"id="prevMonth"><i class="icon-plus"></i> 前一月</button>
								<button class="btn" id="nextMonth"><i class="icon-plus"></i> 后一月</button>
								
							</div>

						</div>
						
						<div class="portlet-body">

							<table class="table table-striped table-hover">
								<thead>
									<tr>

										<th>日期</th>
										<th>推荐数量</th>
										<th>面试数量</th>
										<th>跟进数量</th>
										<th>录入简历数量</th>
										<th>Cold Call数量</th>
										<th>完成情况</th>
										<th>评价</th>

									</tr>

								</thead>

								<tbody>

									@foreach ($kpis as $kpi)
									<tr>
										<td>星期{{$kpi['weekday']}} - {{$kpi['day']}}</td>
										<td>{{$kpi['recommend']}}</td>
										<td>{{$kpi['interview']}}</td>
										<td>{{$kpi['comment']}}</td>
										<td>{{$kpi['cv']}}</td>
										<td>{{$kpi['cc']}}</td>
										<td><span class="label label-success">Approved</span></td>
										<th><span class="label label-success">Approved</span></th>
									</tr>

									@endforeach

								</tbody>

							</table>

						</div>

					</div>

					<!-- END SAMPLE TABLE PORTLET-->

				</div>
			</div>
<script src="/bootstrap2/media/js/jquery-1.10.1.min.js" type="text/javascript"></script>
<script type="text/javascript">

		jQuery(document).ready(function() {       
		  	var year = {{$year}};
		  	var month = {{$month}};

		  	$('#prevMonth').click(function(){
		  		if(month == 1)
		  		{
		  			year -= 1;
		  			month = 12;
		  		}
		  		else
		  		{
		  			month -= 1;
		  		}
		  		location.href = "/user/kpi/{{$user->id}}/" +year+ "/" + month;
		  	});

		  	$('#nextMonth').click(function(){
		  		if(month == 12)
		  		{
		  			year += 1;
		  			month = 1;
		  		}
		  		else
		  		{
		  			month += 1;
		  		}

		  		location.href = "/user/kpi/{{$user->id}}/" +year+ "/" + month;
		  	});

		  	$('#curMonth').click(function(){
		  		 location.href ="/user/kpi/{{$user->id}}/0/0";
		  	});

		});

	</script>
			@endif