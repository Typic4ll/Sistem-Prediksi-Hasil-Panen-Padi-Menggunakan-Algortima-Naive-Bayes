<!DOCTYPE html>
<html>
<head>
	<title>Sistem Prediksi Panen Padi</title>
	<link href="{{ asset('template/css/login.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="{{ asset('template/img/wave.png') }}">
	<div class="container">
		<div class="img">
			<img src="{{ asset('template/img/bg.svg') }}">
		</div>
		<div class="login-content">
			<form action="{{ url('simpan') }}" method="post" class="row g-3 needs-validation" >
        {{ csrf_field() }}
				<img src="{{ asset('template/img/bpp.png') }}">
				<h2 class="title">Welcome</h2>
                <div class="input-div one">
                    <div class="i">
                      <i class="fab fa-google"></i>
                </div>
                <div class="div">
                    <h5>Email</h5>
                    <input type="text" class="input" name="email">
                </div>
              </div>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input" name="name">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" name="password" class="input">
            	   </div>
            	</div>
            	<input type="submit" class="btn" value="Buat Akun">
            </form>
        </div>
    </div>
    <script>
	const inputs = document.querySelectorAll(".input");


function addcl(){
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}

function remcl(){
	let parent = this.parentNode.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}


inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});
</script>
</body>
</html>