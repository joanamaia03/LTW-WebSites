<?php 
declare(strict_types = 1); 

require_once(__DIR__ . '/../templates/tickets.tpl.php');

function getEditProfileContent(User $user) {
    $content = '
        <form action="../actions/profile_update.php" method="POST" class="login_register">
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="' . $user->getName() . '"><br></br>

            <label for="username">Username</label>
            <input id="username" type="text" name="username" value="' . $user->getUsername() . '"><br></br>

            <label for="email">Email</label>
            <input id="email" type="text" name="email" value="' . $user->getEmail() . '"><br></br>

            <label for="password">Password</label>
            <input id="password" type="text" name="password">
            
            <div class="button">
                <button type="submit">Save</button>
            </div>
        </form>';

    return $content;
}


function getNewTicketContent() {
    $content = '
    <form action="../actions/ticket_submission.php" method="POST">
      <label for="title">Title:</label>
      <input id="title" type="text" name="title"><br><br>
      
      <label for="description">Description:</label>
      <input id="description" type="text" name="description"><br><br>
      
      <label for="department">Department:</label>
      <select id="department" name="department">
        <option value="">None</option>
      </select><br><br>
      
      <div class="button">
        <button id="submitTicket" type="submit">Submit Ticket</button>
      </div>
    </form>
    ';    

    return $content;
}


function getMyTicketsContent() {
    $content = '
    <div id="tickets-container">
    </div>    
    ';
    return $content;
}

function updateAssignedAgent(){
    $content ='
    <form action="../database/user.class.php" method="POST" class="login_register">

        <label for="department">Department</label>
        <input id="department" type="text" name="department" value=""><br></br>

        <label for="username">Username</label>
        <input id="user" type="text" name="user" value=""><br></br>

        <div class="button">
            <button type="submit">Assign</button>
        </div>
    </form>
    ';
    return $content;
}

function updateTicketStatuse(){
    $content ='
    <form action="../database/ticket.class.php" method="POST" class="login_register">

        <label for="ticket">Ticket</label>
        <input id="ticket" type="text" name="Ticket" value=""><br></br>

        <label for="status">Status</label>
        <input id="status" type="text" name="status" value=""><br></br>

        <div class="button">
            <button type="submit">Update</button>
        </div>
    </form>
    ';
    return $content;
}

function getUpdatedRole(){
    $content = '
        <form action="./database/user.class.php" method="POST" class="login_register">

            <label for="username">Username</label>
            <input id="username" type="text" name="username" value=""><br></br>

            <label for="password">Role</label>
            <input id="password" type="text" name="password">
        
            <div class="button">
                <button type="submit">Update</button>
            </div>
        </form>'
    ;

    return $content;
  }

function getAddDepartment(){
    $content='
    <form action="../database/user.class.php" method="POST" class="login_register">

            <label for="department">Department</label>
            <input id="department" type="text" name="department" value=""><br></br>
        
            <div class="button">
                <button type="submit">Add</button>
            </div>
    </form>
    ';
    return $content;
}

function getAssignAgentToDepartment(){
    $content ='
    <form action="../database/user.class.php" method="POST" class="login_register">

        <label for="department">Department</label>
        <input id="department" type="text" name="department" value=""><br></br>

        <label for="username">Username</label>
        <input id="user" type="text" name="user" value=""><br></br>

        <div class="button">
            <button type="submit">Add</button>
        </div>
    </form>
    ';
    return $content;
}


function drawProfile(User $user) { ?>

    <?php $userRole = $user->getRole(); ?>

    <div id="menu">
        <h2>Profile</h2>
            <button id="editProfile">Edit Profile</button>
            <button id="newTicket">New Ticket</button>
            <button id="myTickets">My Tickets</button>
            <button id="updateAssignedAgent">Update Assigned Agent</button>
            <button id="updateTicketStatus">Update Ticket Status</button>
            <button id="updateRole">Update Role</button>
            <button id="addDepartment">Add Department</button>
            <button id="assignAgentToDepartment">Assign Agent to Department</button>
    </div>

    <div id="contentContainer"></div>

    <input type="hidden" id="userRole" value="<?php echo $userRole; ?>">

    <script src="/../javascript/profile.js"></script>
    
    <script> initializeProfile(document.getElementById("userRole").value);</script>

<?php } ?>