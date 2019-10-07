@extends('layout.master-layout')
@section('body')
    <div class="main_content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 col-lg-8 offset-md-2">
                    <div class="post_page_option">
                        <h4 class="text-center">Edit post</h4>
                        <form action="#" id="post_form">
                            <div class="form-group">
                                <select name="sub_cat" id="sub_ca" class="form-control rounded-0">
                                    <option selected disabled>Selcet a sub catagory</option>
                                    <option value="">Electronic and computer</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="title"  class="form-control rounded-0" id="title" placeholder="Enter Post title here">
                            </div>
                            <div class="form-group">
                                <input type="text" name="price"  class="form-control rounded-0" id="price" placeholder="Enter Price here">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email"  class="form-control rounded-0" id="email" placeholder="Enter email here (Required)">
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone_no"  class="form-control rounded-0" id="phone_no" placeholder="Enter Phone number here (optional)">
                            </div>
                            <div class="form-group">
                                <textarea rows="5" name="item_desc"  class="form-control rounded-0" id="item_desc" placeholder="Describe your item (optional)"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="test">
                                    <div class="file_upload">Click or drop something here</div>
                                    <input type="file" id="test">
                                </label>
                                <p id="filename"></p>
                            </div>
                            <div class="form_footer">
                                <div class="row">
                                    <div class="col-md-10 col-lg-10">
                                        <p>Note : Post will be stay online for 30 days. if not deleted</p>
                                    </div>
                                    <div class="col-md-1 col-lg-2">
                                        <input type="submit" class="btn btn-primary rounded-0">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        </form>
    </div>
@endsection