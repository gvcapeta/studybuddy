<!-- ############ HEADER HTML CODE : START ############-->
<header>
	<div class="htop" style="background:rgb(71, 114, 86);width: 300px;color: #fff; padding-left: 50px;">
		<h1> Study Buddy</h1>
		<a class="menu-toggle" data-bs-toggle="collapse" aria-expanded="false">
			<span></span>
		</a>
	</div>
	<div class="dropdown dropdown-header">
		<a class="dropdown-toggle" data-bs-toggle="dropdown">
			<span><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></span>
			<svg x="0px" y="0px" viewBox="0 0 517.8 306.6" width="12px" height="7.11px">
				<path d="M258.9,306.6l-249-249C-3.3,44.5-3.3,23.1,9.9,9.9c13.2-13.2,34.6-13.2,47.8,0l201.2,201.2L460.1,9.9
				c13.2-13.2,34.6-13.2,47.8,0c13.2,13.2,13.2,34.6,0,47.8L258.9,306.6z" />
			</svg>
		</a>
		<ul class="dropdown-menu">
			<li><a href="logout_student.php">Logout</a></li>
		</ul>
	</div>
</header>
<!-- ############ HEADER HTML CODE : END ############-->