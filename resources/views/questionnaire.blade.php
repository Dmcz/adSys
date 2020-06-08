<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title></title>
	<script src="{{ asset('questionnaire/js/mui.min.js') }}"></script>
	<link href="{{ asset('questionnaire/css/mui.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('questionnaire/css/index.css?v=1') }}" rel="stylesheet" />

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
	<div id="dataForm" class="formWrap">
		@foreach ($question->item as $item)
		<p class="radioTitle formRadio" title="{{$item->title}}"><span class="blackFont">{{$item->title}}</span><span class="redFont">*</span><!-- (单选<span class="redFont">*</span>) -->
		</p>
		@if(!empty($item->value))
		<div class="formGrop">
			@foreach (explode(',',$item->value) as $radio)
			<div class="mui-input-row mui-radio mui-left ">
				<label>{{$radio}}</label>
				<input name="qestion[{{$loop->parent->index}}]['answer']" class="answerRadio{{$loop->parent->index}}" type="radio" value="{{$radio}}">
			</div>
			@endforeach
		</div>
		@else
		<div class="mui-input-row">
			<input name="qestion[{{$loop->index}}]['answer']" class="answerText{{$loop->index}}" type="text">
		</div>
		@endif
		@endforeach

		<p class="radioTitle">姓名<span class="redFont">*</span></p>
		<div class="mui-input-row">
			<input type="text" class="mui-input-clear bottomStyle" name="contact_name" placeholder="请输入姓名">
		</div>

		<p class="radioTitle">手机号<span class="redFont">*</span></p>
		<div class="mui-input-row">
			<input type="text" class="mui-input-clear bottomStyle" name="contact_mobile" placeholder="请输入电话">
		</div>

		<p class="radioTitle">手机验证码<span class="redFont">*</span></p>
		<div class="mui-input-row">
			<input type="text" class="mui-input-clear bottomStyle" name="contact_mobile" placeholder="请输入电话">
		</div>

		<p style="clear: both;"></p>
		<!-- <div class="mui-input-row mui-checkbox mui-left">
				<label><自动输入历史手机号 <span class="blueFont">《个人信息授权书》</span></label>
				<input name="checkbox1" value="Item 1" type="checkbox">
			</div> -->

		<button type="button" class="mui-btn mui-btn-primary submitbtn">{{$question->submit_btn_text}}</button>
	</div>
	@endif

	@if(!empty($question->bottom_title) || !empty($question->bottom_info))
	<div class="blackArea">
		@if(!empty($question->bottom_title))
		<p>{{$question->bottom_title}}</p>
		@endif
		@if(!empty($question->bottom_info))
		<p class="subtitle">
			{{$question->bottom_info}}
		</p>
		@endif
	</div>
	@endif

	<script type="text/javascript" charset="utf-8">
		mui.init();



		mui('#dataForm').on('click', '.submitbtn', function() {

			let radioData = [];
			mui('#dataForm .formRadio').each(function(index, item) {
				let title = item.title;
				console.info(item);

				radioData.push({
					title: title
				});
			})

			let isOk = true;
			mui.each(radioData, function(index, item) {
				let answerRadio = mui('#dataForm .answerRadio' + index);
				let answerInput = mui('#dataForm .answerText' + index);

				let value = '';

				if (answerRadio.length > 0) {
					if (mui('#dataForm .answerRadio' + index + ':checked').length <= 0) {
						mui.alert('请选择' + item['title'])
						isOk = false;
						return false;
					}

					value = answerRadio[0].value;

				}

				if (answerInput.length > 0) {
					if (!answerInput[0].value) {
						mui.alert('请填写' + item['title'])
						isOk = false;
						return false;
					}

					value = answerInput[0].value;
					console.info(value);
				}

				radioData[index]['answre'] = value;
			})

			if (!isOk) {
				return false;
			}

			let contact_name = mui('#dataForm [name="contact_name"]')[0].value;
			let contact_mobile = mui('#dataForm [name="contact_mobile"]')[0].value;
			if (contact_name.length <= 0) {
				mui.alert('请填写姓名')
				return false;
			}
			if (contact_mobile.length <= 0) {
				mui.alert('请填写电话')
				return false;
			}

			mui.ajax('{{url()->current()}}', {
				dataType: 'json',
				headers: {
					'X-CSRF-TOKEN': mui('meta[name="csrf-token"]')[0].content
				},
				data: {
					radioData: radioData,
					contact_name: contact_name,
					contact_mobile: contact_mobile,
				},
				type: 'POST',
				success: function(res) {
					if (res.status != 'success') {
						mui.alert(res.msg);
					} else {
						mui.alert(res.msg, function() {
							window.location.href = window.location.href;
						});
					}
				}
			});
		});
	</script>
</head>

<body>

</body>

</html>