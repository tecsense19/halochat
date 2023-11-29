@include('admin.layout.header')
<?php 

?>


<div class="container-scroller">
    <div class="row p-0 m-0 proBanner" id="proBanner">

    </div>
    <!-- partial:partials/_sidebar.html -->
    @include('admin.layout.front')
    <div class="main-panel">
        <div class="content-wrapper">
        

        <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Home site Setting</h4>
                    <p class="card-description"> Settings </p>
                    <form class="forms-sample">

                      <div class="form-group">
                                <label>home Logo</label>
                                <input type="file" name="homelogo" id="homelogo" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled
                                        placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary check" type="button">Upload</button>
                                    </span>
                                </div>
                                <?php if ($landerdata) { ?>
                                    <img src="{{ isset($landerdata[0]->halochat_logo) ? $landerdata[0]->halochat_logo : '' }}" height="100" width="100" alt="product_img"
                                        class="img-fluid site_setting_img_product">
                                    <a class="btn btn-danger btn-rounded btn-icon remove-image" href="#" style="height: 20px;width: 20px;margin: 15px;"
                                        data-image="{{ isset($landerdata[0]->halochat_logo) ? $landerdata[0]->halochat_logo : '' }}"
                                        data-id="{{ isset($landerdata[0]->id) ? $landerdata[0]->halochat_logo : '' }}">&#215;</a>
                                    <?php } ?>
                        </div>
                       
                      <div class="form-group">
                        <label for="exampleInputEmail3">sign_up_now_text</label>
                        <input type="text" class="form-control" id="sign_up_now_text" value="{{ isset($landerdata[0]->sign_up_now_text) ? $landerdata[0]->sign_up_now_text : '' }}" placeholder="sign_up_now_text">
                      </div>
                      @error('sign_up_now_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror


                     <div class="form-group">
                        <label for="exampleInputEmail3">sign_up_now_link</label>
                        <input type="text" class="form-control" id="sign_up_now_link" value="{{ isset($landerdata[0]->sign_up_now_link) ? $landerdata[0]->sign_up_now_link : '' }}" placeholder="sign_up_now_link">
                      </div>
                      @error('sign_up_now_link')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">Introducing_text</label>
                        <textarea name="Introducing_text" class="form-control custom-min-height"  id="Introducing_text" height="30" placeholder="Introducing_text">{!! isset($landerdata[0]->Introducing_text) ? $landerdata[0]->Introducing_text : '' !!}</textarea>
                   
                      </div>
                      @error('Introducing_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">pioneering_text</label>
                        <input type="text" class="form-control" id="pioneering_text" value="{{ isset($landerdata[0]->pioneering_text) ? $landerdata[0]->pioneering_text : '' }}" placeholder="pioneering_text">
                      </div>
                      @error('pioneering_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror


                     <div class="form-group">
                        <label for="exampleInputEmail3">discover_more</label>
                        <input type="text" class="form-control" id="discover_more" value="{{ isset($landerdata[0]->discover_more) ? $landerdata[0]->discover_more : '' }}" placeholder="discover_more">
                      </div>
                      @error('discover_more')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">discover_more_link</label>
                        <input type="text" class="form-control" id="discover_more_link" value="{{ isset($landerdata[0]->discover_more_link) ? $landerdata[0]->discover_more_link : '' }}" placeholder="discover_more_link">
                      </div>
                      @error('discover_more_link')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror


                     <div class="form-group">
                        <label for="exampleInputEmail3">lets_talk_img</label>
                        <input type="text" class="form-control" id="lets_talk_img" value="{{ isset($landerdata[0]->lets_talk_img) ? $landerdata[0]->lets_talk_img : '' }}" placeholder="lets_talk_img">
                      </div>
                      @error('lets_talk_img')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">welcome_heading</label>
                        <input type="text" class="form-control" id="welcome_heading" value="{{ isset($landerdata[0]->welcome_heading) ? $landerdata[0]->welcome_heading : '' }}" placeholder="welcome_heading">
                      </div>
                      @error('welcome_heading')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror


                     <div class="form-group">
                        <label for="exampleInputEmail3">welcome_sub_text</label>
                        <textarea name="welcome_sub_text" class="form-control custom-min-height"  id="welcome_sub_text" height="30" placeholder="welcome_sub_text">{{ isset($landerdata[0]->welcome_sub_text) ? $landerdata[0]->welcome_sub_text : '' }}</textarea>
                      </div>
                      @error('welcome_sub_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">welcome_lady_img</label>
                        <input type="text" class="form-control" id="welcome_lady_img" value="{{ isset($landerdata[0]->welcome_lady_img) ? $landerdata[0]->welcome_lady_img : '' }}" placeholder="welcome_lady_img">
                      </div>
                      @error('welcome_lady_img')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">features_heading</label>
                        <input type="text" class="form-control" id="features_heading" value="{{ isset($landerdata[0]->features_heading) ? $landerdata[0]->features_heading : '' }}" placeholder="features_heading">
                      </div>
                      @error('features_heading')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">features_sub_text</label>
                        <textarea name="editor3" ></textarea>
                      <script>
                        CKEDITOR.replace('editor3');
                        var html = `{{ isset($landerdata[0]->welcome_sub_text) ? $landerdata[0]->welcome_sub_text : '' }}`;
                        CKEDITOR.instances['editor3'].setData(html);
                        </script>
                      </div>
                      @error('features_sub_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror


                     <div class="form-group">
                        <label for="exampleInputEmail3">explore_btn_text</label>
                        <input type="text" class="form-control" id="explore_btn_text" value="{{ isset($landerdata[0]->explore_btn_text) ? $landerdata[0]->explore_btn_text : '' }}" placeholder="explore_btn_text">
                      </div>
                      @error('explore_btn_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror
                     

                     <div class="form-group">
                        <label for="exampleInputEmail3">explore_btn_link</label>
                        <input type="text" class="form-control" id="explore_btn_link" value="{{ isset($landerdata[0]->explore_btn_link) ? $landerdata[0]->explore_btn_link : '' }}" placeholder="explore_btn_link">
                      </div>
                      @error('explore_btn_link')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">meet_your_heading</label>
                        <input type="text" class="form-control" id="meet_your_heading" value="{{ isset($landerdata[0]->meet_your_heading) ? $landerdata[0]->meet_your_heading : '' }}" placeholder="meet_your_heading">
                      </div>
                      @error('meet_your_heading')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror


                     <div class="form-group">
                        <label for="exampleInputEmail3">meet_your_sub_text</label>
                        <textarea name="meet_your_sub_text" class="form-control custom-min-height"  id="meet_your_sub_text" height="30" placeholder="meet_your_sub_text">{{ isset($landerdata[0]->meet_your_sub_text) ? $landerdata[0]->meet_your_sub_text : '' }}</textarea>
                      </div>
                      @error('meet_your_sub_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror
                     
            
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                      <button class="btn btn-dark">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
              </div>
              </div>



@include('admin.layout.footer')

