<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Manager</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>2
</head>

<body>
    <header id="header">
        <img id="feup_logo" src="images/feup_logo.png" alt="feup_logo.png" title="Lógotipo da FEUP">
        <h1>Ticket Manager</h1>
        
        <h2>Web Page developed for the Curricular Unit Languages and Technologies of the Web</h2>
        
        <h3>Developed by:</h3>
        <ul>
            <li>José Nuno Barbosa Quintas, up202108712</li>
            <li>Emanuel Rui Tavano Maia, up202107486</li>
        </ul>

        <div id="registry_section">
            <p>In order to enjoy Ticket Manager at its full potential, please:</p>
            <a href="url_login">Sign In</a> | <a href="url_register">Sign Up</a>
        </div>
    </header>

    <main>
        <div class="tab">
            <button class="tablinks active" onclick="openTab(event, 'Client')">Client</button>
            <button class="tablinks" onclick="openTab(event, 'Agent')">Agent</button>
            <button class="tablinks" onclick="openTab(event, 'Admin')">Admin</button>
        </div>

        
        <div id="Client" class="tabsection" style="display: block">
            <div id="searchOptions">
                <form action="main.php" method="get">
                    <label for="department" >Department: </label> <select id="departmentSelect" name="departmentChoice">
                        <option value="Test1">Test 1</option>
                        <option value="Test2">Test 2</option>
                        <option value="Test3">Test 3</option>
                        <option value="Test4">Test 4</option>
                    </select>

                    <label for="sortOrder">&nbsp Sort by: </label> <select id="sortOrder" name="sortOrder">
                        <option value="Test1">Test 1</option>
                        <option value="Test2">Test 2</option>
                        <option value="Test3">Test 3</option>
                        <option value="Test4">Test 4</option>
                    </select>
                    
                    <input type="submit" value="Search" id="searchButton">

                    <input type="text" id="ticketSearchBar" placeholder="Input your text here..." name="ticketSearchBar">
                </form>
            </div>
            
            <?php 
                require("ticketDisplayer.php");

                $Ticket1 = new Ticket(1, "Test Title 1", "Test Description 1", "Test Department 1", "Test Client 1");
                $Ticket2 = new Ticket(2, "Test Title 2", "Test Description 2", "Marketing", "Test Client 2");
                $Ticket3 = new Ticket(3, "Test Title 3", "Test Description 3", "Test Department 3", "Test Client 3");
                $Ticket4 = new Ticket(4, "Test Title 4", "Test Description 4", "Engineering", "Test Client 4");
                $Ticket5 = new Ticket(5, "Test Title 5", "Test Description 5", "Test Department 5", "Test Client 5");

                $ticket_array = array($Ticket1, $Ticket2, $Ticket3, $Ticket4, $Ticket5);
                DisplayTickets($ticket_array);
            ?>
        </div>

        <div id="Agent" class="tabsection" style="display: none">
            <h3>Agent</h3>
            <p>An agent can create, reply and alter tickets that belong to his department</p>
        </div>

        <div id="Admin" class="tabsection" style="display: none">
            <h3>Admin</h3>
            <p>An admin has full control over the tickets, being able to create, reply, delete and alter any tickets of any department</p>
        </div>
    </main>
</body>
</html>