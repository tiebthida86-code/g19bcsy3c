<h1>User List</h1>
<a href="./?page=user/create">Create User</a>

<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h3>User List</h3>
        <a href="./?pages=user/create" class="btn btn-success">Create New</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $users = getUser();
            $count = 1;
            while ($row = $users->fetch_object()) {
                ?>
                <tr>
                    <td>
                        <?php echo $count ?>
                    </td>
                    <td><img src="<?php echo $row->photo ??
                        './assets/images/emptyuser.png' ?>">
                    </td>
                    <td>
                        <?php echo $row->name ?>
                    </td>
                    <td>
                        <a href="./?page=user/update&id=<?php echo $row->id ?>" class="btn btn-primary">
                            Update <i class="bi bi-pencil-fill"></i>
                        </a>
                        <a href="./?page=user/delete&id=<?php echo $row->id ?>" class="btn btn-danger button-delete">
                            Delete <i class="bi bi-trash3-fill"></i>
                        </a>


                    </td>
                </tr>
                <?php
                $count++;


            }
            ?>

        </tbody>

    </table>

</div>

<script>
    const btnDeletes = document.querySelector('.button-delete');
    // btnDeletes.forEach(element => {
    //     element.addEventListener('click', function(e) {
    //         e.preventDefault();
    //         alert('click')
    //     });
    // });
    $(document).ready(function () {
        
        $('.button-delete').click(function (e) {
            e.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f04f2b",
                cancelButtonColor: "rgb(185, 174, 174)",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) ({
                   window.location.href= $(this).attr('href');
                });
            });

        });


    });


</script>