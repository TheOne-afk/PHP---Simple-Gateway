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
         else if(input == ""){
             $.ajax({
                 url: "../utils/handle_admin_page.php",
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

         $usernameCell.html('<input type="text" class="edit-user" id="inputUsername" value="' + currentUsername + '" />');
         $emailCell.html('<input type="text" class="edit-email" id="inputEmail" value="' + currentEmail + '" />');
         $roleCell.html('<input type="text" class="edit-email" id="inputRole" value="' + currentRole + '" />');
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
    
        // Restore the username cell content back to the original
        $usernameCell.html(originalUsername); // Set the original username back
    
        // Hide the cancel button and show the edit button
        $this.hide();
        $row.find('.edit-button').show();
        $row.find('.save-button').hide();
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
 })