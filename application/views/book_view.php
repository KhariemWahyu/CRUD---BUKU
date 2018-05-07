<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book Codeigniter</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css');?>">
</head>
<body>
    <div class="container">
        <h1>Codeigniter</h1>
        <h3>Book Store</h3>

        <button class="btn btn-success" onclick="add_book()"><i class="glyphicon glyphicon-plus"></i>Add Book</button>
        <br>
        <br>

        <table id="table_id" class="table table-stripped table-bordered">
            <thead>
                <tr>
                <th>Book Id</th>
                <th>Book ISBN</th>
                <th>Book Title</th>
                <th>Book Author</th>
                <th>Book Category</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($books as $book) {
                ?>
                    <tr>
                    <td><?php echo $book->book_id;?></td>
                    <td><?php echo $book->book_isbn;?></td>
                    <td><?php echo $book->book_title;?></td>
                    <td><?php echo $book->book_author;?></td>
                    <td><?php echo $book->book_category;?></td>
                    <td>
                        <button class="btn btn-warning" onclick="edit_book(<?php echo $book->book_id ;?>)"><i class="glyphicon glyphicon-pencil"></i></button> 
                        <buntton class="btn btn-danger" onclick="delete_book(<?php echo $book->book_id ;?>)"><i class="glyphicon glyphicon-remove"></i></a> 
                    </td>
                    </tr>
                    <?php
                    }?>
            </tbody>
        </table>
    </div>

    <!-- alamat menuju js -->
    <script src="<?php echo base_url('assets/jquery/jquery-3.3.1.min.js');?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js');?>"></script>

    <!-- js -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table_id').DataTable();
        });

        var save_method;
        var table;
        
        function add_book(){
            save_method = 'add';
            $('#form')[0].reset();
            $('#modal_form').modal('show');
        }

        
        function save(){
            var url;

            if(save_method == 'add'){
                url = '<?php echo site_url('index.php/Book/book_add');?>';
            }else{
                url = '<?php echo site_url('index.php/Book/book_update');?>';
            } 

            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                // dataType: "JSON",
                success: function(data){
                    // $('#modal_form').modal('hide');
                    // location.reload();
                    // alert(data);
                    location.reload();
                },
                error: function(data){ 
                    
                }
            });

            // alert($('#form').serialize());
        }
        
        function edit_book(id){
            save_method = 'add';
            $('#form_edit')[0].reset();
            
            $.ajax({
                url : "<?php echo base_url('index.php/book/ajax_edit/');?>"+id, 
                type: "GET",
                dataType : "JSON",
                success : function(data){
                    $('[name="book_id"]').val(data.book_id);
                    $('[name="book_isbn"]').val(data.book_isbn);
                    $('[name="book_title"]').val(data.book_title);
                    $('[name="book_author"]').val(data.book_author);
                    $('[name="book_category"]').val(data.book_category);
                    $('#modal_edit').modal('show'); 
                    $('.modal_title').text('Edit Book');

                    $('#modal_edit').data('edit-id' , data.book_id);
 
                },
                error : function(jqXHR, textStatus, errorThrowm){
                    alert('Error Get Data From Ajax');
                }
            });
        }

        function update(){
            var url = "<?php echo base_url('index.php/Book/book_update'); ?>";
            
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form_edit').serialize(),
                // dataType: "JSON",
                success: function(data){ ;
                    // alert(data);
                    location.reload();
                },
                error: function(data){ 
                    
                }
            });

            // alert($('#form').serialize());
        }
        function delete_book(id){
            if(confirm('Are you sure delete this data ?')){ 
            // ajax delete data dari database
            $.ajax(
                {
                    url: "<?php echo base_url('index.php/book/book_delete') ;?>",
                    type: "post",
                    data : { book_id : id },
                    dataType: "json",
                    success: function(data){
                        // alert('berhasil');
                        location.reload(); 
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error Deleteng Data');
                    }
                }
            )
        
            }
        }
        
    </script>

    <!-- javascript modal -->
        <div class="modal fade" id="modal_form">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Modal title</h4>
        </div>
        <div class="modal-body form">
            <form action="#" id="form" class="form-horizontal">
            <input type="hidden" value="" name="book_id">

            <!-- form book ISBN -->
            <div class="form-body">
                <div class="form-group">
                <label class="control-label col-md-3">Book ISBN</label>
                <div class="col-md-9">
                <input type="text" name="book_isbn" placeholder="Book ISBN" class="form-control">
                </div>
                </div>
            </div>

             <!-- form book Title -->
            <div class="form-body">
                <div class="form-group">
                <label class="control-label col-md-3">Book Title</label>
                <div class="col-md-9">
                <input type="text" name="book_title" placeholder="Book Title" class="form-control">
                </div>
                </div>
            </div>

             <!-- form book Author-->
            <div class="form-body">
                <div class="form-group">
                <label class="control-label col-md-3">Book Author</label>
                <div class="col-md-9">
                <input type="text" name="book_author" placeholder="Book Author" class="form-control">
                </div>
                </div>
            </div>

             <!-- form book Category-->
            <div class="form-body">
                <div class="form-group">
                <label class="control-label col-md-3">Book Category</label>
                <div class="col-md-9">
                <input type="text" name="book_category" placeholder="Book Category" class="form-control">
                </div>
                </div>
            </div>

            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" onclick="save()" class="btn btn-primary">Submit</button>
        </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

     <!-- Modal Edit -->

    <div class="modal fade" id="modal_edit">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Modal title</h4>
        </div>
        <div class="modal-body form">
            <form action="#" id="form_edit" class="form-horizontal">
            <input type="hidden" value="" name="book_id">

            <!-- form book ISBN -->
            <div class="form-body">
                <div class="form-group">
                <label class="control-label col-md-3">Book ISBN</label>
                <div class="col-md-9"> 
                <input type="text" name="book_isbn" placeholder="Book ISBN" class="form-control">
                </div>
                </div>
            </div>

             <!-- form book Title -->
            <div class="form-body">
                <div class="form-group">
                <label class="control-label col-md-3">Book Title</label>
                <div class="col-md-9">
                <input type="text" name="book_title" placeholder="Book Title" class="form-control">
                </div>
                </div>
            </div>

             <!-- form book Author-->
            <div class="form-body">
                <div class="form-group">
                <label class="control-label col-md-3">Book Author</label>
                <div class="col-md-9">
                <input type="text" name="book_author" placeholder="Book Author" class="form-control">
                </div>
                </div>
            </div>

             <!-- form book Category-->
            <div class="form-body">
                <div class="form-group">
                <label class="control-label col-md-3">Book Category</label>
                <div class="col-md-9">
                <input type="text" name="book_category" placeholder="Book Category" class="form-control">
                </div>
                </div>
            </div>

            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" onclick="update()" class="btn btn-primary">Submit</button>
        </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</body>
</html>