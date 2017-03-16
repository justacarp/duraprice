	<!-- DataTables CSS -->
    <link href="<?php echo base_url();?>add-ons/bootstrap/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url();?>add-ons/bootstrap/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

	<!-- Bootstrap Multiselect CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>add-ons/bootstrap/multiselect/dist/css/bootstrap-multiselect.css" type="text/css">
   
   
<div id="page-wrapper">
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Fornecedores</h1>
</div>
<!-- /.col-lg-12 -->
</div>


<button class="btn btn-success" onclick="adicionar_fornecedor()"><i class="glyphicon glyphicon-plus"></i> Adicionar Fornecedor</button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
					<th>ID</th>
					<th>Nome</th>
					<th>Descrição</th>
					<th>Data Cadastro</th>
 					<th>Opções</th>
        </tr>
      </thead>
      <tbody>
				<?php foreach($fornecedores as $fornecedores){?>
				     <tr>
				        		 <td><?= $fornecedores->fornecedor_id;?></td>
				         		 <td><?= utf8_decode($fornecedores->fornecedor_nome);?></td>
								 <td><?= utf8_decode($fornecedores->descricao);?></td>
								 <td><?php  $data = new DateTime($fornecedores->data_cadastro);
										    echo $data->format('d-m-Y');?></td>

								<td>					
								   <button class="btn btn-sm btn-warning" onclick="alterar_fornecedor(<?php echo $fornecedores->fornecedor_id;?>)"><i class="glyphicon glyphicon-pencil"></i></button>

 								   <button class="btn btn-sm btn-danger" onclick="deletar_fornecedor(<?php echo $fornecedores->fornecedor_id;?>)"><i class="glyphicon glyphicon-remove"></i></button>                
								</td>
				      </tr>
				     <?php }?>
 
 
 
      </tbody>
  
    </table>
 
  </div>
 
 
  <script type="text/javascript">
  $(document).ready( function () {
      $('#table_id').DataTable(); 
  } );
  
    var save_method; //for save method string
    var table;
 
 
    function adicionar_fornecedor()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Adicionar Fornecedor'); // Set Title to Bootstrap modal title
    }
 
    function alterar_fornecedor(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
 
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('fornecedores/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="fornecedor_id"]').val(data.fornecedor_id);
            $('[name="fornecedor_nome"]').val(data.fornecedor_nome);
            //$('[name="data_cadastro"]').val(data.data_cadastro);
            $('[name="descricao"]').val(data.descricao);
 
 
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Alterar Fornecedor'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }


    function save()
    {
      var url;
      var form = $('#form');
      if(save_method == 'add')
      {
          url = "<?php echo site_url('fornecedores/adicionar_fornecedor')?>";
      }
      else if(save_method == 'update')
      {
        url = "<?php echo site_url('fornecedores/alterar_fornecedor')?>";
      }

 
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: form.serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
               
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
 
    function deletar_fornecedor(id)
    {
      if(confirm('Deseja realmente deletar o fornecedor?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('fornecedores/deletar_fornecedor')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
      }
    }
 
  </script>
 
  <!-- Modal Adicionar / Editar -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Formulário Fornecedor</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="fornecedor_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Nome</label>
              <div class="col-md-9">
                <input name="fornecedor_nome" placeholder="Nome do Fornecedor" class="form-control" type="text" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Descrição</label>
              <div class="col-md-9">
                <input name="descricao" placeholder="Descrição" class="form-control" type="text" required>
              </div>
            </div>

          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary" >Salvar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  
  
</div>
</div>
</body>
	 	
    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url();?>add-ons/bootstrap/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>add-ons/bootstrap/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>add-ons/bootstrap/vendor/datatables-responsive/dataTables.responsive.js"></script>
    
     