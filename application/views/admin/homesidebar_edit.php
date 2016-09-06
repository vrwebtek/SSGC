<?php defined('BASEPATH') OR exit('No direct script access allowed');
		
		$name=$single_quick_link[0]['name'];
		$slug=$single_quick_link[0]['slug'];
		$body=$single_quick_link[0]['body'];
		$bgi=$single_quick_link[0]['bgi'];
		$bgit=$single_quick_link[0]['bgit'];
		$id=$single_quick_link[0]['id'];
		
	$default_menu_bg=$default_mn_bg[0]['image'];
	$this->session->set_userdata('previous_page', current_url());
?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Home/sidebar (Quicklinks) </strong></small></h3>
              </div>
            </div>
            
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update Quick Links</small></h2>
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
                    
                    <?php echo form_open_multipart('admin/quicklink/update','class="form-horizontal form-label-left"','data-parsley-validate');?>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">quick link Text<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="qltext" name="qltext" value="<?php echo $name; ?>" required class="form-control col-md-7 col-xs-12">
                          <input type="hidden" name="id" value="<?php echo $id; ?>">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Quicklink body <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="qlbody"><?php echo $body; ?></textarea>
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
                            <a href="<?php echo site_url('admin/seo_keyword_page_final/'.$name.'/'.$slug);?>" class="btn btn-primary">SEO Keywords</a>
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
                    <h2>List of quicklinks used in home page</h2>
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
                          <th>Quick Link Text</th>
                          <th>Quick Link Body</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
								$counter=0;
								foreach($all_quick_link as $row)
								{
									$counter++;
							?>
                            <tr>
                            	<td>
                                	<?php echo $counter; ?>
                                </td>
                                <td>
                                	<?php echo $row->name; ?>
                                </td>
                                <td>
                                	<?php echo $row->body; ?>
                                </td>
                                <td>
                                	<a class="btn btn-app" href="<?php echo site_url('admin/homesidebar_edit/'.$row->id); ?>">
                      					<i class="fa fa-edit"></i> Edit
                    				</a>
                                    <a class="btn btn-app" href="<?php echo site_url('admin/homesidebar_delete/'.$row->id); ?>">
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