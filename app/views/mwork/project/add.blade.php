@extends('mwork.layouts.default')

@section('content')
    <div class="main">
			<div class="categroy">
				<div class="left"><h3>Project | Add</h3></div>
				<div class="right fold" id="project" onclick="ut_toggle('project')"></div>
				<div class="clear"></div>
			</div>
			
			<div class="container" id="t_project">
				<div class="project">
					<form action="?m=project&amp;c=project&amp;a=add" method="post" id="projectAdd" enctype="multipart/form-data" novalidate="novalidate">
					<table>
						<tbody><tr>
							<td style="10%">Company Name<span class="red">*</span></td><td class="default" style="40%">
								<select name="company" id="company" validate="required:true" class="valid">
										<option value="">Please select</option>
																			<option value="21世纪房地产" cmid="139">21世纪房地产</option>
																			<option value="Amazon" cmid="99">Amazon</option>
																			<option value="AMD" cmid="91">AMD</option>
																			<option value="App Annie" cmid="97">App Annie</option>
																			<option value="Apple China" cmid="68">Apple China</option>
																			<option value="Apple Retail" cmid="19">Apple Retail</option>
																			<option value="Apple-APO" cmid="95">Apple-APO</option>
																			<option value="Audatex" cmid="23">Audatex</option>
																			<option value="Autodesk  欧特克软件 ( 中国 ) 有限公司--北京" cmid="13">Autodesk  欧特克软件 ( 中国 ) 有限公司--北京</option>
																			<option value="Autodesk  欧特克软件 ( 中国 ) 有限公司--上海" cmid="14">Autodesk  欧特克软件 ( 中国 ) 有限公司--上海</option>
																			<option value="Barco巴可伟视（北京）电子有限公司" cmid="44">Barco巴可伟视（北京）电子有限公司</option>
																			<option value="Bytemobile 拜特优码通讯技术（北京）有限公司" cmid="25">Bytemobile 拜特优码通讯技术（北京）有限公司</option>
																			<option value="Cellon 赛龙" cmid="85">Cellon 赛龙</option>
																			<option value="Coach" cmid="98">Coach</option>
																			<option value="Coca-Cola 可口可乐饮料（上海）有限公司" cmid="26">Coca-Cola 可口可乐饮料（上海）有限公司</option>
																			<option value="CSDN 北京创新乐知信息技术有限公司" cmid="27">CSDN 北京创新乐知信息技术有限公司</option>
																			<option value="DC Alliance" cmid="167">DC Alliance</option>
																			<option value="Dell 戴尔(中国)有限公司--北京" cmid="3">Dell 戴尔(中国)有限公司--北京</option>
																			<option value="Dell 戴尔(中国)有限公司--广州" cmid="6">Dell 戴尔(中国)有限公司--广州</option>
																			<option value="Dell 戴尔(中国)有限公司--上海" cmid="4">Dell 戴尔(中国)有限公司--上海</option>
																			<option value="Dell 戴尔(中国)有限公司--厦门" cmid="5">Dell 戴尔(中国)有限公司--厦门</option>
																			<option value="DSM" cmid="62">DSM</option>
																			<option value="EA北京" cmid="15">EA北京</option>
																			<option value="EA上海" cmid="16">EA上海</option>
																			<option value="eBay" cmid="69">eBay</option>
																			<option value="EMC 易安信信息技术研发（北京）有限公司" cmid="1">EMC 易安信信息技术研发（北京）有限公司</option>
																			<option value="EMC 易安信信息技术研发（上海）有限公司" cmid="2">EMC 易安信信息技术研发（上海）有限公司</option>
																			<option value="Fairchild 飞兆半导体技术（北京）有限公司" cmid="28">Fairchild 飞兆半导体技术（北京）有限公司</option>
																			<option value="Giesecke &amp; Devrient" cmid="117">Giesecke &amp; Devrient</option>
																			<option value="Good Technology" cmid="42">Good Technology</option>
																			<option value="Gree" cmid="18">Gree</option>
																			<option value="GTCcommerce" cmid="164">GTCcommerce</option>
																			<option value="Happylatte (北京开心杯科技有限公司)" cmid="124">Happylatte (北京开心杯科技有限公司)</option>
																			<option value="Honeywell 霍尼韦尔(中国)有限公司" cmid="112">Honeywell 霍尼韦尔(中国)有限公司</option>
																			<option value="HP 北京惠普有限公司" cmid="7">HP 北京惠普有限公司</option>
																			<option value="HP 上海惠普有限公司" cmid="8">HP 上海惠普有限公司</option>
																			<option value="HP 中国惠普有限公司" cmid="9">HP 中国惠普有限公司</option>
																			<option value="Hulu" cmid="135">Hulu</option>
																			<option value="IDG" cmid="170">IDG</option>
																			<option value="Innopath 新诺派思软件（北京）有限公司" cmid="29">Innopath 新诺派思软件（北京）有限公司</option>
																			<option value="Intergraph鹰图系统（深圳）有限公司上海分公司" cmid="43">Intergraph鹰图系统（深圳）有限公司上海分公司</option>
																			<option value="Juniper" cmid="132">Juniper</option>
																			<option value="Kabam" cmid="92">Kabam</option>
																			<option value="Kohler China" cmid="41">Kohler China</option>
																			<option value="Lenovo 联想集团" cmid="108">Lenovo 联想集团</option>
																			<option value="Lexmark" cmid="81">Lexmark</option>
																			<option value="Loreal" cmid="121">Loreal</option>
																			<option value="Magnum 迈能（北京）半导体科技有限公司" cmid="30">Magnum 迈能（北京）半导体科技有限公司</option>
																			<option value="Moncler" cmid="106">Moncler</option>
																			<option value="MTR Corporation Limited" cmid="102">MTR Corporation Limited</option>
																			<option value="Philips 飞利浦" cmid="67">Philips 飞利浦</option>
																			<option value="Qualcomm" cmid="96">Qualcomm</option>
																			<option value="RMG Networks" cmid="79">RMG Networks</option>
																			<option value="Royal Canin China-West China Distribution Center" cmid="37">Royal Canin China-West China Distribution Center</option>
																			<option value="SAP北京" cmid="10">SAP北京</option>
																			<option value="SAP上海" cmid="11">SAP上海</option>
																			<option value="Servigistics Asia, Inc. 斯维智斯有限公司" cmid="24">Servigistics Asia, Inc. 斯维智斯有限公司</option>
																			<option value="Sogou 北京搜狐新媒体信息技术有限公司" cmid="31">Sogou 北京搜狐新媒体信息技术有限公司</option>
																			<option value="Successfactors" cmid="63">Successfactors</option>
																			<option value="Sumscope" cmid="123">Sumscope</option>
																			<option value="Symantec" cmid="12">Symantec</option>
																			<option value="Technopro 善誠科技発展(上海)有限公司" cmid="32">Technopro 善誠科技発展(上海)有限公司</option>
																			<option value="Thoughtworks" cmid="22">Thoughtworks</option>
																			<option value="Tod's 托德斯" cmid="105">Tod's 托德斯</option>
																			<option value="UAA" cmid="53">UAA</option>
																			<option value="UniNano" cmid="46">UniNano</option>
																			<option value="Unitop" cmid="72">Unitop</option>
																			<option value="Valspar" cmid="90">Valspar</option>
																			<option value="Ventyx" cmid="169">Ventyx</option>
																			<option value="VMware 威睿信息技术（中国）有限公司" cmid="33">VMware 威睿信息技术（中国）有限公司</option>
																			<option value="VMware 威睿信息技术（中国）有限公司上海分公司" cmid="34">VMware 威睿信息技术（中国）有限公司上海分公司</option>
																			<option value="Weidmuller" cmid="89">Weidmuller</option>
																			<option value="Wilmar International 丰益国际" cmid="94">Wilmar International 丰益国际</option>
																			<option value="Wyndham Hotel Group" cmid="125">Wyndham Hotel Group</option>
																			<option value="Yahoo" cmid="131">Yahoo</option>
																			<option value="（一号店）上海益实多电子商务有限公司" cmid="156">（一号店）上海益实多电子商务有限公司</option>
																			<option value="阿波罗消防" cmid="173">阿波罗消防</option>
																			<option value="阿里巴巴（中国）有限公司-阿里云" cmid="35">阿里巴巴（中国）有限公司-阿里云</option>
																			<option value="阿里巴巴（中国）有限公司-集团" cmid="150">阿里巴巴（中国）有限公司-集团</option>
																			<option value="阿里巴巴（中国）有限公司-淘宝网" cmid="103">阿里巴巴（中国）有限公司-淘宝网</option>
																			<option value="阿里巴巴（中国）有限公司-淘系北京" cmid="110">阿里巴巴（中国）有限公司-淘系北京</option>
																			<option value="阿里巴巴（中国）有限公司-天猫商城" cmid="100">阿里巴巴（中国）有限公司-天猫商城</option>
																			<option value="阿里巴巴（中国）有限公司-云OS" cmid="113">阿里巴巴（中国）有限公司-云OS</option>
																			<option value="阿里巴巴（中国）有限公司-支付宝" cmid="38">阿里巴巴（中国）有限公司-支付宝</option>
																			<option value="安博教育" cmid="64">安博教育</option>
																			<option value="安弗柯林" cmid="130">安弗柯林</option>
																			<option value="百事（中国）投资有限公司" cmid="152">百事（中国）投资有限公司</option>
																			<option value="北京爱社时代科技发展有限公司" cmid="87">北京爱社时代科技发展有限公司</option>
																			<option value="北京富力地产" cmid="172">北京富力地产</option>
																			<option value="北京华德创业环保设备公司" cmid="104">北京华德创业环保设备公司</option>
																			<option value="北京乐宠科技有限公司" cmid="86">北京乐宠科技有限公司</option>
																			<option value="北京纳源丰科技发展有限公司" cmid="45">北京纳源丰科技发展有限公司</option>
																			<option value="北京锐美奇传媒科技有限公司" cmid="134">北京锐美奇传媒科技有限公司</option>
																			<option value="北京天鸿圆方建筑设计有限公司" cmid="54">北京天鸿圆方建筑设计有限公司</option>
																			<option value="北京亿玛在线科技有限公司" cmid="65">北京亿玛在线科技有限公司</option>
																			<option value="北京亿象天地科技有限公司" cmid="83">北京亿象天地科技有限公司</option>
																			<option value="北京云茂电子商务有限公司" cmid="129">北京云茂电子商务有限公司</option>
																			<option value="博朗软件开发（上海）有限公司" cmid="51">博朗软件开发（上海）有限公司</option>
																			<option value="春光地产" cmid="55">春光地产</option>
																			<option value="大连万达集团股份有限公司" cmid="73">大连万达集团股份有限公司</option>
																			<option value="大连万达商业地产股份有限公司" cmid="39">大连万达商业地产股份有限公司</option>
																			<option value="大唐电信科技股份有限公司" cmid="151">大唐电信科技股份有限公司</option>
																			<option value="当当网" cmid="78">当当网</option>
																			<option value="德国FTA建筑设计有限公司" cmid="163">德国FTA建筑设计有限公司</option>
																			<option value="鼎捷软件" cmid="146">鼎捷软件</option>
																			<option value="东方城" cmid="56">东方城</option>
																			<option value="东芝开利空调销售（上海）有限公司" cmid="114">东芝开利空调销售（上海）有限公司</option>
																			<option value="飞利浦医疗保健" cmid="52">飞利浦医疗保健</option>
																			<option value="凤凰网" cmid="107">凤凰网</option>
																			<option value="赶集网" cmid="36">赶集网</option>
																			<option value="广联达软件股份有限公司" cmid="101">广联达软件股份有限公司</option>
																			<option value="杭州乐港（JOYPORT）" cmid="147">杭州乐港（JOYPORT）</option>
																			<option value="杭州悠可化妆品有限公司" cmid="144">杭州悠可化妆品有限公司</option>
																			<option value="好耶集团" cmid="133">好耶集团</option>
																			<option value="湖北丝宝股份有限公司" cmid="148">湖北丝宝股份有限公司</option>
																			<option value="华夏幸福基业有限公司" cmid="40">华夏幸福基业有限公司</option>
																			<option value="华阳国际设计集团上海公司" cmid="168">华阳国际设计集团上海公司</option>
																			<option value="汇付天下" cmid="119">汇付天下</option>
																			<option value="捷成贸易" cmid="159">捷成贸易</option>
																			<option value="金茂凯德" cmid="115">金茂凯德</option>
																			<option value="凯德置地" cmid="57">凯德置地</option>
																			<option value="快威科技集团有限公司" cmid="165">快威科技集团有限公司</option>
																			<option value="联东集团" cmid="61">联东集团</option>
																			<option value="猎上网HunterOn" cmid="140">猎上网HunterOn</option>
																			<option value="灵禅" cmid="17">灵禅</option>
																			<option value="曼胡默尔" cmid="149">曼胡默尔</option>
																			<option value="美国ITW集团" cmid="157">美国ITW集团</option>
																			<option value="明宇置业" cmid="160">明宇置业</option>
																			<option value="欧迪芬精品内衣股份有限公司" cmid="77">欧迪芬精品内衣股份有限公司</option>
																			<option value="平安金融科技" cmid="141">平安金融科技</option>
																			<option value="平安金融科技咨询有限公司" cmid="158">平安金融科技咨询有限公司</option>
																			<option value="奇虎360" cmid="136">奇虎360</option>
																			<option value="起点创投" cmid="50">起点创投</option>
																			<option value="乾龙创投" cmid="49">乾龙创投</option>
																			<option value="热酷" cmid="21">热酷</option>
																			<option value="人人网" cmid="80">人人网</option>
																			<option value="软银中国有限公司" cmid="48">软银中国有限公司</option>
																			<option value="上海艾麒信息科技有限公司" cmid="154">上海艾麒信息科技有限公司</option>
																			<option value="上海动量软件技术有限公司" cmid="111">上海动量软件技术有限公司</option>
																			<option value="上海恺英网络科技有限公司" cmid="153">上海恺英网络科技有限公司</option>
																			<option value="上海珂润箱包制品有限公司" cmid="127">上海珂润箱包制品有限公司</option>
																			<option value="上海升和服饰有限公司" cmid="142">上海升和服饰有限公司</option>
																			<option value="上海禹容网络科技有限公司" cmid="143">上海禹容网络科技有限公司</option>
																			<option value="上海纵游网络技术有限公司 (DeNA China)" cmid="128">上海纵游网络技术有限公司 (DeNA China)</option>
																			<option value="时代天华投资有限公司" cmid="70">时代天华投资有限公司</option>
																			<option value="苏宁置地" cmid="71">苏宁置地</option>
																			<option value="泰禾集团" cmid="58">泰禾集团</option>
																			<option value="天津中科蓝鲸信息技术有限公司" cmid="76">天津中科蓝鲸信息技术有限公司</option>
																			<option value="通灵珠宝" cmid="155">通灵珠宝</option>
																			<option value="万达演艺文化管理有限公司" cmid="74">万达演艺文化管理有限公司</option>
																			<option value="万国数据有限公司" cmid="171">万国数据有限公司</option>
																			<option value="万海文化旅游投资股份有限公司" cmid="75">万海文化旅游投资股份有限公司</option>
																			<option value="网易有道" cmid="137">网易有道</option>
																			<option value="厦门三五互联股份有限公司" cmid="161">厦门三五互联股份有限公司</option>
																			<option value="厦门卓威体育用品有限公司" cmid="166">厦门卓威体育用品有限公司</option>
																			<option value="携程计算机技术(上海)有限公司" cmid="126">携程计算机技术(上海)有限公司</option>
																			<option value="新光阳业地产" cmid="59">新光阳业地产</option>
																			<option value="一点资讯" cmid="174">一点资讯</option>
																			<option value="易科信息技术有限公司" cmid="116">易科信息技术有限公司</option>
																			<option value="英培信息技术（上海）有限公司" cmid="145">英培信息技术（上海）有限公司</option>
																			<option value="云壤（北京）-北京精准科技有限公司" cmid="122">云壤（北京）-北京精准科技有限公司</option>
																			<option value="震撼集团震撼三维(上海)有限公司" cmid="120">震撼集团震撼三维(上海)有限公司</option>
																			<option value="中国化工集团" cmid="66">中国化工集团</option>
																			<option value="中国世纪新城投资集团" cmid="84">中国世纪新城投资集团</option>
																			<option value="中国私募股权投资家联盟" cmid="93">中国私募股权投资家联盟</option>
																			<option value="中惠熙元地产" cmid="60">中惠熙元地产</option>
																			<option value="中路集团" cmid="138">中路集团</option>
																			<option value="中锐地产集团" cmid="162">中锐地产集团</option>
																			<option value="中卫莱康科技发展（北京）有限公司" cmid="88">中卫莱康科技发展（北京）有限公司</option>
																			<option value="中影巴可（北京）电子有限公司" cmid="82">中影巴可（北京）电子有限公司</option>
																	</select>
								</td>
							<td style="10%">Job Title<span class="red">*</span></td>
							<td style="40%">
								<input type="text" class="txt" name="job" id="job"><br>
								如:CEO,CFO,COO,CTO,PM等请全部大写格式
							</td>
						</tr>
						
						<tr>
							<td>Head Count</td><td>
							<select name="count" class="valid">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								</select></td>
							<td>Job Location<span class="red">*</span></td><td class="location"><div style="position:relative;float:left;"><span style="margin-left:108px;width:18px;overflow:hidden;"><select name="country" id="country" style="margin-left:-108px;width:136px;" onchange="getChildSelect('province','country','inputselectprovince')" class="valid"><option value="2">America</option><option value="19">Australia</option><option value="26">Belgium</option><option value="4">Britain</option><option value="21">Canada</option><option value="1" selected="selected">China</option><option value="15">France</option><option value="7">Germany</option><option value="5">HongKong</option><option value="13">India</option><option value="8">Italy</option><option value="6">Japan</option><option value="11">Korea</option><option value="12">Macao</option><option value="9">Malaysia</option><option value="25">New Zealand</option><option value="24">Philippines</option><option value="17">Portugal</option><option value="14">Russia</option><option value="20">Singapore</option><option value="16">Spain</option><option value="22">Sweden</option><option value="18">Switzerland</option><option value="3">TaiWan</option><option value="10">Thailand</option></select></span><input name="select_text" style="width:108px;position:absolute;left:0px;" id="country_2" value="China" autocomplete="off" class="ac_input"><script>selectAutoComplete('country_2','?m=ajax&c=data&a=auto_country',true,136);</script></div><div id="box_province" style="float:left;"><div style="position:relative;"><span style="margin-left:108px;width:18px;overflow:hidden;"><select name="province" id="province" style="margin-left:-108px;width:136px;" onchange="getChildSelect('city','province','inputselectcity')" class="valid"><option value="">Please Select</option><option value="13">AnHui</option><option value="1" selected="selected">BeiJing</option><option value="4">ChongQing</option><option value="14">FuJian</option><option value="21">GanSu</option><option value="20">GuangDong</option><option value="29">GuangXi</option><option value="24">GuiZhou</option><option value="25">HaiNan</option><option value="5">HeBei</option><option value="10">HeiLongJiang</option><option value="17">HeNan</option><option value="18">HuBei</option><option value="19">HuNan</option><option value="11">JiangSu</option><option value="15">JiangXi</option><option value="9">JiLin</option><option value="8">LiaoNing</option><option value="33">NeiMengGu</option><option value="31">NingXia</option><option value="27">QingHai</option><option value="28">Shananxi</option><option value="16">ShanDong</option><option value="3">ShangHai</option><option value="6">ShanXi</option><option value="22">SiChuan</option><option value="7">TaiWan</option><option value="2">TianJin</option><option value="30">XiCang</option><option value="32">XinJiang</option><option value="26">YunNan</option><option value="12">ZheJiang</option></select></span><input name="select_text" style="width:108px;position:absolute;left:0px;" id="province_2" value="BeiJing" autocomplete="off" class="ac_input"><script>selectAutoComplete('province_2','?m=ajax&c=data&a=auto_province&id=1',true,136);</script></div></div><div id="box_city" style="float:left;"><div style="position:relative;"><span style="margin-left:128px;width:18px;overflow:hidden;"><select name="city" id="city" style="margin-left:-128px;width:156px;" onchange="getChildSelect('','city')" class="required"><option value="">Please Select</option><option value="1">BeiJing</option></select></span><input name="select_text" style="width:128px;position:absolute;left:0px;" id="city_2" value="" autocomplete="off" class="ac_input"><script>selectAutoComplete('city_2','?m=ajax&c=data&a=auto_city&id=1',true,176);</script></div></div></td>
						</tr>
						<tr>
							<td class="top">Job Received Time<span class="red">*</span><br>
								<input type="checkbox" name="cc" style="width:20px;" checked="checked">Message Copy to CEO
							</td>
							<td>
							<textarea class="txt" style="width:100%!important;height:60px;" name="description"></textarea>
							<p class="gary">
								从邮件中复制出收到客户JD的日期,模板如下:<br>
								发件人: Violet Shan<violet.shan@sap.com><br>
								主题: FW: Job Posting VT Consultant<br>
								日期: 2012年4月26日格林尼治标准时间+0800下午4时08分57秒<br>
							</violet.shan@sap.com></p>
							</td>
							<td class="top">
								JD<span class="red">*</span>
							</td>
							<td class="top">
								<input type="file" name="jd_attachment">
							</td>
						</tr>
						<tr><td>Approval Process<span class="red">*</span></td><td colspan="3">
							<select name="hrtitle" validate="required:true">
								<option value="">Please Select</option>
																	<option value="1">HR Approval</option>
																	<option value="2">HM Approval</option>
																	<option value="3">HMP Approval</option>
																	<option value="4">HMB Approval</option>
															</select>
						</td></tr>
						<tr>
							<td>Yr. Income (RMB)<span class="red">*</span></td><td><div style="position:relative;"><span style="margin-left:178px;width:18px;overflow:hidden;"><select name="income" id="income" class="valid" style="margin-left:-178px" onchange="this.parentNode.nextSibling.value=this.options[this.selectedIndex].text"><option value="">Please Select</option><option value="24">3,000,000</option><option value="25">2,500,000</option><option value="16">2,000,000</option><option value="9">1,000,000</option><option value="8">950,000</option><option value="22">900,000</option><option value="21">850,000</option><option value="7">800,000</option><option value="20">750,000</option><option value="6">700,000</option><option value="5">650,000</option><option value="19">600,000</option><option value="12">550,000</option><option value="4">500,000</option><option value="18">450,000</option><option value="3">400,000</option><option value="15">390,000</option><option value="14">370,000</option><option value="17">350,000</option><option value="2">300,000</option><option value="13">250,000</option><option value="1">200,000</option><option value="10">150,000</option><option value="23">100,000</option><option value="11">0</option></select></span><input name="income_select_text" style="width:178px;position:absolute;left:0px;" value="" id="income_2" autocomplete="off" class="ac_input"><script>unitopAutoComplete('income_2','?m=ajax&c=data&a=auto_income',true,206);</script></div></td>
							<td>Service Fee %<span class="red">*</span></td><td><select name="serverfee" id="serverfee" class="valid" validate="required:true"><option value="">Please Select</option><option value="1">10%</option><option value="2">15%</option><option value="3">17%</option><option value="12">18%</option><option value="14">19%</option><option value="9">20%</option><option value="15">21%</option><option value="4">22%</option><option value="17">23%</option><option value="16">24%</option><option value="13">24%</option><option value="5">25%</option><option value="18">26%</option><option value="10">28%</option><option value="11">30%</option></select></td>
						</tr>
						<tr>
							<td>Client Request Date<span class="red">*</span></td><td>
								<input type="text" class="txt dateico" name="client_request_date" id="client_request_date" readonly="">
								</td>
							<td>Internal R.Date<span class="red">*</span></td><td>
								<input type="text" class="txt dateico" name="internal_date" id="internal_date" readonly="">
								</td>
						</tr>
						<tr>
							<td>Client Deadline<span class="red">*</span></td><td>
								<input type="text" class="txt dateico" name="client_deadline" id="client_deadline" readonly="">
								</td>
							<td>Internal Deadline<span class="red">*</span></td><td>
								<input type="text" class="txt dateico" name="internal_deadline" id="internal_deadline" readonly="">
							</td>
						</tr>
						
						<tr>
							<td>Contact Info.<span class="red">*</span></td><td>
							<select id="contact_info" name="contact_id" validate="required:true" class="valid"><option value="143">Jing Li李婧</option></select></td>
							<td colspan="2">
							<!--<em class="right add"><a href="?m=client&c=client&a=addhrcontact" id="add_contact" target="_blank">Add</a><em>-->
							</td>
						</tr>
						
						<tr>
							<td>Last Name</td><td><input type="text" name="family_name_en" class="txt valid" id="family_name_en" readonly="readonly"></td>
							<td>First Name</td><td><input type="text" name="given_name_en" class="txt" id="given_name_en" readonly="readonly"></td>
						</tr>
						<tr>
							<td>姓</td><td><input type="text" name="family_name_cn" class="txt" id="family_name_cn" readonly="readonly"></td>
							<td>名</td><td><input type="text" name="given_name_cn" class="txt" id="given_name_cn" readonly="readonly"></td>
						</tr>
						<tr>
							<td>Title</td><td><input type="text" class="txt" id="title" readonly="readonly"></td>
							<td>Location</td><td><input type="text" class="txt" id="location" readonly="readonly"></td>
						</tr>
						
						
						<tr><td class="top">Contact Num</td><td colspan="3">
							<table style="background-color:#F2F9FD;width:60%!important;">
								<tbody><tr><td>Country/Region</td><td colspan="2"><input type="text" class="txt valid" id="phone_country" readonly="readonly"></td></tr>
								<tr><td>Code</td><td colspan="2"><input type="text" class="txt" id="phone_code" readonly="readonly"></td></tr>
								<tr><td>Phone</td><td colspan="2"><input type="text" class="txt" id="phone_telephone" readonly="readonly"></td></tr>
								<tr><td>Extension</td><td colspan="2"><input type="text" class="txt" id="phone_extension" readonly="readonly"></td></tr>
								<tr><td>Mobile</td><td colspan="2"><input type="text" class="txt" id="phone_mobile" readonly="readonly"></td></tr>
							</tbody></table>
						</td></tr>
						
						<tr>
							<td>Email</td><td><input type="text" class="txt" id="email" readonly="readonly"></td>
							<td>Skype</td><td><input type="text" class="txt" id="skype" readonly="readonly"></td>
						</tr>
						<tr>
							<td>QQ</td><td><input type="text" class="txt" id="qq" readonly="readonly"></td>
							<td>MSN</td><td><input type="text" class="txt" id="msn" readonly="readonly"></td>
						</tr>
						<tr>
							<td>Weibo</td><td><input type="text" class="txt" id="weibo" readonly="readonly"></td>
							<td>Blog</td><td><input type="text" class="txt" id="blog" readonly="readonly"></td>
						</tr>
						<tr>
							<td>Horoscope</td><td><input type="text" class="txt" id="horoscope" readonly="readonly"></td>
							<td>Hobbies</td><td><input type="text" class="txt" id="hobbies" readonly="readonly"></td>
						</tr>
						<tr>
							<td colspan="4" class="t-center" style="height:100px;">
								<input type="hidden" name="client_id" id="client_id" value="93">
								<input type="submit" name="dosubmit" value="Sign Off" class="btn txt">
							</td>
						</tr>
					</tbody></table>
					</form>
				</div>
			</div>
			
		</div>
@stop