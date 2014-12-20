<!DOCTYPE html>
<html>
<head>
	<title>Jizan Perfumes :: Login</title>
    <?php echo HTML::style('css/style.css'); ?>
</head>

<body style="font-family:Calibri">
	
	
    <div id ='loginbox'>
        <h4 id="logintitle">Jizan Perfumes LLC</h4>

        <!-- check for login error flash var -->
        @if (Session::has('flash_error'))
            <div id="flash_error">{{ Session::get('flash_error') }}</div>
        @endif
        <div align="center" id ="companylogo">
            <?php echo HTML::image('img/login.png','alt', array( 'width' => 100, 'height' => 100 )); ?>
        </div>
        <div id = "mainform">
            {{ Form::open(array('url' => 'login', 'method' => 'post')) }}

            <!-- username field -->
            <p>
                {{ Form::text('username', Input::old('username')) }}
            </p>

            <!-- password field -->
            <p>
                {{ Form::password('password') }}
            </p>

            <!-- submit button -->
            <p>{{ Form::submit('Login') }}</p>

            {{ Form::close() }}
        </div>

    </div>

</body>
</html>