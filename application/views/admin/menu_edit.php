<?php defined('BASEPATH') OR exit('No direct script access allowed'); $this->session->set_userdata('previous_page', current_url());
foreach($menu as $mn)
{
	$id=$mn->id;
	$menu=$mn->menu;
	$body=$mn->body;
	$bgi=$mn->bgi;
	$bgit=$mn->bgit;
}
foreach($default_mn_bg as $def)
{
	$default_menu_bg=$def->image;
}
?>

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><a href="<?php echo site_url('admin/menu_q_link/'.$id); ?>" class="btn btn-primary">Add Quick Links for <?php echo $menu;?></a> </strong></small></h3>
              </div>
            </div>
            
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Menu Here</small></h2>
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
                    
                    <?php echo form_open_multipart('admin/menu_update/'.$id,'class="form-horizontal form-label-left"','data-parsley-validate');?>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-2">
                          <input type="text" id="name" name="name" value="<?php echo $menu; ?>" required class="form-control col-md-7 col-xs-12">
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
                            <a href="<?php echo site_url('admin/menu_delete/'.$mn->id); ?>" class="btn btn-danger">Delete</a>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
          	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Quick Links used</h2>
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
                    
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr.</th>
                          <th>Quick Link</th>
                          <th>Body</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
								$counter=0;
								foreach($menu_ql as $row)
								{
									$counter++;
							?>
                            <tr>
                            	<td>
                                	<?php echo $counter; ?>
                                </td>
                                <td>
                                	<?php echo $row->quick_link; ?>
                                </td>
                                <td>
                                	<?php echo $row->body; ?>
                                </td>
                                <td>
                                	<a class="btn btn-app" href="<?php echo site_url('admin/menu_ql_edit/'.$row->id); ?>">
                      					<i class="fa fa-edit"></i> Edit
                    				</a>
                                    <a class="btn btn-app" href="<?php echo site_url('admin/menu_ql_delete/'.$row->id); ?>">
                      					<i class="fa fa-trash"></i> Delete
                    				</a>
                                </td>
                           </tr>
                            <?php
								}
							?>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
          </div>
          
        </div>
        
        
        
        <!-- /page content -->