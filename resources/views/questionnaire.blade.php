<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title></title>
		<script src="{{ asset('questionnaire/js/mui.min.js') }}"></script>
		<link href="{{ asset('questionnaire/css/mui.min.css') }}" rel="stylesheet" />
		<link href="{{ asset('questionnaire/css/index.css') }}" rel="stylesheet" />

        @if($question['banner'])
		<div class="bgimg">
			<img src="{{asset('storage/'.$question['banner'])}}">
		</div>
        @endif

        @if($question['title'])
		<div class="blackArea">
			<p>{{$question['title']}}</p>
		</div>
        @endif
        
        @if($question['description'])
		<div class="content">
			<p>{{$question['description']}}</p>
		</div>
        @endif

        @if($question['form_title'])
		<div class="blackArea">
			<p>{{$question['form_title']}}</p>
		</div>
        @endif

        @if($question->item)
		<div class="formWrap">
            @foreach ($question->item as $item)
            <p class="radioTitle"><span class="blackFont">{{$item->title}}</span>(单选<span class="redFont">*</span>)</p>
            @if(!empty(explode(',',$item->value)))
			<div class="formGrop">
                @foreach (explode(',',$item->value) as $radio)
				<div class="mui-input-row mui-radio mui-left ">
					<label>{{$radio}}</label>
					<input name="identityState" type="radio">
				</div>
                @endforeach
			</div>
            @endif
            @endforeach
        
			<p class="radioTitle">姓名<span class="redFont">*</span></p>
			<div class="mui-input-row">
				<input type="text" class="mui-input-clear bottomStyle" placeholder="请输入姓名">
			</div>

			<p class="radioTitle">电话<span class="redFont">*</span></p>
			<div class="mui-input-row">
				<input type="text" class="mui-input-clear bottomStyle" placeholder="请输入电话">
			</div>
			<p style="clear: both;"></p>
			<div class="mui-input-row mui-checkbox mui-left">
				<label>自动输入历史手机号 <span class="blueFont">《个人信息授权书》</span></label>
				<input name="checkbox1" value="Item 1" type="checkbox">
			</div>

			<button type="button" class="mui-btn mui-btn-primary submitbtn">立即获取评估结果</button>
		</div>
        @endif
		<div class="blackArea">
			<p>为何越来越多人考金融分析师证？</p>
			<p class="subtitle">
					应用广 + 大发展 + 高薪职业
			</p>
		</div>
		<script type="text/javascript" charset="utf-8">
			mui.init();
		</script>
	</head>
	<body>

	</body>
</html>
