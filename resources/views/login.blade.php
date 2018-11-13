<html>
<head>
<link rel='stylesheet' href="/css/bootstrap.min.css" type='text/css' media='all'/>
<link rel='stylesheet' href="/css/all.css" type='text/css' media='all'/>
  <style type="text/css">

  </style>
</head>
<body>
@section('content')
    <h1> 登录</h1>
    {!! Form::open() !!}
    <div class="form-group">
       {!! Form::label('title','标题:') !!}
       {!! Form::text('title',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
       {!! Form::label('content','正文:') !!}
       {!! Form::textarea('content',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
       {!! Form::submit('发表文章',['class'=>'btn btn-success form-control']) !!}
    </div>
    {!! Form::close() !!}
@endsection
</body>
</html>
