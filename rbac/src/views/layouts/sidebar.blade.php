<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('/vendor/rbac/images/user.jpg') }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <h4>{{auth()->user()->name}}</h4>
                <!-- Status -->
                <!-- <h6><i class="fa fa-circle text-success"></i> Online</h6> -->
            </div>
        </div>

        <!-- search form (Optional) -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">

        <?php $main_menu = config('app.main_menu');?>

        @if(isset($main_menu) && count($main_menu)>0)

            <li class="header">Main Menu</li>
             @foreach($main_menu as $manu_item)
                <li><a href="{{ $manu_item->menu->action }}"> <i class="{{ $manu_item->menu->icon }}"></i> <span> {{ $manu_item->menu->display_name }}</span> </a></li>
            @endforeach
        @endif

        <?php $settings_menu = config('app.settings_menu');?>
        @if(isset($settings_menu) && count($settings_menu)>0)
            <li class="header">Admin Menu</li>
            @foreach($settings_menu as $manu_item)
                <li><a href="{{ $manu_item->menu->action }}"> <i class="{{ $manu_item->menu->icon }}"></i> <span> {{ $manu_item->menu->display_name }}</span> </a></li>
            @endforeach
        @endif

        <?php 
            $others_menu = config('app.others_menu');
            $hod_menu = config('app.hod_menu');
        ?>
        @if((isset($others_menu) && count($others_menu)>0) || isset($hod_menu))
            <li class="header">Special Menu </li>
            @foreach($others_menu as $manu_item)
                <li><a href="{{ $manu_item->menu->action }}"> <i class="{{ $manu_item->menu->icon }}"></i> <span> {{ $manu_item->menu->display_name }}</span> </a></li>
            @endforeach

            <li><a href="{{ $hod_menu['action'] }}"> <i class="{{ $hod_menu['icon'] }}"></i> <span> {{ $hod_menu['display_name'] }}</span> </a></li>

        @endif

          </ul>
          <!-- /.sidebar-menu -->
     </section>
     <!-- /.sidebar -->
</aside>