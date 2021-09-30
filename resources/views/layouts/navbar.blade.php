<nav class="navbar navbar-expand-lg navbar-light " style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="#">Apotek K-24</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        @if(Str::length(Auth::guard('user')->user()) > 0)
              <li class="nav-item {{ !empty($activeTab) && $activeTab == 'data-dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/admin/dashboard') }}">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item {{ !empty($activeTab) && $activeTab == 'data-member' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/admin/member') }}">Member</a>
              </li>
              </li>
              <li class="nav-item {{ !empty($activeTab) && $activeTab == 'data-user' ? 'active' : '' }}">
                <a class="nav-link" href="{{  url('/admin/user') }}">Users</a>
              </li>
              <li class="nav-item {{ !empty($activeTab) && $activeTab == 'data-list_member' ? 'active' : '' }}">
                <a class="nav-link" href="{{  url('/admin/list_member') }}">List Member Json</a>
              </li>
          @elseif(Str::length(Auth::guard('member')->user()) > 0)
              <li class="nav-item {{ !empty($activeTab) && $activeTab == 'data-dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/member/dashboard') }}">Home <span class="sr-only">(current)</span></a>
              </li>
          @endif
      </ul>
        <ul class="navbar-nav my-2 my-lg-0">
          <li class="nav-item">
            <a  class="nav-link" href="{{ url('/logout') }}"><i class="fas fa-sign-out-alt"></i> Logout </a>
          </li>
      </ul>
    </div>
</nav>