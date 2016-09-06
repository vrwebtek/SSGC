<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); $this->session->set_userdata('previous_page', current_url());
?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Home/Slider </strong></small></h3>
              </div>
            </div>
            
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add a new slider for homepage here</small></h2>
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
                    
                    <?php echo form_open_multipart('admin/slider_upload/new','class="form-horizontal form-label-left"','data-parsley-validate');?>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Text<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="slidetText" name="sliderText" required class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Upload Slider <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="sliderFile" name="sliderFile" required class="form-control col-md-7 col-xs-12">
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
          
          <div class="row">
          	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of sliders used in home page</h2>
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
                          <th>Image</th>
                          <th>Slider Text</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
								$counter=0;
								foreach($slider_result as $row)
								{
									$counter++;
							?>
                            <tr>
                            	<td>
                                	<?php echo $counter; ?>
                                </td>
                                <td>
                                	<img src="<?php echo base_url('assets/public/images/'.$row->image); ?>" width="200" height="100">
                                </td>
                                <td>
                                	<?php echo $row->image_text; ?>
                                </td>
                                <td>
                                	<a class="btn btn-app" href="<?php echo site_url('admin/sliderEdit/'.$row->id); ?>">
                      					<i class="fa fa-edit"></i> Edit
                    				</a>
                                    <a class="btn btn-app" href="<?php echo site_url('admin/sliderDelete/'.$row->id); ?>">
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