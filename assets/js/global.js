$(function(){

    setTimeout(function(){
        $('.alert').alert('close');
    }, 5000);

    $(document).on("click", ".delete", function(){
        id = $(this).closest('tr').find('td:first-child').text();
        
        if (typeof id != 'undefined') {
            swal.fire({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {

                    window.location.href = 'process.php?action=delete&id='+id;
                    
                    swal.fire(
                        'Data deleted!'
                    );               
                }
            })
        }
        
    });

});