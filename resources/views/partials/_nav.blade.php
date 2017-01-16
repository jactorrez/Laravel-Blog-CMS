 <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Laravel Blog</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">  

      <ul class="nav navbar-nav">
        <li {{ Request::is('/') ? "class=active" : ''}} ><a href="/">Home <span class="sr-only">(current)</span></a></li>
        <li {{ Request::is('blog') ? "class=active" : ''}} ><a href="/blog">Blog <span class="sr-only">(current)</span></a></li>
        <li {{ Request::is('about') ? "class=active" : ''}} ><a href="/about">About</a></li>   
        <li {{ Request::is('contact') ? "class=active" : ''}}><a href="/contact">Contact</a></li>   
      </ul>

      <ul class="nav navbar-nav navbar-right">
        @if(Auth::check())
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome, {{ explode(" ", Auth::user()->name)[0] }} <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/posts">Posts</a></li>
              <li><a href="/posts/create">Create Post</a></li>
              <li><a href="/categories">Categories</a></li>
              <li><a href="/tags">Tags</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="/logout">Logout</a></li>
            </ul>
          </li>
        @else
          <li {{ Request::is('login') ? '' : ''}}><a href="/login">Login</a></li>
          <li {{ Request::is('register') ? "class=active" : ''}}><a href="/register">Register</a></li>
        @endif

      </ul>


    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>