<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>

              <li class="text-muted menu-title">Navigation</li>
                  <li>
                    <a href="{{ route('admin') }}" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span> </a>
                  </li>
                  <li><a href="{{ route('admin.gallery.index') }}" class="waves-effect"><i class="ti-gallery"></i><span> Gallery </span></a></li>

                  <li class="text-muted menu-title">Settings</li>
                  <li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-settings"></i><span> Settings </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="#"> Users</a></li>
                        </ul>
                    </li>
                  </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
