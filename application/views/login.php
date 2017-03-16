<body>
 <?php if(isset($_SESSION)) {
        echo $this->session->flashdata('flash_data');
    } ?>
    
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Entrar</h3>
                    </div>
                    <div class="panel-body">
                        <form action= "<?= site_url('login') ?>" method="post" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuário" name="username" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="password" type="password" value="" required>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                              
                            </fieldset>
                            
                             <div class="text-center"> 
                                	<button type="submit">Login</button>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>