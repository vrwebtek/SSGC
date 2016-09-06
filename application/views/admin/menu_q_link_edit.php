<?php defined('BASEPATH') OR exit('No direct script access allowed'); $this->session->set_userdata('previous_page', current_url());

	$id=$mql[0]['id'];
	$quick_link=$mql[0]['quick_link'];
	$body=$mql[0]['body'];
	$bgi=$mql[0]['bgi'];
	$bgit=$mql[0]['bgit'];
	$slug=$mql[0]['slug'];


	$default_menu_bg=$default_mn_bg[0]['image'];

?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Menu Quick Link </strong></small></h3>
              </div>
            </div>
            
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Quick Link Here</small></h2>
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
                    
                    <?php echo form_open_multipart('admin/menu_q_l_update/'.$id,'class="form-horizontal form-label-left"','data-parsley-validate');?>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Quick Link<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-2">
                          <input type="text" id="name" name="name" value="<?php echo $quick_link; ?>" required class="form-control col-md-7 col-xs-12">
                          <input type="hidden" name="id" value="<?php echo $id?>" />
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Body <span class="required">*</span>
                        </label>
                       <div class="col-md-12 col-sm-6 col-xs-12">
                          <textarea name="body"><?php echo $body; ?></textarea>
                          <?php echo $error;?>
                        </div>
                      </div>
                      
                      <?php
                      	if(empty($bgi))
						{
					  ?>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Default Background Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <img src="<?php echo base_url('assets/public/images/'.$default_menu_bg); ?>" width="200" height="100" />
                        </div>
                      </div>
                      <?php
						}
						else{
					  ?>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Current Background Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img src="<?php echo base_url('assets/public/images/menu_background/'.$bgi); ?>" width="200" height="100" />
                        </div>
                      </div>
                      <?php
						}
					  ?>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Background Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="bgi" />
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Background Text<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-2">
                          <input type="text" id="bgit" name="bgit" value="<?php echo $bgit; ?>"  required class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        	<button type="submit" class="btn btn-success">Submit</button>
                          	<button type="reset" class="btn btn-primary">Cancel</button>
                            <a href="<?php echo site_url('admin/menu_ql_delete/'.$id); ?>" class="btn btn-danger">Delete</a>
                            <a href="<?php echo site_url('admin/seo_keyword_page_final/'.$quick_link.'/'.$slug);?>" class="btn btn-primary">SEO Keywords</a>
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