<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>CRUD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
</head>
<body>

<div class="card text-center" style="padding:15px;">
  <h4>Product Add</h4>
</div><br> 

<div class="container">
 <div class="row">

    <div class="col-sm-4">
    <h4 class="text-center  ml-4 mb-5">Insert Records</h4>
     <form  action="" method="POST">

        <div class="form-group">
        <input type="text" class="form-control  mb-4" name="book_name" placeholder="Product name" required="">
        </div>

        <div class="form-group">
        <input type="email" class="form-control  mb-4" name="book_slug" placeholder="Product slug" required="">
        </div>

        <div class="form-group">
        <input type="text" class="form-control mb-4" name="book_description" placeholder="Product description" required="">
        </div>

        <div class="custom-file mb-4">
           <input type="file" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
        
        <input type="submit" name="submit" class="btn btn-primary btn-block" style="float:right;" value="Submit">
    
    </form>
    </div>

  <div class="col-sm-8">
    <h4 class="text-center  ml-4  mb-5">View Records</h4>
    <table class="table table-hover table-bordered ml-4 ">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>User Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
           <p id="#data"></p>
        </tbody>
    </table>
  </div>
 </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<script>
  $(document).ready(function (){

  $(window).on("load", function () {
     $.ajax({
        url : "<?php echo base_url() ?>Prodcut_details/show_product",
        type : "ajax",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success : function(data){
           $.each(data.result, function(i,post){
                    //  $("#book_name").append(post.book_name); 
          //  $("#book_id").append(post.book_slug); 

          var newRow =  "<div class='row update_slug'>"
                +"<div class='col-12 col-sm-12 col-md-2 text-center'>"
                        +"<img class='img-responsive' src='<?php echo base_url().'assets/books/'?>"+post.book_img+"' alt='prewiew' width='50' height='auto'>"
                        +"</div>"
                        +"<div class='col-12 text-sm-center col-sm-12 text-md-left col-md-6'>"
                        +"<h5 class='book-name text-secondary'><strong>"+post.book_name+"</strong></h4>"
                        + "<h5>"
                        +"<small>"+post.book_desc+"</small>"
                        +"</h4>"
                        +"</div>"
              
                        +"<div class='col-12 col-sm-12 text-sm-center col-md-4 text-md-right  row'>"
                        +"<div class='col-3 col-sm-3 col-md-6 text-md-right' style='padding-top: 5px'>"
                        +"<h5 id='book_slug' class='font-weight-bold'><span>"+post.book_slug+"</span></h5>"
                        +"</div>"
                        +"<div class='col-4 col-sm-4 col-md-4'>"
                        +"<div class='quantity'>"
                        +"<input type='number'  step='1' max='99' min='1' id='"+post.book_id+"' value='"+post.book_qty+"' title='Qty' class='qty' size='4'>"    
                        +"</div>"
                        +"</div>"
                        +"<div class='col-2 col-sm-2 col-md-2 text-right'>"
                        +"<button type='button' id='.$row['book_id'].' class='btn btn-outline-danger btn-xs delete_cart'>"
                        +"<i class='fa fa-trash' aria-hidden='true'></i>"
                        +"</button>"
                        +"</div>"
                    +"</div>"
                    +"</div>"
                    +"<hr>";
             
                    $('#data').append(newRow);
            
                      });
        } 
      });
 });
