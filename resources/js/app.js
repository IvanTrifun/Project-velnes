$(document).ready(function() {
    console.log('from app.js');

    // Open modal function
    // window.openModal = function(index, link) {
        // var linkRect = link.getBoundingClientRect();
    //     var modal = $('#myModal' + index);
    //     var groupId = $('.options').data('group-id');

    //     // Set the position of the modal slightly above the link
    // modal.css({
    //     left: linkRect.left + 'px',
    //     top: linkRect.top - 10 + 'px' // Adjust the value as needed
    // });


    //     modal.modal('show');


    // };


    $('#createNewGroup').click(function() {
        $('#createNewGroupModal').modal('show');
    });

    $('#createNewTool').click(function() {
        $('#ceateToolsModal').modal('show');
    });

    $('#createNewRoom').click(function() {
        $('#createRoomsModal').modal('show');
    });

    var optionsLinks = document.querySelectorAll('.options');
    optionsLinks.forEach(function(link){
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var eachId = $(this).data('each-id')
            var modal = $('.optionsModal-' + eachId)
            console.log('.optionsModal-' + eachId)

            var offset = link.getBoundingClientRect();
            var topPosition = offset.top + window.scrollY;
            var leftPosition = offset.left + window.scrollX;

            modal.css({
                top: topPosition - 10 + 'px',
                left: leftPosition + 'px'
            })

            // modal.css('top', '-'+ rect.top + window.scrollY - modal.height() + 'px');
            // modal.css('left', rect.left + window.scrollX + 'px');

            modal.modal('show');

            $('.edit-' + eachId).click(function() {
                // Show the Edit Group modal
                $('#editModal-' + eachId).modal('show');
            });

        });
    })
        // // Extract the group ID from the data attribute
        // var eachId = $(this).data('each-id');
        // var element = document.querySelector('#options');
        // var linkRect = element.getBoundingClientRect();
        // eachIdString = String(eachId)
        // console.log(eachId)
        // var modal = $('.optionsModal-' + eachId);


        //     modal.css({
        //         left: linkRect.left + 'px',
        //         top: linkRect.top - 10 + 'px' // Adjust the value as needed
        //     });

        //     modal.modal('show');



        //     // Show the Options modal


        //     $('.edit-' + eachId).click(function() {
        //         // Show the Edit Group modal
        //         $('#editModal-' + eachId).modal('show');
        //     });

        // // Handle click for each Edit Group button within Options modal

});
