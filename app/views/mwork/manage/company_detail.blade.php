<!--row-fluid start -->		
@if (isset($company))
		<div class="row-fluid">

		<div class="span6">
			<div class="well">	
			<h3>公司信息</h3>
			<address>
				<strong>公司名</strong><br>
				{{$company->chinesename}} | {{$company->englishname}}
			</address>
			<address>
				<strong>地址</strong><br>
				{{$company->location}} | {{$company->province}}
			</address>
			<address>
				<strong>所属行业</strong><br>
				{{Datavalue::getvalue('industry', $company->industry)->text}}
			</address>
			</div>
		</div>
		<div class="span6">
			<!--well start -->
			<div class="well">	
				<h3>联系人</h3>

				<div class="row-fluid">
					<div class="span5">
						<address>
						<strong>中文名</strong><br>
						{{$company->linkman_chinesename}}
					</address>
					</div>

					<div class="span5">

					<address>
						<strong>英文名</strong><br>
						{{$company->linkman_englishname}}
					</address></div>
				</div>

				<div class="row-fluid">

					<div class="span5">
						<address>
						<strong>移动电话</strong><br>
						{{$company->linkman_mobile}}
					</address>
					</div>
					<div class="span5">

					<address>
						<strong>固定电话</strong><br>
						{{$company->linkman_tel}}
					</address>
					</div>
				</div>
		
				<div class="row-fluid">

					<div class="span5">
						<address>
						<strong>QQ</strong><br>
						{{$company->linkman_QQ}}
					</address>
					</div>
					<div class="span5">

					<address>
						<strong>邮箱</strong><br>
						{{$company->linkman_email}}
					</address>
					</div>
				</div>

			</div>
			<!--well end -->
		</div>
	</div>
	@endif