	<!-- DataTables CSS -->
    <link href="<?php echo base_url();?>add-ons/bootstrap/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url();?>add-ons/bootstrap/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

	<!-- Bootstrap Multiselect CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>add-ons/bootstrap/multiselect/dist/css/bootstrap-multiselect.css" type="text/css">
   
   
<div id="page-wrapper">
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Produtos</h1>
</div>
<!-- /.col-lg-12 -->
</div>


<button class="btn btn-success" onclick="adicionar_produto()"><i class="glyphicon glyphicon-plus"></i> Adicionar Produto</button>
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
				<?php foreach($produtos as $produtos){?>
				     <tr>
				        		 <td><?= $produtos->produto_id;?></td>
				         		 <td><?= utf8_decode($produtos->produto_nome);?></td>
								 <td><?= utf8_decode($produtos->descricao);?></td>
								 <td><?php  $data = new DateTime($produtos->data_cadastro);
										    echo $data->format('d-m-Y');?></td>

								<td>					
								   <button class="btn btn-sm btn-info" onclick="historico_produto(<?php echo $produtos->produto_id;?>)"><i class="fa fa-bar-chart" aria-hidden="true"></i></button>

 								   <button class="btn btn-sm btn-success" onclick="novo_preco(<?php echo $produtos->produto_id;?>)"><i class="fa fa-usd" aria-hidden="true"></i></button>

                                   <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> 
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" onclick="alterar_produto(<?php echo $produtos->produto_id;?>)"><i class="glyphicon glyphicon-pencil"></i> Alterar Produto</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" onclick="deletar_produto(<?php echo $produtos->produto_id;?>)"><i class="glyphicon glyphicon-remove"></i> Deletar Produto</a>
                                    </ul>
                                </div>
                        
								</td>
				      </tr>
				     <?php }?>
 
 
 
      </tbody>
  
    </table>
 
  </div>
 
 
  <script type="text/javascript">
  $(document).ready( function () {
      $('#table_id').DataTable();

      $('#modal_historico').on('hidden.bs.modal', function () {
    	  $('#historico_chart').html('');
    	  $('#historico_chart').hide();

    	  $('#fornecedores_historico').multiselect('destroy');
    	  
    	})
    	
  } );
  
    var save_method; //for save method string
    var table;
 
 
    function adicionar_produto()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Adicionar Produto'); // Set Title to Bootstrap modal title
    }
 
    function alterar_produto(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
 
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('produtos/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="produto_id"]').val(data.produto_id);
            $('[name="produto_nome"]').val(data.produto_nome);
            //$('[name="data_cadastro"]').val(data.data_cadastro);
            $('[name="descricao"]').val(data.descricao);
 
 
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Alterar Produto'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }


    function novo_preco(id)
    {
      save_method = 'preco';
      $('#form_preco')[0].reset(); // reset form on modals

      $.ajax({
        url : "<?php echo site_url('produtos/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="produto_id"]').val(data.produto_id);
            $('#nome_produto').append(data.produto_nome);
            //$('[name="data_cadastro"]').val(data.data_cadastro);
            $('#descricao_produto').append(data.descricao);
 
            $('#modal_preco').modal('show'); // show bootstrap modal
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
      
    }


    function historico_fornecedores(id){

    	 $.ajax({
 	        url : "<?php echo site_url('historico/get_historico_fornecedores/')?>/" + id,
 	        type: "GET",
 	        dataType: "JSON",
 	        success: function(data)
 	        {
 	
 	          $.each(data, function() {
 	        	   $('#fornecedores_historico').append(
 	        	        $("<option></option>").text(this.fornecedor_nome).val(this.fornecedor_id)
 	        	   );
  	             
 	        	});


        	  $('#fornecedores_historico').multiselect({
                 enableFiltering: true,
                 filterBehavior: 'text',
                 onChange: function(option, checked, select) {
                     get_historico_grafico($('#produto_historico').val(),$('#fornecedores_historico').val());
                 }
           
            	 });

        	  $('#produto_historico').val(id);

 	          $('#modal_historico').modal('show');	
 	 
 	        },
 	        error: function (jqXHR, textStatus, errorThrown)
 	        {
 	            alert('Produto sem histórico!');
 	        }
 	    });

    }

    function historico_produto(id){        
        
    	  save_method = 'historico';

    	  produto_historico_id = id; 

    	//Ajax Load data from ajax
          $.ajax({
            url : "<?php echo site_url('produtos/ajax_edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#produto_nome').html(data.produto_nome);
                $('#produto_descricao').html(data.descricao);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });

    	  $('#fornecedores_historico').html('');
    	  
    	  historico_fornecedores(id);  	  

    }

    function get_historico_grafico(produto_id,fornecedor_id){


    	  $.ajax({
    	        url : "<?php echo site_url('historico/get_historico_preco/')?>/" + produto_id + '/' + fornecedor_id,
    	        type: "GET",
    	        dataType: "JSON",
    	        success: function(data)
    	        {
    	 
    	        	var ctx = document.getElementById("historico_chart");

    	        	var options = { 
    	        	    responsive: false,
    	        	    maintainAspectRatio: true,
    	        		tooltips: {
    	        	                enabled: true,
    	        	                mode: 'single',
    	        	                callbacks: {
    	        	                    label: function(tooltipItems, data) { 
    	        	                        return 'R$' + Number(tooltipItems.yLabel).toFixed(2).replace('.', ',');
    	        	                    }
    	        	                }
    	        	            },
    	        		scales: {
    	        	                    xAxes: [{
    	        	                        type: "time",
    	        	                        display: true,
    	        	                        scaleLabel: {
    	        	                            display: true,
    	        	                            labelString: 'Data'
    	        	                        },
    	        							 time: {
    	        								unit: 'day',
    	        								unitStepSize: 1,
    	        								displayFormats: {
    	        								 'day': 'DD/MM/YYYY',
    	        								  min: 1,
    	        								  max: 15
    	        								} },
    	        	                    }],
    	        	                    yAxes: [{
    	        	                        display: true,
    	        							ticks: {
    	        									callback: function(label, index, labels) {
    	        										return 'R$ ' + Number(label).toFixed(2).replace('.', ',');
    	        									}
    	        							},
    	        	                        scaleLabel:
    	        							{
    	        	                            display: true,
    	        	                            labelString: 'Valor'
    	        	                        }
    	        	                    }]
    	        	                }
    	        	};
    	        	 
    	        	
    	        	var myLineChart = new Chart(ctx, {
    	        	    type: 'line',
    	        	    data: data,
    	        		options: options
    	        	  
    	        	});

    	            $('#historico_chart').show();
    	        	
    	 
    	        }
    	    });

    }

    function tabela_historico()
    {

    	 if(save_method == 'historico')
         {

    		//Ajax Load data from ajax
             $.ajax({
               url : "<?php echo site_url('historico/tabela_historico/')?>/" + produto_historico_id,
               type: "GET",
               dataType: "JSON",
               success: function(data)
               {
                   $('#produto_nome').html(data.produto_nome);
                   $('#produto_descricao').html(data.descricao);

                   $('#table_historico').DataTable();
                   
               },
               error: function (jqXHR, textStatus, errorThrown)
               {
                   alert('Error get data from ajax');
               }
           });  		 

         }

    }

    function save()
    {
      var url;
      var form = $('#form');
      if(save_method == 'add')
      {
          url = "<?php echo site_url('produtos/adicionar_produto')?>";
      }
      else if(save_method == 'update')
      {
        url = "<?php echo site_url('produtos/alterar_produto')?>";
      }
      else if(save_method == 'preco')
      {
        url = "<?php echo site_url('produtos/novo_preco')?>";

        form = $('#form_preco');
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
               $('#modal_preco').modal('hide');
               
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
 
    function deletar_produto(id)
    {
      if(confirm('Deseja realmente deletar o produto?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('produtos/deletar_produto')?>/"+id,
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


    function isNumberKey(evt, ele) {


      var theEvent = evt || window.event;


      var key = theEvent.keyCode || theEvent.which;


      key = String.fromCharCode( key );


      var value = ele.value + key;


      var regex = /^[0-9.,\b]+$/;


      if( !regex.test(value) ) {


        theEvent.returnValue = false;


        if(theEvent.preventDefault) theEvent.preventDefault();


      }


    }
 
  </script>
 
  <!-- Modal Adicionar / Editar -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Formulário Produto</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="produto_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Nome</label>
              <div class="col-md-9">
                <input name="produto_nome" placeholder="Nome do Produto" class="form-control" type="text" required>
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
  
  <!-- Modal Preço -->
  <div class="modal fade" id="modal_preco" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Adicionar Preço</h3>
      </div>
      <div class="modal-body form">
      <div class="row">
			<div class="col-lg-12">				
				<div class="panel panel-info">
                        <div class="panel-heading" id="nome_produto"></div>
                        <div class="panel-body" id="descricao_produto"></div>                    
                </div>
	 		</div>
	 <!-- /.col-lg-12 -->
	 </div>
	
    <form action="#" id="form_preco" class="form-horizontal">
          <input type="hidden" value="" name="produto_id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Fornecedor</label>
              <div class="col-md-9">
             	 <select class="form-control" name="fornecedores">
	                <?php foreach($fornecedores as $fornecedores):?>
	                
	                	 <option value="<?= $fornecedores->fornecedor_id;?>"><?= utf8_decode($fornecedores->fornecedor_nome);?></option>

	                <?php endforeach;?>
	             </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Preço(R$)</label>
              <div class="col-md-9">
                <input name="preco" id="inserir_preco" placeholder="Novo Preço" onkeypress="return isNumberKey(event,this)" class="form-control" type="text" required>
              </div>
            </div>

          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSalvar" onclick="save()" class="btn btn-primary" >Salvar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
 
  <!-- Modal Histórico -->
  <div class="modal fade" id="modal_historico" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Histórico de Preços</h3>
      </div>
      <div class="modal-body">
	      <div class="row">
	      <div class="col-lg-12">				
				<div class="panel panel-info"> 
                        <div class="panel-heading" id="produto_nome"></div>
                        <div class="panel-body" id="produto_descricao"></div>                       
                </div>
	 		</div>
	          <input type="hidden" value="" id="produto_historico"/>
	     	 <div class="form-group">
	              <label class="control-label col-md-3">Fornecedor</label>
	              <div class="col-md-9">
	             	 <select class="form-control" id="fornecedores_historico" multiple="multiple"></select>

	              </div>
	            </div>		
				
		 <!-- /.col-lg-12 -->
		 </div>

		 <canvas id="historico_chart" width="800" height="400" style="display:none;"></canvas>

		 <table id="table_historico" class="table table-striped table-bordered" cellspacing="0" width="100%" style="display:none;">
		      <thead>
		        <tr>
							<th>Fornecedor</th>
							<th>Preço</th>
							<th>Data de Entrada</th>
		 					<th>Opções</th>
		        </tr>
		      </thead>
		      <tbody id="corpo_todos_precos"></tbody>
		  
		    </table>	

          </div>
          
          <div class="modal-footer">
           <!-- <button type="button" id="btnSalvar" onclick="save()" class="btn btn-primary" >Salvar</button>
            <button type="button" class="btn btn-sm btn-warning" onclick="tabela_historico()">Ver todos os Preços</button> -->
                       
            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
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
    
    <!-- ChartJS JavaScript -->
    <script src="<?php echo base_url();?>add-ons/chartjs/chart.js"></script>
    
     <!-- Bootstrap Multiselect JavaScript -->
	 <script type="text/javascript" src="<?php echo base_url();?>add-ons/bootstrap/multiselect/dist/js/bootstrap-multiselect.js"></script>
    
     