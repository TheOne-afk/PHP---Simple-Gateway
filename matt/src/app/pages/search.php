<?php
// Your PHP code can go here (if needed)
?>
<table>
    <tr>
        <td class="username">Username</td>
        <td>
            <button class="edit-button">Edit</button>
            <button class="save-button" style="display:none;">Save</button>
        </td>
    </tr>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    /* Edit AJAX */
    $(document).ready(function() {

        $(document).on("click", ".edit-button", function() { // add clicks to the edit button
            var $this = $(this);
            // Find the username cell and replace its content with an input field
            var $usernameCell = $this.closest("tr").find(".username");
            var currentUsername = $usernameCell.text();

            $usernameCell.html('<input type="text" value="' + currentUsername + '" />');
            $this.hide(); // Hide the edit button
            $this.siblings(".save-button").show(); // Show the save button
        });

        /* Save button */

        $(document).on("click", ".save-button", function() {
            var $this = $(this);
            var $usernameCell = $this.closest("tr").find(".username");
            var newUsername = $usernameCell.find("input").val();

            
            $.ajax({
                url: 'path/to/your/update/username.php',
                type: 'POST',
                data: { username: newUsername },
                success: function(response) {
                    // Handle the response from the server
                    console.log(response);
                }
            });

            // For demonstration, just update the cell text to the new value
            $usernameCell.html(newUsername);
            $this.hide(); // Hide the save button
            $this.siblings(".edit-button").show(); // Show the edit button
        });
    });
</script>
