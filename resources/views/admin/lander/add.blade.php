@include('admin.layout.header')
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
                    <form class="forms-sample" action="{{ route('admin.addLanderpagedata') }}" method="post">
                    {!! csrf_field() !!}
                      <div class="form-group">
                                <label>home Logo</label>
                                <input type="text" class="form-control" name="halochat_logo" id="halochat_logo" value="{{ isset($landerdata[0]->halochat_logo) ? $landerdata[0]->halochat_logo : '' }}">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="id" value="{{ $landerdata[0]->id }}" id="id" >
                                <?php if ($landerdata) { ?>
                                    <img src="{{ isset($landerdata[0]->halochat_logo) ? $landerdata[0]->halochat_logo : '' }}" height="100" width="100" alt="product_img"
                                        class="img-fluid site_setting_img_product">
                                    <!-- <a class="btn btn-danger btn-rounded btn-icon remove-image" href="#" style="height: 20px;width: 20px;margin: 15px;"
                                        data-image="{{ isset($landerdata[0]->halochat_logo) ? $landerdata[0]->halochat_logo : '' }}"
                                        data-id="{{ isset($landerdata[0]->id) ? $landerdata[0]->halochat_logo : '' }}">&#215;</a> -->
                                    <?php } ?>
                                  </div>
                       
                      <div class="form-group">
                        <label for="exampleInputEmail3">sign_up_now_text</label>
                        <input type="text" class="form-control" id="sign_up_now_text"  name="sign_up_now_text" value="{{ isset($landerdata[0]->sign_up_now_text) ? $landerdata[0]->sign_up_now_text : '' }}" placeholder="sign_up_now_text">
                      </div>
                      @error('sign_up_now_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror


                     <div class="form-group">
                        <label for="exampleInputEmail3">sign_up_now_link</label>
                        <input type="text" class="form-control" id="sign_up_now_link" name="sign_up_now_link" value="{{ isset($landerdata[0]->sign_up_now_link) ? $landerdata[0]->sign_up_now_link : '' }}" placeholder="sign_up_now_link">
                      </div>
                      @error('sign_up_now_link')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">Introducing text</label>
                        <textarea name="Introducing_text" class="form-control custom-min-height" name="Introducing_text"  id="Introducing_text" height="30" placeholder="Introducing_text">{!! isset($landerdata[0]->Introducing_text) ? $landerdata[0]->Introducing_text : '' !!}</textarea>
                   
                      </div>
                      @error('Introducing_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">Pioneering text</label>
                        <input type="text" class="form-control" id="pioneering_text" name="pioneering_text" value="{{ isset($landerdata[0]->pioneering_text) ? $landerdata[0]->pioneering_text : '' }}" placeholder="pioneering_text">
                      </div>
                      @error('pioneering_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror


                     <div class="form-group">
                        <label for="exampleInputEmail3">Discover more</label>
                        <input type="text" class="form-control" id="discover_more" name="discover_more" value="{{ isset($landerdata[0]->discover_more) ? $landerdata[0]->discover_more : '' }}" placeholder="discover_more">
                      </div>
                      @error('discover_more')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">Discover more link</label>
                        <input type="text" class="form-control" id="discover_more_link" name="discover_more_link" value="{{ isset($landerdata[0]->discover_more_link) ? $landerdata[0]->discover_more_link : '' }}" placeholder="discover_more_link">
                      </div>
                      @error('discover_more_link')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror


                     <div class="form-group">
                        <label for="exampleInputEmail3">Lets talk image</label>
                        <input type="text" class="form-control" id="lets_talk_img" name="lets_talk_img" value="{{ isset($landerdata[0]->lets_talk_img) ? $landerdata[0]->lets_talk_img : '' }}" placeholder="lets_talk_img">
                      </div>
                      <div class="form-group">
                                <?php if ($landerdata) { ?>
                                    <img src="{{ isset($landerdata[0]->lets_talk_img) ? $landerdata[0]->lets_talk_img : '' }}" height="100" width="100" alt="product_img"
                                        class="img-fluid site_setting_img_product">
                                    <?php } ?>
                                  </div>
                      @error('lets_talk_img')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">Welcome heading</label>
                        <input type="text" class="form-control" id="welcome_heading" name="welcome_heading" value="{{ isset($landerdata[0]->welcome_heading) ? $landerdata[0]->welcome_heading : '' }}" placeholder="welcome_heading">
                      </div>
                      @error('welcome_heading')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror


                     <div class="form-group">
                        <label for="exampleInputEmail3">Welcome sub text</label>
                        <textarea class="form-control custom-min-height" name="welcome_sub_text"  id="welcome_sub_text" height="30" placeholder="welcome_sub_text">{{ isset($landerdata[0]->welcome_sub_text) ? $landerdata[0]->welcome_sub_text : '' }}</textarea>
                      </div>
                      @error('welcome_sub_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">Welcome lady image</label>
                        <input type="text" class="form-control" id="welcome_lady_img" name="welcome_lady_img" value="{{ isset($landerdata[0]->welcome_lady_img) ? $landerdata[0]->welcome_lady_img : '' }}" placeholder="welcome_lady_img">
                      </div>
                      <div class="form-group">
                                <?php if ($landerdata) { ?>
                                    <img src="{{ isset($landerdata[0]->welcome_lady_img) ? $landerdata[0]->welcome_lady_img : '' }}" height="100" width="100" alt="product_img"
                                        class="img-fluid site_setting_img_product">
                                    <?php } ?>
                                  </div>
                      @error('welcome_lady_img')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">Features heading</label>
                        <input type="text" class="form-control" id="features_heading" name="features_heading" value="{{ isset($landerdata[0]->features_heading) ? $landerdata[0]->features_heading : '' }}" placeholder="features_heading">
                      </div>
                      @error('features_heading')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">Features sub text</label>
                        <textarea name="features_sub_text" class="form-control custom-min-height" id="features_sub_text" >{{ isset($landerdata[0]->features_sub_text) ? $landerdata[0]->features_sub_text : '' }}</textarea>
                      @error('features_sub_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror


                     <div class="form-group">
                        <label for="exampleInputEmail3">Explore btn text</label>
                        <input type="text" class="form-control" id="explore_btn_text" name="explore_btn_text" value="{{ isset($landerdata[0]->explore_btn_text) ? $landerdata[0]->explore_btn_text : '' }}" placeholder="explore_btn_text">
                      </div>
                      @error('explore_btn_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror
                     

                     <div class="form-group">
                        <label for="exampleInputEmail3">Explore button link</label>
                        <input type="text" class="form-control" id="explore_btn_link" name="explore_btn_link" value="{{ isset($landerdata[0]->explore_btn_link) ? $landerdata[0]->explore_btn_link : '' }}" placeholder="explore_btn_link">
                      </div>
                      @error('explore_btn_link')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">Meet your heading</label>
                        <input type="text" class="form-control" id="meet_your_heading" name="meet_your_heading" value="{{ isset($landerdata[0]->meet_your_heading) ? $landerdata[0]->meet_your_heading : '' }}" placeholder="meet_your_heading">
                      </div>
                      
                      @error('meet_your_heading')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror


                     <div class="form-group">
                        <label for="exampleInputEmail3">Meet your sub text</label>
                        <textarea name="enhanced_features_sub_text" class="form-control custom-min-height"  id="meet_your_sub_text" height="30" placeholder="meet_your_sub_text">{{ isset($landerdata[0]->meet_your_sub_text) ? $landerdata[0]->meet_your_sub_text : '' }}</textarea>
                      </div>
                      @error('meet_your_sub_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror
                     
                     <div class="form-group">
                        <label for="exampleInputEmail3">Meet your image</label>
                        <input type="text" class="form-control" id="meet_your_img" name="meet_your_img" value="{{ isset($landerdata[0]->meet_your_img) ? $landerdata[0]->meet_your_img : '' }}" placeholder="meet_your_img">
                      </div>
                      <div class="form-group">
                                <?php if ($landerdata) { ?>
                                    <img src="{{ isset($landerdata[0]->meet_your_img) ? $landerdata[0]->meet_your_img : '' }}" height="100" width="100" alt="product_img"
                                        class="img-fluid site_setting_img_product">
                                    <?php } ?>
                                  </div>
                      @error('meet_your_img')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">enhanced_features_heading</label>
                        <input type="text" class="form-control" id="enhanced_features_heading" name="enhanced_features_heading" value="{{ isset($landerdata[0]->enhanced_features_heading) ? $landerdata[0]->enhanced_features_heading : '' }}" placeholder="enhanced_features_heading">
                      </div>
                      @error('enhanced_features_heading')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">enhanced_features_sub_text</label>
                        <textarea name="meet_your_sub_text" class="form-control custom-min-height"  id="enhanced_features_sub_text" height="30" placeholder="enhanced_features_sub_text">{{ isset($landerdata[0]->enhanced_features_sub_text) ? $landerdata[0]->enhanced_features_sub_text : '' }}</textarea>
                      </div>
                      @error('enhanced_features_sub_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror


                     <div class="form-group">
                        <label for="exampleInputEmail3">cta_title_text</label>
                        <input type="text" class="form-control" id="cta_title_text" name="cta_title_text" value="{{ isset($landerdata[0]->cta_title_text) ? $landerdata[0]->cta_title_text : '' }}" placeholder="cta_title_text">
                      </div>
                      @error('cta_title_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror


                     <div class="form-group">
                        <label for="exampleInputEmail3">cta_lady_img</label>
                        <input type="text" class="form-control" id="cta_lady_img" name="cta_lady_img" value="{{ isset($landerdata[0]->cta_lady_img) ? $landerdata[0]->cta_lady_img : '' }}" placeholder="cta_lady_img">
                      </div>
                      @error('cta_lady_img')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror
                     <div class="form-group">
                                <?php if ($landerdata) { ?>
                                    <img src="{{ isset($landerdata[0]->cta_lady_img) ? $landerdata[0]->cta_lady_img : '' }}" height="100" width="100" alt="product_img"
                                        class="img-fluid site_setting_img_product">
                                    <?php } ?>
                                  </div>
                     

                     <div class="form-group">
                        <label for="exampleInputEmail3">cta_sub_text</label>
                        <input type="text" class="form-control" id="cta_sub_text" name="cta_sub_text" value="{{ isset($landerdata[0]->cta_sub_text) ? $landerdata[0]->cta_sub_text : '' }}" placeholder="cta_sub_text">
                      </div>
                      @error('cta_sub_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">customer_feedback</label>
                        <input type="text" class="form-control" id="customer_feedback" name="customer_feedback" value="{{ isset($landerdata[0]->customer_feedback) ? $landerdata[0]->customer_feedback : '' }}" placeholder="customer_feedback">
                      </div>
                      @error('customer_feedback')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">privacy_policy_text</label>
                        <input type="text" class="form-control" id="privacy_policy_text" name="privacy_policy_text" value="{{ isset($landerdata[0]->privacy_policy_text) ? $landerdata[0]->privacy_policy_text : '' }}" placeholder="privacy_policy_text">
                      </div>
                      @error('privacy_policy_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">privacy_policy_link</label>
                        <input type="text" class="form-control" id="privacy_policy_link" name="privacy_policy_link" value="{{ isset($landerdata[0]->privacy_policy_link) ? $landerdata[0]->privacy_policy_link : '' }}" placeholder="privacy_policy_link">
                      </div>
                      @error('privacy_policy_link')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">terms_conditions_text</label>
                        <input type="text" class="form-control" id="terms_conditions_text" name="terms_conditions_text" value="{{ isset($landerdata[0]->terms_conditions_text) ? $landerdata[0]->terms_conditions_text : '' }}" placeholder="terms_conditions_text">
                      </div>
                      @error('terms_conditions_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror

                     <div class="form-group">
                        <label for="exampleInputEmail3">terms_conditions_link</label>
                        <input type="text" class="form-control" id="terms_conditions_link" name="terms_conditions_link" value="{{ isset($landerdata[0]->terms_conditions_link) ? $landerdata[0]->terms_conditions_link : '' }}" placeholder="terms_conditions_link">
                      </div>
                      @error('terms_conditions_link')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror
                     
                     <div class="form-group">
                        <label for="exampleInputEmail3">revolution_text</label>
                        <input type="text" class="form-control" id="revolution_text" name="revolution_text" value="{{ isset($landerdata[0]->revolution_text) ? $landerdata[0]->revolution_text : '' }}" placeholder="revolution_text">
                      </div>
                      @error('revolution_text')
                            <span class="text-danger">{{ $message }}</span>
                     @enderror
                     

                     <!-- <div class="form-group">
                        <label for="exampleInputEmail3">Testimonial Name</label>
                        <input type="text" class="form-control" id="testimonial_name" name="testimonial_name" value="{{ isset($landerdata[0]->testimonial_name) ? $landerdata[0]->testimonial_name : '' }}" placeholder="testimonial_name">
                        <label for="exampleInputEmail3">Testimonial content</label>
                        <input type="text" class="form-control" id="testimonial_content" name="testimonial_content" value="{{ isset($landerdata[0]->testimonial_content) ? $landerdata[0]->testimonial_content : '' }}" placeholder="testimonial_content">
                        <label for="exampleInputEmail3">Testimonial Image</label>
                        <input type="text" class="form-control" id="testimonial_image" name="testimonial_image" value="{{ isset($landerdata[0]->testimonial_image) ? $landerdata[0]->testimonial_image : '' }}" placeholder="testimonial_image">
                      </div> -->

                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                      <button class="btn btn-dark">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
              </div>
              </div>



@include('admin.layout.footer')

