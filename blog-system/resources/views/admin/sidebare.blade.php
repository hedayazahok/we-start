<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url(" index3.html ") }}" class="brand-link">
        <img src="{{ asset("AdminAssets/dist/img/AdminLTELogo.png ") }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

 @php
use Illuminate\Support\Facades\Route;

$routeName = Route::currentRouteName();

@endphp


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{route('admin.index')}}" class="nav-link @if ($routeName=='admin.index') active @endif ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard

                        </p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <a href="{{route('admin.posts.index')}}" class="nav-link @if ($routeName=='admin.posts.index') active @endif " >
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            posts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.posts.index')}}" class="nav-link  @if ($routeName=='admin.posts.index') active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All posts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.posts.create')}}" class="nav-link  @if ($routeName=='admin.posts.create') active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add post</p>

                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
