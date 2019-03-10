<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel</title>
    
  
    <!-- Styles -->
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet">
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/trumbowyg/dist/ui/trumbowyg.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('vendor/trumbowyg/dist/plugins/table/ui/trumbowyg.table.css')}}">
    <link rel="stylesheet" href="{{ asset('vendor/trumbowyg/dist/plugins/colors/ui/trumbowyg.colors.css')}}">
    <!-- scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
    <!-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script> -->
    <!-- <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
    <script src="{{ asset('vendor/jquery-resizable/dist/jquery-resizable.min.js') }}"></script>
    <script src="{{ asset('vendor/trumbowyg/dist/trumbowyg.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('vendor/trumbowyg/dist/plugins/base64/trumbowyg.base64.js')}}"></script>
    <script src="{{ asset('vendor/trumbowyg/dist/plugins/table/trumbowyg.table.js')}}"></script>
    <script src="{{ asset('vendor/trumbowyg/dist/plugins/resizimg/trumbowyg.resizimg.js') }}"></script>
    <script src="{{ asset('vendor/trumbowyg/dist/plugins/pasteimage/trumbowyg.pasteimage.min.js') }}"></script>
    <script src="{{ asset('vendor/trumbowyg/dist/plugins/lineheight/trumbowyg.lineheight.min.js') }}"></script>
    <script src="{{ asset('vendor/trumbowyg/dist/plugins/fontsize/trumbowyg.fontsize.min.js') }}"></script>
    <script src="{{ asset('vendor/trumbowyg/dist/plugins/fontfamily/trumbowyg.fontfamily.min.js') }}"></script>
    <script src="{{ asset('vendor/trumbowyg/dist/plugins/colors/trumbowyg.colors.min.js') }}"></script>
    <script src="{{ asset('vendor/typeahead.js') }}"></script>


</head>
<body style="display: flex;">
    <!-- <div id="app"> -->
    <div class="wrapper">
      <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Admin Panel</h3>
        </div>

        <ul class="list-unstyled components">
            <ul class="list-unstyled CTAs">
                <li>
                    <li>
                        <a href="{{ url('/logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();" class="logout">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </li>
            </ul>
            <li>
                <a href="#categorySubmenu" data-toggle="collapse" class="dropdown-toggle" >Category</a>
                <ul id="categorySubmenu"
                @if(Route::current()->getName() == 'addcategory') class="collapse list-unstyled show" 
                @else class="collapse list-unstyled"
                @endif >
                    <li @if(Route::current()->getName() == 'addcategory') class="active" @endif>
                        <a href="/addcategory">Create Category</a>
                    </li>
                    <li @if(Route::current()->getName() == 'listcategory') class="active" @endif>
                        <a href="/listcategory">View/Edit Category</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#articleSubmenu" data-toggle="collapse" class="dropdown-toggle" >Article</a>
                <ul id="articleSubmenu"
                @if(Route::current()->getName() == 'createarticle' || Route::current()->getName() == 'addarticle' || Route::current()->getName() == 'draft') class="collapse list-unstyled show" 
                @else class="collapse list-unstyled"
                @endif >

                    <li @if(Route::current()->getName() == 'addarticle') class="active" @endif>
                        <a href="/addarticle">Upload New Article</a>
                    </li>
                    
                    <li @if(Route::current()->getName() == 'createarticle') class="active" @endif>
                        <a href="/createarticle">Create New Article</a>
                    </li>

                    <li @if(Route::current()->getName() == 'draft') class="active" @endif>
                        <a href="/draft">Draft Articles</a>
                    </li>
                </ul>
            </li>
            <!-- <li @if(Route::current()->getName() == 'addarticle') class="active" @endif>
                <a href="/addarticle">Add Article</a>
                
            </li> -->
            <li @if(Route::current()->getName() == 'inpress') class="active" @endif>
                <a href="/inpress">In Press</a>
            </li>
            <li @if(Route::current()->getName() == 'issued') class="active" @endif>
                <a href="/issued">Current issues</a>
            </li>
            <li @if(Route::current()->getName() == 'archive') class="active" @endif>
                <a href="/archive">Archives</a>
            </li>
            <li @if(Route::current()->getName() == 'listmenuscript') class="active" @endif>
                <a href="/listmenuscript">Menu Scripts</a>
            </li>
            <li>

                <a href="#usermanagementmenu" data-toggle="collapse" class="dropdown-toggle" >User Management</a>
                <ul id="usermanagementmenu"
                @if(Route::current()->getName() == 'createuser' || Route::current()->getName() == 'users'|| Route::current()->getName() == 'edituser') class="collapse list-unstyled show" 
                @else class="collapse list-unstyled"
                @endif >
                    <li @if(Route::current()->getName() == 'createuser') class="active" @endif>
                        <a href="/createuser">Add New User</a>
                    </li>
                    
                    <li @if(Route::current()->getName() == 'users') class="active" @endif>
                        <a href="/users">User List</a>
                    </li>

                </ul>

            </li>

        </ul>

      </nav>
    </div>
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                    <span>Toggle Menu</span>
                </button>
                <h3 class="text-center">
                    {{ config('app.name', 'Laravel') }}
                </h3>

            </div>
        </nav>
        @yield('content')
    </div>
      
    <script src="{{ asset('js/admin.js') }}" defer></script>
</body>
</html>
