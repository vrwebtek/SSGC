<?php defined('BASEPATH') OR exit('No direct script access allowed'); $this->session->set_userdata('previous_page', current_url());
	$id=$single_team[0]['id'];
	$name=$single_team[0]['name'];
	$designation=$single_team[0]['designation'];
	$description=$single_team[0]['description'];
	$photo=$single_team[0]['photo'];
	$type=$single_team[0]['type'];
?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                
              </div>
            </div>
            
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add <?php echo $type; ?> team Here</small></h2>
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
                    
                    <?php echo form_open_multipart('admin/team_update/','class="form-horizontal form-label-left"','data-parsley-validate');?>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-2">
                          <input type="text" id="name" name="name" value="<?php echo $name; ?>"  required class="form-control col-md-7 col-xs-12">
                          <input type="hidden" name="id" value="<?php echo $id; ?>" >
                          <input type="hidden" name="type" value="<?php echo $type; ?>" >
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Designation<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-2">
                          <input type="text" id="designation" name="designation" value="<?php echo $designation; ?>"  required class="form-control col-md-7 col-xs-12">
                          
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description <span class="required">*</span>
                        </label>
                       <div class="col-md-12 col-sm-6 col-xs-12">
                          <textarea name="description"><?php echo $description; ?></textarea>
                          <?php echo $error;?>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Current photo <span class="required">*</span>
                        </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                          <img src="<?php echo base_url('assets/public/images/team/'.$type.'/'.$photo); ?>" >
                        </div>
                      </div>
                      
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Photo <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="photo" />
                        </div>
                      </div>
                      
                      

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        	<button type="submit" class="btn btn-success">Submit</button>
                          	<button type="reset" class="btn btn-primary">Cancel</button>
                           
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          
          
        </div>
        
        
        
        <!-- /page content -->