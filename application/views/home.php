<div id="page-wrapper">
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Bem-vindo <?= $this->session->userdata('nome'); ?></h1>
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
<div class="col-lg-3 col-md-6">
<div class="panel panel-primary">
<div class="panel-heading">
<div class="row">
<div class="col-xs-3">
<i class="fa fa-barcode fa-fw fa-5x"></i>
</div>
<div class="col-xs-9 text-right">
<div class="huge"><?= $produtos; ?></div>
<div>Produtos</div>
</div>
</div>
</div>
<a href="<?= site_url('produtos') ?>">
<div class="panel-footer">
<span class="pull-left"></span>
<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
<div class="clearfix"></div>
</div>
</a>
</div>
</div>
<div class="col-lg-3 col-md-6">
<div class="panel panel-green">
<div class="panel-heading">
<div class="row">
<div class="col-xs-3">
<i class="fa fa-briefcase fa-fw fa-5x"></i>
</div>
<div class="col-xs-9 text-right">
<div class="huge"><?= $fornecedores; ?></div>
<div>Fornecedores</div>
</div>
</div>
</div>
<a href="<?= site_url('fornecedores') ?>">
<div class="panel-footer">
<span class="pull-left"></span>
<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
<div class="clearfix"></div>
</div>
</a>
</div>
</div></div>
<!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
</body>