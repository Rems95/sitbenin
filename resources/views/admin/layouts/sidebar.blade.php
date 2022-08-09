<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">

    <div class="c-sidebar-brand d-lg-down-none">

      <div class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
        	<img src="https://ubuntu-mm.net/wp-content/uploads/2019/03/ujpeg-1.png" height="50" alt="Logo" >
      </div>
      <div class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
        	<img src="https://ubuntu-mm.net/wp-content/uploads/2019/03/ujpeg-1.png" height="50" alt="Logo" >
			</div>

		</div>

    <ul class="c-sidebar-nav">


      <li class="c-sidebar-nav-item">
	  <a class="c-sidebar-nav-link" href="{{ route('admin.home') }}">
          <i class="c-sidebar-nav-icon cil-speedometer"></i> Dashboard
				</a>
			</li>

			<li class="c-sidebar-nav-title">Settings</li>

            <li class="c-sidebar-nav-item">
				<a class="c-sidebar-nav-link" href="{{ route('adherant.index') }}">
          <i class="c-sidebar-nav-icon cil-people"></i> Adherants
				</a>
			</li>

            <li class="c-sidebar-nav-item">
				<a class="c-sidebar-nav-link" href="{{ route('subsector.index') }}">
          <i class="c-sidebar-nav-icon cil-people"></i> Sous-secteur d'activité
				</a>
			</li>

            <li class="c-sidebar-nav-item">
				<a class="c-sidebar-nav-link" href="{{ route('event.index') }}">
          <i class="c-sidebar-nav-icon cil-calendar"></i> Evenements
				</a>
			</li>

            <li class="c-sidebar-nav-item">
				<a class="c-sidebar-nav-link" href="{{ route('event.index') }}">
          <i class="c-sidebar-nav-icon cil-envelope-closed"></i> Mail
				</a>
			</li>

             <li class="c-sidebar-nav-item">
				<a class="c-sidebar-nav-link" href="{{ route('payment.index') }}">
          <i class="c-sidebar-nav-icon cil-dollar"></i> Paiement
				</a>
			</li>

			<li class="c-sidebar-nav-item">
				<a class="c-sidebar-nav-link" href="{{ route('users.index') }}">
          <i class="c-sidebar-nav-icon far fa-user"></i> User
				</a>
			</li>

			<li class="c-sidebar-nav-item">
				<a class="c-sidebar-nav-link" href="{{ route('roles.index') }}">
          <i class="c-sidebar-nav-icon cil-shield-alt"></i> Roles
				</a>
			</li>




    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
  </div>
