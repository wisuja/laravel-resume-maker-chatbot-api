<!DOCTYPE html>
<html lang="en">
<head>
	<title>Resume Maker By Jobsfree</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" type="text/css" href="{{ asset('css/yui-reset-css.css') }}" media="all" /> 
	<link rel="stylesheet" type="text/css" href="{{ asset('css/resume.css') }}" media="all" />

</head>
<body>

<div id="doc2" class="yui-t7">
	<div id="inner">
	
		<div id="hd">
			<div class="yui-gc">
				<div class="yui-u first">
					<h1>{{ $detail->name }}</h1>
					<h2>{{ $detail->keywords }}</h2>
				</div>

				<div class="yui-u">
					<div class="contact-info" style="float: right">
						<h3><a href="mailto:{{ $detail->email }}">{{ $detail->email }}</a></h3>
						<h3>{{ $detail->phone }}</h3>
					</div>
				</div>
			</div>
		</div>

		<div id="bd">
			<div id="yui-main">
				<div class="yui-b">

					<div class="yui-gf">
						<div class="yui-u first">
							<h2>Profile</h2>
						</div>
						<div class="yui-u">
							<p class="enlarge">
                {{ $detail->description }}
              </p>
						</div>
					</div>

					<div class="yui-gf">
						<div class="yui-u first">
							<h2>Skills</h2>
						</div>
						<div class="yui-u">
                @foreach ($detail->skills as $skill)
                  <div class="talent">
                    <h2>{{ $skill }}</h2>
                  </div>
                @endforeach
						</div>
					</div>

					<div class="yui-gf">
						<div class="yui-u first">
							<h2>Experience</h2>
						</div>

						<div class="yui-u">
              @foreach ($detail->work_experiences as $work)
                <div class="job">
                  <h2>{{ $work }}</h2>
                </div>
              @endforeach
						</div>
					</div>


					<div class="yui-gf last">
						<div class="yui-u first">
							<h2>Education</h2>
						</div>
            @foreach ($detail->education as $edu)
              <div class="yui-u">
                <h2>{{ $edu }}</h2>
              </div>
            @endforeach
					</div>
				</div>
			</div>
		</div>

		<div id="ft">
			<p>Created using Jobsfree's Resume maker chatbot.</p>
		</div>
	</div>
</div>

<script>
	window.print();
</script>
</body>
</html>

