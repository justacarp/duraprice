
<body>

<div id="wrapper">

<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="<?= site_url('home') ?>">Duraprice</a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">
<li class="dropdown">

<!-- /.dropdown -->
<li class="dropdown">
<a class="dropdown-toggle" data-toggle="dropdown" href="#">
<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
</a>
<ul class="dropdown-menu dropdown-user">
<li><a href="#"><i class="fa fa-user fa-fw"></i>  <?= $this->session->userdata('nome') ?></a>
</li>
<li class="divider"></li>
<li><a href="<?= site_url('home/logout') ?>"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
</li>
</ul>
<!-- /.dropdown-user -->
</li>
<!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->

<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse">
		<ul class="nav" id="side-menu">
		
		<li>
			<a href="<?= site_url('home') ?>"><i class="fa fa-home fa-fw"></i> Home</a>
		</li>
		
		<li>
			<a href="<?= site_url('produtos') ?>"><i class="fa fa-barcode fa-fw"></i> Produtos</a>
		</li>
		
		<li>
			<a href="<?= site_url('fornecedores') ?>"><i class="fa fa-briefcase fa-fw"></i> Fornecedores</a>
		</li>
	
		</ul>
		<!-- /.nav-second-level -->
		</li>
		</ul>
</div>
<!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>
