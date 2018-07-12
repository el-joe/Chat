<!DOCTYPE html>
<html>
<head>
	<title>Chat</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

	<style>
		.chat{
			height: 200px;
			background-color: white;
			overflow-y: scroll;
		}
	</style>
</head>
<body>

	<div class="container">
		<div class="row" id="app">
			<ul class="list-group col-md-6 offset-md-3">

				<li class="list-group-item active">
					Chat Room
					<span class="badge bg-dark badge-pill">@{{ numberOfUsers }}</span>
				</li>

				<div class="badge badge-bill badge-info">@{{ typing }}</div>

				<div class="chat" v-chat-scroll>
					
				<message
				v-for="(value,index) in chat.message"
				:key=value.index
				:color=chat.color[index]
				:user=chat.user[index]
				>
					@{{ value }}
				</message>

				</div>
				<input type="text" name="" class="form-control" placeholder="Type Message Here...." v-model="message" @keyup.enter="send">
			</ul>
		</div>
	</div>




	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>


</body>
</html>