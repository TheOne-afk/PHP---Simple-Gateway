/* Ajaw */
$(document).ready(function(){ // first it add a function to the document, means it is ready
    /* Search AJAX */
     $('#search').keyup(function(){ // getting the events in input, gettings the keys
         let input = $(this).val(); // $(this) - this element | val() - get value

         if(input != ""){ // if the input is empty the perform this
             $.ajax({ // and by using the ajax method is like a object
                 url: "../utils/handle_admin_page.php", // direct to this page
                 method: "POST", // and using the post method
                 data: {input: input}, // with the data input

                 success:function(data){ // after successfully 
                     $('#searchresult').html(data) // then the data will display on this section
                 }
             })
         }
         else{
             $.ajax({
                url: "../utils/handle_admin_page.php", // Request all data
                method: "POST", // Still use POST for consistency
                data: {input: ""}, // Send an empty input to signal showing all data
    
                success: function(data) { // On success
                    $('#searchresult').html(data); // Display all the table data
                }
             })
         }
     })
     /* Edit */
     $(document).on("click", ".edit-button", function(event) { // add clicks to the edit button
         event.preventDefault();
         var $this = $(this);
         // Find the username cell and replace its content with an input field
         var $usernameCell = $this.closest("tr").find(".username");
         var $emailCell = $this.closest("tr").find(".email");
         var $roleCell = $this.closest("tr").find(".role");
         var $checkCell = $this.closest("tr").find("input[type='checkbox']");
         var currentEmail = $emailCell.text();
         var currentUsername = $usernameCell.text();
         var currentRole = $roleCell.text();
         var currentCheck = $checkCell.is(":checked"); 
         $checkCell.prop('disabled', false); // Enable the checkbox

         originalUsername = currentUsername;
         originalEmail = currentEmail;
         originalRole= currentRole;
         originalCheck = currentCheck;

         $usernameCell.html('<input type="text" class="edit-user" id="inputUsername" value="' + currentUsername + '" />');
         $emailCell.html('<input type="text" class="edit-email" id="inputEmail" value="' + currentEmail + '" />');
         $roleCell.html('<input type="text" class="edit-email edit-role" id="inputRole" value="' + currentRole + '" />');
         $checkCell.prop("checked", currentCheck);
         remove_enter_key($usernameCell.find('#inputUsername'));
         remove_enter_key($emailCell.find('#inputEmail'));
         remove_enter_key($roleCell.find('#inputRole'));
         $this.hide(); // Hide the edit button
         $this.siblings('.delete-button').hide();
         $this.siblings(".save-button").show(); // Show the save button
         $this.siblings('.cancel-button').show();
     })

     $(document).on("click", ".cancel-button", function(event) {
        event.preventDefault();
        var $this = $(this);
        var $row = $this.closest("tr");
    
        // Get the username cell
        var $usernameCell = $row.find(".username");
        var $emailCell = $row.find(".email");
        var $roleCell = $row.find(".role");
        var $roleCheck= $row.find("input[type='checkbox']");

        // Restore the username cell content back to the original
        $usernameCell.html(originalUsername); // Set the original username back
        $emailCell.html(originalEmail);
        $roleCell.html(originalRole);
        $roleCheck.html(originalCheck);
    
        // Hide the cancel button and show the edit button
        $this.hide();
        $row.find('.edit-button').show();
        $row.find('.save-button').hide();
        $this.siblings('.delete-button').show();
        $roleCheck.prop('disabled', true);
    });
    


     function remove_enter_key(item){
         item.on('keydown', function(event){
             if(event.key === "Enter"){
                 event.preventDefault();
             }
         })
     }

     /* Saved */
     $(document).on("click", ".save-button", function(event) {
         event.preventDefault();
 var $this = $(this);
 var $usernameCell = $this.closest("tr").find(".username");
 var $emailCell = $this.closest("tr").find(".email");
 var $roleCell = $this.closest("tr").find(".role");
 var $checkCell = $this.closest("tr").find("input[type='checkbox']");


 var newUsername = $usernameCell.find("input").val();
 var newEmail = $this.closest("tr").find("#inputEmail").val();
 var newRole = $this.closest("tr").find("#inputRole").val();
 var userId = $this.closest("tr").find(".id").text(); // Get the user ID from the table
 var isChecked = $checkCell.is(":checked"); // find the input that has type checkbox and then find if is checked
 $this.siblings('.cancel-button').hide();
 $this.siblings('.delete-button').show();

 // Send the new username and user ID to your server via AJAX
 $.ajax({
     url: '../utils/handle_admin_page.php', // Path to your PHP file
     type: 'POST',
     data: { username: newUsername, email: newEmail, role: newRole, id: userId, check:  isChecked ? 'true' : 'false', action: 'update' }, // Include user ID
     dataType: 'json', // Expect a JSON response
     success: function(response) {
         // Update the username cell with the new value
         $usernameCell.html(newUsername);
         $emailCell.html(newEmail);
         $roleCell.html(newRole);
         $checkCell.prop("disabled", true);
         $this.hide(); // Hide the save button
         $this.siblings(".edit-button").show(); // Show the edit button
     },
     error: function(xhr) {
     console.error(xhr.responseJSON.message); // Handle errors
 }
 });
});



/* Delete */
    $(document).on('click', ".delete-button", function(event){
        event.preventDefault();
        var $this = $(this);
        var $getTr = $this.closest("tr");
        $getTr.find('.id').css('border-bottom', '4px solid #D24545');
        $getTr.find('.username').css('border-bottom', '4px solid #D24545');
        $getTr.find('.email').css('border-bottom', '4px solid #D24545');
        $this.siblings('.edit-button').hide();
        $this.hide();
        $this.siblings('.submit-delete-button').show();
        $this.siblings('.cancel-delete-button').show();
    })
    /* Submit Delete */
    $(document).on('click', '.submit-delete-button', function(event) {
        event.preventDefault(); // Prevent the default action
        var $this = $(this);
        var userId = $this.closest("tr").find(".id").text(); // Get the user ID from the table
    
        // Confirm deletion
        if (confirm("Are you sure you want to delete this user?")) {
            $.ajax({
                url: '../utils/handle_admin_page.php', // Path to your PHP file
                type: 'POST',
                data: {
                    action: 'delete',
                    id: userId
                },
                dataType: 'json',
                success: function(response) {
                       $this.closest("tr").remove()  // Remove the user row from the DOM
                 },
                error: function(xhr) {
                    console.error(xhr.responseJSON.message); // Handle errors
                    alert(xhr.responseJSON.message || "An error occurred. Please try again.");
                }
            });
        }
    });

    $(document).on('click', '.cancel-delete-button', function(event){
        event.preventDefault()
        var $this = $(this)
        var tr = $this.closest("tr")

        var $usernameCell = tr.find('.username')
        var $idCell = tr.find('.id')
        var $emailCell = tr.find('.email')

        $idCell.css('border-bottom', '0');
        $emailCell.css('border-bottom', '0');
        $usernameCell.css('border-bottom', '0');

        
        $this.siblings('.submit-delete-button').hide();
        $this.hide();
        $this.siblings('.edit-button').show();
        $this.siblings('.delete-button').show();


    })


    $(document).on('click', '.yes', function() {
        // Get the username from the td in the same row
        const username = $(this).closest('tr').find('.username').text();
        alert(username)

        // Send the username to the PHP backend using AJAX
        $.ajax({
            url: '../utils/handle_admin_page.php', // Replace with the path to your PHP file
            type: 'POST',
            data: { username: username },
            success: function(response) {
                // Handle the response from the server if needed
                console.log(response);
            }
        });
    });

 })