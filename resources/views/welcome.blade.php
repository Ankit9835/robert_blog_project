<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Blog Home - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('front/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{ asset('css/blog-home.css') }}" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Start Bootstrap</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <h1 class="my-5">Page Heading
          <small>Secondary Text</small>
        </h1>

        <!-- Blog Post -->
        @foreach($posts as $post)
        <div class="card mb-4">
          <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title">{{ $post->title }}</h2>
            <p class="card-text">{{  \Illuminate\Support\Str::limit($post->content, 100, '...') }}</p>
            <a href="{{ url('single/post/'. $post->id) }}" class="btn btn-primary">Read More &rarr;</a>
          </div>
          <div class="card-footer text-muted">
            Posted  {{ $post->created_at->diffForHumans() }} by
            <a href="#">{{ $post->user->name }}</a>
            <div>
            Comments {{ $post->comments_count }}
            </div>
           
          </div>
          
        </div>
      @endforeach
      
       

        <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
          <li class="page-item">
            <a class="page-link" href="#">&larr; Older</a>
          </li>
          <li class="page-item disabled">
            <a class="page-link" href="#">Newer &rarr;</a>
          </li>
        </ul>

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <form action = "{{ route('search.post') }}" method = "POST">
              @csrf
            <div class="input-group">
              <input type="text" name = "search" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">Go!</button>
              </span>
            </div>
          </form>
          </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
          @foreach($categories->chunk(3) as $chunk)
            <div class="row">
            @foreach ($chunk as $product)
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="{{ url('category/post/'.$product->id) }}">{{ $product->title }}</a>
                  </li>
                </ul>
              </div>
              @endforeach
             
            </div>
            @endforeach
          </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Tags</h5>
          <div class="card-body">
          @foreach($tags->chunk(3) as $tag)
          <div class="row">
          @foreach ($tag as $row)
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="{{ url('tag/post/'.$row->id) }}">{{ $row->name }}</a>
                  </li>
                
                </ul>
              </div>
             @endforeach
            </div>
            @endforeach
          </div>
        </div>

         <div class="card my-4">
          <h5 class="card-header">Popular Posts</h5>
          <div class="card-body">
          @foreach($popular_posts->chunk(3) as $pop_post)
          <div class="row">
          @foreach ($pop_post as $pp)
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">{{ $pp->title }}</a>
                  </li>
                
                </ul>
              </div>
             @endforeach
            </div>
            @endforeach
          </div>
        </div>

         <div class="card my-4">
          <h5 class="card-header">Most Active Users</h5>
          <div class="card-body">
          @foreach($active_user->chunk(3) as $user)
          <div class="row">
          @foreach ($user as $au)
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">{{ $au->name }}</a>
                  </li>
                
                </ul>
              </div>
             @endforeach
            </div>
            @endforeach
          </div>
        </div>

         <div class="card my-4">
          <h5 class="card-header">Popular Category</h5>
          <div class="card-body">
          @foreach($popular_category->chunk(3) as $category)
          <div class="row">
          @foreach ($category as $pc)
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">{{ $pc->title }}</a>
                  </li>
                
                </ul>
              </div>
             @endforeach
            </div>
            @endforeach
          </div>
        </div>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('front/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
