<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      
      @can('isAdmin')
        <li class="nav-item">
          <router-link to="/users" class="nav-link">
            <i class="fa fa-users nav-icon blue"></i>
            <p>Users</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/ticket" class="nav-link">
            <i class="fa fa-tags nav-icon blue"></i>
            <p>Ticket</p>
          </router-link>
        </li>
      @endcan
      
      <li class="nav-item">
        <router-link to="/transaction" class="nav-link">
          <i class="fa fa-desktop nav-icon blue"></i>
          <p>Transaction</p>
        </router-link>
      </li>
      
      <li class="nav-item">
        <a href="#" class="nav-link" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="nav-icon fas fa-power-off red"></i>
          <p>
            {{ __('Logout') }}
          </p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
    </ul>
  </nav>