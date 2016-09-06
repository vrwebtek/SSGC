<?php 
	defined('BASEPATH') OR exit('No direct script access allowed'); 
	$this->session->set_userdata('previous_page', current_url());
	//error_reporting(0); 
	
	foreach($single_result as $r)
	{
		$heading=$r->heading;
		$body=$r->body;
		$id=$r->id;
	}
?><!-- page content -->
        <div class="right_col" role="main">
          
            
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Home page body</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    
                    <?php echo form_open_multipart('admin/home_update','class="form-horizontal form-label-left"','data-parsley-validate');?>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Body Heading<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="heading" name="heading" value="<?php echo $heading; ?>" required class="form-control col-md-7 col-xs-12">
                          <input type="hidden" name="bodyid" value="<?php echo $id; ?>" >
                        </div>
                      </div>
                      
                      
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Homepage body content <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-6 col-xs-12">
                          <textarea name="body" class="form-control col-md-7 col-xs-12" required><?php echo $body; ?></textarea>
                          <?php echo $error;?>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        	<button type="submit" class="btn btn-success">Submit</button>
                          	<button type="submit" class="btn btn-primary">Cancel</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          </div><!--this should be the last div-->
        
        
        
        <!-- /page content -->