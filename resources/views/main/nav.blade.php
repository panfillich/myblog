<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Мой блог</a>
    </div>
    
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="#">О нас</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Категории<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    @foreach($categories as $category)
                        <li><a href="{{route('category',['curl'=>$category['curl'].'-'.$category['id']])}}">
                            {!!$category['name']!!} ({{$category['count_article']}})
                        </a></li>
                    @endforeach
                </ul>
            </li>
        </ul>
        <div class="col-sm-3 col-md-3 pull-left">
            {{Form::open([
                'id'        =>  'search_form',
                'route'     =>  'search',                
                'class'     =>  'navbar-form',
                'method'    =>  'GET'
            ])}}     
            <!--form class="navbar-form" role="search"-->
                <div class="input-group">
                    {{Form::text('q',null,[
                        'class'         => 'form-control',
                        'placeholder'   => 'Поиск...'
                    ])}}
                    <div class="input-group-btn">                        
                        {{Form::button('<i class="glyphicon glyphicon-search"></i>',[
                            'class' => 'btn btn-default',        
                            'type'  => "submit",
                        ])}}
                    </div>
                </div>
            {{Form::close()}}
        </div>    
        
        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
						<li><a href="{{ url('/admin/articles') }}"><i class="fa fa-btn fa-sign-out"></i>Admin panel</a></li>
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
  </div>
</nav>